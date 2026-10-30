<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        $kamars = [
            [
                'nomor_kamar' => '101',
                'tipe_kamar' => 'Standard Room',
                'harga' => 350000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi Pribadi',
            ],
            [
                'nomor_kamar' => '102',
                'tipe_kamar' => 'Superior Room',
                'harga' => 450000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi Pribadi, Meja Kerja, Ketel Listrik',
            ],
            [
                'nomor_kamar' => '201',
                'tipe_kamar' => 'Deluxe Room',
                'harga' => 600000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi Pribadi, Kulkas Mini, Meja Kerja',
            ],
            [
                'nomor_kamar' => '202',
                'tipe_kamar' => 'Junior Suite',
                'harga' => 900000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi Pribadi, Tempat Tidur King, Sofa, Ruang Duduk',
            ],
            [
                'nomor_kamar' => '301',
                'tipe_kamar' => 'Executive Suite',
                'harga' => 1500000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi Pribadi, Tempat Tidur King, Ruang Tamu, Sofa, Kulkas Mini',
            ],
            [
                'nomor_kamar' => '302',
                'tipe_kamar' => 'Presidential Suite',
                'harga' => 2500000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi Pribadi, Tempat Tidur King, Ruang Tamu Luas, Sofa, Kulkas Mini',
            ],
        ];

        foreach ($kamars as $data) {
            DB::table('kamars')
                ->where('nomor_kamar', $data['nomor_kamar'])
                ->update([
                    'tipe_kamar' => $data['tipe_kamar'],
                    'harga' => $data['harga'],
                    'fasilitas' => $data['fasilitas'],
                    'updated_at' => now(),
                ]);
        }
    }
}