<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\Pembayaran;

class LandingPageController extends Controller
{
    public function index()
    {
        // Kamar normal yang tampil
        // DAN kamar yang sedang diperbaiki tetap ditampilkan
        $kamars = Kamar::where(function ($query) {
            $query->where('tampil', true)
                  ->orWhere('status', 'perbaikan');
        })->get();

        // Data reservasi dan pembayaran untuk tamu yang sedang login
        $reservasis = collect();
        $pembayarans = collect();

        if (auth()->check() && auth()->user()->role === 'tamu') {

            $tamu = auth()->user()->tamu;

            if ($tamu) {

                $reservasis = Reservasi::with('kamar')
                    ->where('tamu_id', $tamu->id)
                    ->latest()
                    ->get();

                $pembayarans = Pembayaran::whereIn(
                    'reservasi_id',
                    $reservasis->pluck('id')
                )
                ->latest()
                ->get();
            }
        }

        return view(
            'welcome',
            compact(
                'kamars',
                'reservasis',
                'pembayarans'
            )
        );
    }
}