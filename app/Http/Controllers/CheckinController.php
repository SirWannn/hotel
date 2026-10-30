<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $reservasis = Reservasi::with(['tamu', 'kamar'])
            ->where('status', 'disetujui')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {

                    $q->where(
                        'jumlah_tamu',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhere(
                        'check_in',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhere(
                        'check_out',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhereHas('tamu', function ($tamu) use ($search) {
                        $tamu->where(
                            'nama',
                            'like',
                            '%' . $search . '%'
                        );
                    })

                    ->orWhereHas('kamar', function ($kamar) use ($search) {
                        $kamar->where(
                            'nomor_kamar',
                            'like',
                            '%' . $search . '%'
                        );
                    });
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'admin.checkin',
            compact(
                'reservasis',
                'search'
            )
        );
    }


    // =========================
    // PROSES CHECK-IN
    // =========================
    public function checkin($id)
    {
        // Cari reservasi berdasarkan ID saja terlebih dahulu
        $reservasi = Reservasi::with('kamar')
            ->where('id', $id)
            ->first();

        // Kalau reservasi tidak ditemukan
        if (!$reservasi) {
            return redirect('/admin/checkin')
                ->with(
                    'error',
                    'Data reservasi tidak ditemukan.'
                );
        }


        // =========================
        // CEK SUDAH CHECK-IN
        // =========================
        if ($reservasi->status === 'check-in') {

            return redirect('/admin/checkin')
                ->with(
                    'error',
                    'Tamu ini sudah melakukan check-in sebelumnya.'
                );
        }


        // =========================
        // CEK STATUS
        // =========================
        if ($reservasi->status !== 'disetujui') {

            return redirect('/admin/checkin')
                ->with(
                    'error',
                    'Reservasi belum dapat melakukan check-in.'
                );
        }


        // =========================
        // UBAH STATUS RESERVASI
        // =========================
        $reservasi->update([
            'status' => 'check-in',
        ]);


        // =========================
        // UBAH STATUS KAMAR
        // =========================
        if ($reservasi->kamar) {

            $reservasi->kamar->update([
                'status' => 'terisi',
            ]);
        }


        // =========================
        // KEMBALI KE HALAMAN CHECK-IN
        // =========================
        return redirect('/admin/checkin')
            ->with(
                'success',
                'Tamu berhasil check-in dan kamar sekarang terisi.'
            );
    }
}