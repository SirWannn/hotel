<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $pembayarans = Pembayaran::with([
            'reservasi.tamu',
            'reservasi.kamar'
        ])
            ->when($search, function ($query) use ($search) {
                $query->where('status', 'like', '%' . $search . '%')
                      ->orWhere('metode', 'like', '%' . $search . '%')
                      ->orWhereHas('reservasi.tamu', function ($q) use ($search) {
                          $q->where('nama', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('reservasi.kamar', function ($q) use ($search) {
                          $q->where('nomor_kamar', 'like', '%' . $search . '%');
                      });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'admin.pembayaran',
            compact('pembayarans', 'search')
        );
    }

    public function setuju($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([
            'status' => 'disetujui',
            'alasan_penolakan' => null,
        ]);

        $pembayaran->reservasi->update([
            'status' => 'disetujui',
        ]);

        return redirect('/admin/pembayaran')
            ->with(
                'success',
                'Pembayaran berhasil disetujui.'
            );
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:1000',
        ], [
            'alasan_penolakan.required' =>
                'Alasan penolakan wajib diisi.',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->alasan_penolakan =
            $request->alasan_penolakan;

        $pembayaran->status = 'ditolak';

        $pembayaran->save();

        $pembayaran->reservasi->update([
            'status' => 'ditolak',
        ]);

        return redirect('/admin/pembayaran')
            ->with(
                'success',
                'Pembayaran berhasil ditolak dan alasan telah disimpan.'
            );
    }

    public function kuitansi($id)
    {
        $tamu = auth()->user()->tamu;

        $pembayaran = Pembayaran::with([
            'reservasi.tamu',
            'reservasi.kamar'
        ])
            ->where('id', $id)
            ->where('status', 'disetujui')
            ->whereHas('reservasi', function ($query) use ($tamu) {
                $query->where('tamu_id', $tamu->id);
            })
            ->firstOrFail();

        $reservasi = $pembayaran->reservasi;

        return view(
            'tamu.kuitansi',
            compact('pembayaran', 'reservasi')
        );
    }
}