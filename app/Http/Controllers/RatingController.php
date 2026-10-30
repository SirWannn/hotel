<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    // =========================
    // MENYIMPAN RATING TAMU
    // =========================
    public function store(Request $request, $id)
    {
        // Pastikan tamu sudah login.
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $tamu = $user->tamu;

        if (!$tamu) {
            return redirect('/login')
                ->with('error', 'Data tamu tidak ditemukan.');
        }

        // Validasi rating dan ulasan.
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:1000',
        ], [
            'rating.required' => 'Silakan pilih rating bintang.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'ulasan.max' => 'Ulasan maksimal 1000 karakter.',
        ]);

        // Pastikan reservasi milik tamu yang sedang login.
        $reservasi = Reservasi::with('kamar')
            ->where('id', $id)
            ->where('tamu_id', $tamu->id)
            ->firstOrFail();

        // Rating hanya boleh diberikan setelah check-out.
        if ($reservasi->status !== 'check-out') {
            return redirect('/tamu')
                ->with(
                    'error',
                    'Rating hanya dapat diberikan setelah check-out.'
                );
        }

        // Cegah rating kedua pada reservasi yang sama.
        if (Rating::where('reservasi_id', $reservasi->id)->exists()) {
            return redirect('/tamu')
                ->with(
                    'error',
                    'Reservasi ini sudah memiliki rating.'
                );
        }

        // Simpan rating.
        Rating::create([
            'reservasi_id' => $reservasi->id,
            'tamu_id' => $tamu->id,
            'kamar_id' => $reservasi->kamar_id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        return redirect('/tamu')
            ->with(
                'success',
                'Terima kasih! Rating dan ulasan Anda berhasil disimpan.'
            );
    }
}