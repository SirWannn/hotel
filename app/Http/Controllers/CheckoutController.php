<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $reservasis = Reservasi::with(['tamu', 'kamar'])
            ->where('status', 'check-in')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('jumlah_tamu', 'like', '%' . $search . '%')
                      ->orWhere('check_in', 'like', '%' . $search . '%')
                      ->orWhere('check_out', 'like', '%' . $search . '%')
                      ->orWhereHas('tamu', function ($tamu) use ($search) {
                          $tamu->where('nama', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('kamar', function ($kamar) use ($search) {
                          $kamar->where('nomor_kamar', 'like', '%' . $search . '%');
                      });
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'admin.checkout',
            compact('reservasis', 'search')
        );
    }

    public function checkout($id)
    {
        $reservasi = Reservasi::with('kamar')
            ->where('id', $id)
            ->where('status', 'check-in')
            ->firstOrFail();

        $reservasi->update([
            'status' => 'check-out',
        ]);

        if ($reservasi->kamar) {
            $reservasi->kamar->update([
                'status' => 'tersedia',
            ]);
        }

        return redirect('/admin/checkout')
            ->with(
                'success',
                'Tamu berhasil check-out dan kamar kembali tersedia.'
            );
    }
}