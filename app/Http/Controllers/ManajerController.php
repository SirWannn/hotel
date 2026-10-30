<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Tamu;
use App\Models\Reservasi;

class ManajerController extends Controller
{
    public function index()
    {
        $totalKamar = Kamar::count();
        $totalTamu = Tamu::count();
        $totalReservasi = Reservasi::count();
        $jumlahLaporan = 1;

        return view('manajer.dashboard', compact(
            'totalKamar',
            'totalTamu',
            'totalReservasi',
            'jumlahLaporan'
        ));
    }
}