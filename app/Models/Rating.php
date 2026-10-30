<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'reservasi_id',
        'tamu_id',
        'kamar_id',
        'rating',
        'ulasan',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }

    public function tamu()
    {
        return $this->belongsTo(Tamu::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}