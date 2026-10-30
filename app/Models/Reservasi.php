<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;

class Reservasi extends Model
{
    protected $fillable = [
        'tamu_id',
        'kamar_id',
        'jumlah_tamu',
        'check_in',
        'check_out',
        'status',
    ];

    public function tamu()
    {
        return $this->belongsTo(Tamu::class, 'tamu_id');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'reservasi_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'reservasi_id');
    }
}
