<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TamuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tamus')->insert([
            'nama' => 'Rizky',
            'nomor_identitas' => '1234567890',
            'no_telepon' => '081234567890',
            'alamat' => 'Bandung',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}