<?php

use Illuminate\Support\Facades\DB;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$sumber = DB::connection('mysql_lokal');
$tujuan = DB::connection('pgsql');

$tabel = [
    'users',
    'kamars',
    'tamus',
    'reservasis',
    'pembayarans',
    'ratings',
];

try {
    // Pastikan seluruh tabel tujuan masih kosong.
    foreach ($tabel as $namaTabel) {
        $jumlah = $tujuan->table($namaTabel)->count();

        if ($jumlah > 0) {
            throw new RuntimeException(
                "Tabel {$namaTabel} di Supabase tidak kosong. Pemindahan dibatalkan."
            );
        }
    }

    // Ambil data dari MySQL dan pindahkan sesuai urutan relasi.
    $tujuan->transaction(function () use ($sumber, $tujuan, $tabel) {
        foreach ($tabel as $namaTabel) {
            $jumlahBerhasil = 0;

            $sumber->table($namaTabel)
                ->orderBy('id')
                ->chunk(200, function ($baris) use (
                    $tujuan,
                    $namaTabel,
                    &$jumlahBerhasil
                ) {
                    $data = $baris
                        ->map(fn ($item) => (array) $item)
                        ->all();

                    if (!empty($data)) {
                        $tujuan->table($namaTabel)->insert($data);
                        $jumlahBerhasil += count($data);
                    }
                });

            echo "{$namaTabel}: {$jumlahBerhasil} baris dipindahkan.\n";
        }
    });

    // Sesuaikan sequence PostgreSQL agar ID berikutnya tidak bentrok.
    foreach ($tabel as $namaTabel) {
        $tujuan->statement(
            "SELECT setval(
                pg_get_serial_sequence('public.{$namaTabel}', 'id'),
                COALESCE((SELECT MAX(id) FROM public.{$namaTabel}), 1),
                EXISTS (SELECT 1 FROM public.{$namaTabel})
            )"
        );
    }

    echo "\nPemindahan data berhasil!\n";
} catch (Throwable $e) {
    echo "\nPEMINDAHAN GAGAL: " . $e->getMessage() . "\n";
    exit(1);
}