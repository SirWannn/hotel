<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;

class StatusReservasiController extends Controller
{
    public function index()
    {
        $tamu = auth()->user()->tamu;

        $reservasis = Reservasi::with(['tamu', 'kamar'])
            ->where('tamu_id', $tamu->id)
            ->latest()
            ->get();

        return view('tamu.status-reservasi', compact('reservasis'));
    }
}