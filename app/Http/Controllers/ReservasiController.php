<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\Rating;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    // =========================
    // DASHBOARD TAMU
    // =========================
    public function dashboard()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        $tamu = $user->tamu;

        if (!$tamu) {
            return redirect('/login')
                ->with('error', 'Data tamu tidak ditemukan.');
        }

        $reservasis = Reservasi::with([
            'kamar',
            'pembayaran'
        ])
            ->where('tamu_id', $tamu->id)
            ->latest()
            ->get();

        $pembayarans = Pembayaran::whereIn(
            'reservasi_id',
            $reservasis->pluck('id')
        )->get();

        return view('tamu.dashboard', compact(
            'tamu',
            'reservasis',
            'pembayarans'
        ));
    }


    // =========================
    // FORM RESERVASI BARU
    // =========================
    public function create(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        $tamu = $user->tamu;

        if (!$tamu) {
            return redirect('/login')
                ->with('error', 'Data tamu tidak ditemukan.');
        }

        $kamar = null;

        if ($request->kamar_id) {
            $kamar = Kamar::find($request->kamar_id);
        }

        $kamars = Kamar::where('status', 'tersedia')
            ->where('tampil', true)
            ->get();

        return view('tamu.reservasi', compact(
            'tamu',
            'kamar',
            'kamars'
        ));
    }


    // =========================
    // SIMPAN RESERVASI BARU
    // =========================
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        $tamu = $user->tamu;

        if (!$tamu) {
            return redirect('/login')
                ->with('error', 'Data tamu tidak ditemukan.');
        }

        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'jumlah_tamu' => 'required|integer|min:1',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ], [
            'kamar_id.required' => 'Kamar harus dipilih.',
            'kamar_id.exists' => 'Kamar tidak ditemukan.',
            'jumlah_tamu.required' => 'Jumlah tamu harus diisi.',
            'jumlah_tamu.integer' => 'Jumlah tamu harus berupa angka.',
            'jumlah_tamu.min' => 'Jumlah tamu minimal 1 orang.',
            'check_in.required' => 'Tanggal check-in harus diisi.',
            'check_out.required' => 'Tanggal check-out harus diisi.',
            'check_out.after' => 'Tanggal check-out harus setelah check-in.',
        ]);

        $kamar = Kamar::findOrFail($request->kamar_id);

        // CEK STATUS KAMAR
        if ($kamar->status !== 'tersedia') {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Kamar tersebut sedang tidak tersedia untuk dipesan.'
                );
        }

        // CEK KAMAR DITAMPILKAN
        if (!$kamar->tampil) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Kamar tersebut sedang tidak tersedia untuk dipesan.'
                );
        }

        // CEK KAPASITAS KAMAR
        if (
            $kamar->kapasitas !== null &&
            $request->jumlah_tamu > $kamar->kapasitas
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah tamu melebihi kapasitas kamar, yaitu '
                    . $kamar->kapasitas . ' orang.'
                );
        }

        // CEK BENTROK TANGGAL
        $bentrok = Reservasi::where('kamar_id', $kamar->id)
            ->whereIn('status', [
                'menunggu',
                'disetujui',
                'check-in'
            ])
            ->where(function ($query) use ($request) {
                $query->where(
                    'check_in',
                    '<',
                    $request->check_out
                )->where(
                    'check_out',
                    '>',
                    $request->check_in
                );
            })
            ->exists();

        if ($bentrok) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Kamar sudah dipesan pada tanggal tersebut.'
                );
        }

        // BUAT RESERVASI
        $reservasi = Reservasi::create([
            'tamu_id' => $tamu->id,
            'kamar_id' => $kamar->id,
            'jumlah_tamu' => $request->jumlah_tamu,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'menunggu',
        ]);

        // SIMPAN ID RESERVASI
        session([
            'reservasi_id' => $reservasi->id
        ]);

        return redirect('/pembayaran')
            ->with(
                'success',
                'Reservasi berhasil dibuat. Silakan lakukan pembayaran.'
            );
    }


    // =========================
    // FORM EDIT RESERVASI
    // =========================
    public function edit($id)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        $tamu = $user->tamu;

        if (!$tamu) {
            return redirect('/login')
                ->with('error', 'Data tamu tidak ditemukan.');
        }

        $reservasi = Reservasi::with([
            'tamu',
            'kamar',
            'pembayaran'
        ])
            ->where('id', $id)
            ->where('tamu_id', $tamu->id)
            ->firstOrFail();

        // CEK PEMBAYARAN
        if (
            $reservasi->pembayaran &&
            $reservasi->pembayaran->status === 'disetujui'
        ) {
            return redirect('/tamu')
                ->with(
                    'error',
                    'Pembayaran sudah disetujui. Reservasi tidak dapat diedit lagi.'
                );
        }

        // CEK STATUS RESERVASI
        if (in_array($reservasi->status, [
            'check-in',
            'check-out',
            'selesai'
        ])) {
            return redirect('/tamu')
                ->with(
                    'error',
                    'Reservasi sudah diproses dan tidak dapat diedit lagi.'
                );
        }

        return view(
            'tamu.edit-reservasi',
            compact('reservasi')
        );
    }


    // =========================
    // UPDATE RESERVASI
    // =========================
    public function update(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        $tamu = $user->tamu;

        if (!$tamu) {
            return redirect('/login')
                ->with('error', 'Data tamu tidak ditemukan.');
        }

        $reservasi = Reservasi::with([
            'pembayaran',
            'kamar'
        ])
            ->where('id', $id)
            ->where('tamu_id', $tamu->id)
            ->firstOrFail();

        // CEK PEMBAYARAN
        if (
            $reservasi->pembayaran &&
            $reservasi->pembayaran->status === 'disetujui'
        ) {
            return redirect('/tamu')
                ->with(
                    'error',
                    'Pembayaran sudah disetujui. Reservasi tidak dapat diedit lagi.'
                );
        }

        // CEK STATUS RESERVASI
        if (in_array($reservasi->status, [
            'check-in',
            'check-out',
            'selesai'
        ])) {
            return redirect('/tamu')
                ->with(
                    'error',
                    'Reservasi sudah diproses dan tidak dapat diedit lagi.'
                );
        }

        // VALIDASI INPUT
        $request->validate([
            'jumlah_tamu' => 'required|integer|min:1',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ], [
            'jumlah_tamu.required' => 'Jumlah tamu harus diisi.',
            'jumlah_tamu.integer' => 'Jumlah tamu harus berupa angka.',
            'jumlah_tamu.min' => 'Jumlah tamu minimal 1 orang.',
            'check_in.required' => 'Tanggal check-in harus diisi.',
            'check_out.required' => 'Tanggal check-out harus diisi.',
            'check_out.after' => 'Tanggal check-out harus setelah check-in.',
        ]);

        // KAMAR TETAP MENGGUNAKAN RESERVASI LAMA
        $kamar = $reservasi->kamar;

        if (!$kamar) {
            return redirect('/tamu')
                ->with(
                    'error',
                    'Kamar pada reservasi tidak ditemukan.'
                );
        }

        // CEK STATUS KAMAR
        if ($kamar->status !== 'tersedia') {
            return redirect('/tamu')
                ->with(
                    'error',
                    'Kamar yang digunakan sedang tidak tersedia.'
                );
        }

        // CEK KAPASITAS KAMAR
        if (
            $kamar->kapasitas !== null &&
            $request->jumlah_tamu > $kamar->kapasitas
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah tamu maksimal untuk kamar ini adalah '
                    . $kamar->kapasitas . ' orang.'
                );
        }

        // CEK BENTROK TANGGAL
        // Reservasi yang sedang diedit tidak dihitung sebagai bentrok.
        $bentrok = Reservasi::where(
            'kamar_id',
            $reservasi->kamar_id
        )
            ->where('id', '!=', $reservasi->id)
            ->whereIn('status', [
                'menunggu',
                'disetujui',
                'check-in'
            ])
            ->where(function ($query) use ($request) {
                $query->where(
                    'check_in',
                    '<',
                    $request->check_out
                )->where(
                    'check_out',
                    '>',
                    $request->check_in
                );
            })
            ->exists();

        if ($bentrok) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Kamar yang Anda pilih sudah dipesan pada tanggal tersebut.'
                );
        }

        // UPDATE RESERVASI
        // Kamar tidak diganti.
        $reservasi->jumlah_tamu = (int) $request->jumlah_tamu;
        $reservasi->check_in = $request->check_in;
        $reservasi->check_out = $request->check_out;

        $reservasi->save();

        // SIMPAN ID RESERVASI
        session([
            'reservasi_id' => $reservasi->id
        ]);

        // JIKA PEMBAYARAN DITOLAK
        if (
            $reservasi->pembayaran &&
            $reservasi->pembayaran->status === 'ditolak'
        ) {
            return redirect('/tamu')
                ->with(
                    'success',
                    'Perubahan reservasi berhasil disimpan.'
                );
        }

        // KEMBALI KE PEMBAYARAN
        return redirect('/pembayaran')
            ->with(
                'success',
                'Perubahan reservasi berhasil disimpan. Silakan lanjutkan pembayaran.'
            );
    }
}
