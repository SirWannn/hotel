<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use App\Models\Tamu;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // =========================
        // VALIDASI FILTER TANGGAL
        // =========================
        $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date',
        ]);

        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');

        if (
            $tanggalMulai &&
            $tanggalAkhir &&
            Carbon::parse($tanggalAkhir)->lt(
                Carbon::parse($tanggalMulai)
            )
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'tanggal_akhir' =>
                        'Tanggal akhir tidak boleh sebelum tanggal mulai.'
                ]);
        }

        // =========================
        // QUERY RESERVASI
        // Filter menggunakan tanggal check-in
        // =========================
        $queryReservasi = Reservasi::query();

        if ($tanggalMulai) {
            $queryReservasi->whereDate(
                'check_in',
                '>=',
                $tanggalMulai
            );
        }

        if ($tanggalAkhir) {
            $queryReservasi->whereDate(
                'check_in',
                '<=',
                $tanggalAkhir
            );
        }

        $totalReservasi = (clone $queryReservasi)->count();

        // Data tamu dan kamar untuk tabel laporan
        $reservasis = (clone $queryReservasi)
            ->with(['kamar', 'tamu'])
            ->orderBy('check_in')
            ->get();

        // Jumlah tamu unik pada reservasi yang difilter
        $totalTamu = (clone $queryReservasi)
            ->whereNotNull('tamu_id')
            ->distinct()
            ->count('tamu_id');

        // =========================
        // DATA KAMAR
        // Status kamar saat ini
        // =========================
        $totalKamar = Kamar::count();

        $kamarTersedia = Kamar::where(
            'status',
            'tersedia'
        )->count();

        $kamarTerisi = Kamar::where(
            'status',
            'terisi'
        )->count();

        // =========================
        // QUERY PEMBAYARAN
        // Filter menggunakan tanggal pembayaran
        // =========================
        $queryPembayaran = Pembayaran::where(
            'status',
            'disetujui'
        )->whereNotNull('tanggal');

        if ($tanggalMulai) {
            $queryPembayaran->whereDate(
                'tanggal',
                '>=',
                $tanggalMulai
            );
        }

        if ($tanggalAkhir) {
            $queryPembayaran->whereDate(
                'tanggal',
                '<=',
                $tanggalAkhir
            );
        }

        // Total pendapatan pada periode yang dipilih
        $totalUangMasuk = (clone $queryPembayaran)
            ->sum('jumlah');

        // Jumlah pembayaran yang disetujui pada periode
        $totalPembayaranBerhasil = (clone $queryPembayaran)
            ->count();

        // =========================
        // GRAFIK UANG MASUK
        // =========================
        $uangMasuk = (clone $queryPembayaran)
            ->selectRaw(
                'DATE(tanggal) as tanggal, SUM(jumlah) as total'
            )
            ->groupByRaw('DATE(tanggal)')
            ->orderBy('tanggal')
            ->get();

        // =========================
        // GRAFIK RESERVASI
        // Berdasarkan tanggal check-in
        // =========================
        $queryGrafikReservasi = Reservasi::whereNotNull(
            'check_in'
        );

        if ($tanggalMulai) {
            $queryGrafikReservasi->whereDate(
                'check_in',
                '>=',
                $tanggalMulai
            );
        }

        if ($tanggalAkhir) {
            $queryGrafikReservasi->whereDate(
                'check_in',
                '<=',
                $tanggalAkhir
            );
        }

        $jumlahReservasi = $queryGrafikReservasi
            ->selectRaw(
                'DATE(check_in) as tanggal, COUNT(*) as total'
            )
            ->groupByRaw('DATE(check_in)')
            ->orderBy('tanggal')
            ->get();

        // =========================
        // TAMPILKAN LAPORAN
        // =========================
        return view('admin.laporan', compact(
            'tanggalMulai',
            'tanggalAkhir',
            'totalReservasi',
            'totalTamu',
            'totalKamar',
            'kamarTersedia',
            'kamarTerisi',
            'totalUangMasuk',
            'totalPembayaranBerhasil',
            'uangMasuk',
            'jumlahReservasi',
            'reservasis'
        ));
    }
}
