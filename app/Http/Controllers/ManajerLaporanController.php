<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Tamu;
use App\Models\Reservasi;

class ManajerLaporanController extends Controller
{
    public function index()
    {
        $jumlahKamar = Kamar::count();
        $jumlahTamu = Tamu::count();
        $jumlahReservasi = Reservasi::count();

        $jumlahCheckin = Reservasi::where('status', 'check-in')->count();
        $jumlahCheckout = Reservasi::where('status', 'check-out')->count();

        $jumlahLaporan = 1;

        return view('manajer.laporan', compact(
            'jumlahKamar',
            'jumlahTamu',
            'jumlahReservasi',
            'jumlahCheckin',
            'jumlahCheckout',
            'jumlahLaporan'
        ));
    }
}