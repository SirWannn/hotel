<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga',
        'kapasitas',
        'fasilitas',
        'status',
        'keterangan_perbaikan',
        'tampil',
        'foto',
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}