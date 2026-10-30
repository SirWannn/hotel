<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kamars')->insert([
            [
                'nomor_kamar' => '101',
                'tipe_kamar' => 'Standard',
                'harga' => 300000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_kamar' => '102',
                'tipe_kamar' => 'Standard',
                'harga' => 300000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_kamar' => '201',
                'tipe_kamar' => 'Deluxe',
                'harga' => 500000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi, Sarapan',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_kamar' => '202',
                'tipe_kamar' => 'Deluxe',
                'harga' => 500000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi, Sarapan',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_kamar' => '301',
                'tipe_kamar' => 'Suite',
                'harga' => 800000,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi, Sarapan, Ruang Tamu',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}