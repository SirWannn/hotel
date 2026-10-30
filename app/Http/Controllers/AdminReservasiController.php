<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class AdminReservasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $reservasis = Reservasi::with(['tamu', 'kamar'])
            ->when($search, function ($query) use ($search) {
                $query->where('jumlah_tamu', 'like', '%' . $search . '%')
                      ->orWhere('check_in', 'like', '%' . $search . '%')
                      ->orWhere('check_out', 'like', '%' . $search . '%')
                      ->orWhere('status', 'like', '%' . $search . '%')
                      ->orWhereHas('tamu', function ($q) use ($search) {
                          $q->where('nama', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('kamar', function ($q) use ($search) {
                          $q->where('nomor_kamar', 'like', '%' . $search . '%');
                      });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'admin.reservasi',
            compact('reservasis', 'search')
        );
    }
}