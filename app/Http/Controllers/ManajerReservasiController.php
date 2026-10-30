<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;

class ManajerReservasiController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::with(['tamu', 'kamar'])->latest()->get();

        return view('manajer.reservasi', compact('reservasis'));
    }
}