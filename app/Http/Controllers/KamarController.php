<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    // =========================
    // DATA KAMAR UNTUK TAMU
    // =========================
    public function index()
{
    $kamars = Kamar::all();

    return view('tamu.kamar', compact('kamars'));
}


    // =========================
    // DATA KAMAR UNTUK ADMIN
    // =========================
    public function admin(Request $request)
    {
        $search = $request->search;

        $kamars = Kamar::when($search, function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where('nomor_kamar', 'like', '%' . $search . '%')
                    ->orWhere('tipe_kamar', 'like', '%' . $search . '%')
                    ->orWhere('fasilitas', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere(
                        'keterangan_perbaikan',
                        'like',
                        '%' . $search . '%'
                    );

            });

        })
        ->latest()
        ->paginate(5)
        ->withQueryString();

        return view(
            'admin.kamar',
            compact('kamars', 'search')
        );
    }


    // =========================
    // TAMBAH KAMAR
    // =========================
    public function create()
    {
        return view('admin.kamar-tambah');
    }


    // =========================
    // TAMPILKAN / SEMBUNYIKAN
    // =========================
    public function toggleTampil(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        // =========================
        // JIKA KAMAR SEDANG TAMPIL
        // =========================
        if ($kamar->tampil) {

            $request->validate([
                'keterangan_perbaikan' => 'required|string|max:1000',
            ], [
                'keterangan_perbaikan.required' =>
                    'Alasan atau keterangan wajib diisi.',
            ]);

            $kamar->update([
                'tampil' => false,
                'status' => 'perbaikan',
                'keterangan_perbaikan' => $request->keterangan_perbaikan,
            ]);

            return redirect('/admin/kamar')
                ->with(
                    'success',
                    'Kamar berhasil disembunyikan dan keterangan perbaikan berhasil disimpan.'
                );
        }


        // =========================
        // JIKA KAMAR SEDANG DISEMBUNYIKAN
        // =========================
        $kamar->update([
            'tampil' => true,
            'status' => 'tersedia',
            'keterangan_perbaikan' => null,
        ]);

        return redirect('/admin/kamar')
            ->with(
                'success',
                'Kamar berhasil ditampilkan kembali.'
            );
    }


    // =========================
    // SIMPAN KAMAR BARU
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required',
            'tipe_kamar' => 'required',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $namaFoto =
                time() . '_' .
                $file->getClientOriginalName();

            $file->move(
                public_path('kamar'),
                $namaFoto
            );

            $foto = $namaFoto;
        }

        Kamar::create([
            'nomor_kamar' => $request->nomor_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'harga' => $request->harga,
            'kapasitas' => $request->kapasitas,
            'fasilitas' => $request->fasilitas,
            'tampil' => true,
            'foto' => $foto,
            'status' => 'tersedia',
            'keterangan_perbaikan' => null,
        ]);

        return redirect('/admin/kamar')
            ->with(
                'success',
                'Data kamar berhasil ditambahkan.'
            );
    }


    // =========================
    // EDIT KAMAR
    // =========================
    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);

        return view(
            'admin.kamar-edit',
            compact('kamar')
        );
    }


    // =========================
    // UPDATE KAMAR
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kamar' => 'required',
            'tipe_kamar' => 'required',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'status' => 'required|in:tersedia,perbaikan',

            'keterangan_perbaikan' =>
                'required_if:status,perbaikan|nullable|string|max:1000',
        ]);

        $kamar = Kamar::findOrFail($id);

        $data = [
            'nomor_kamar' => $request->nomor_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'harga' => $request->harga,
            'kapasitas' => $request->kapasitas,
            'fasilitas' => $request->fasilitas,
            'status' => $request->status,
        ];


        // =========================
        // JIKA PERBAIKAN
        // =========================
        if ($request->status === 'perbaikan') {

            $data['keterangan_perbaikan'] =
                $request->keterangan_perbaikan;

            // Tetap dianggap tersembunyi
            // tetapi index tamu tetap mengambil
            // kamar dengan status perbaikan.
            $data['tampil'] = false;
        }


        // =========================
        // JIKA TERSEDIA
        // =========================
        else {

            $data['keterangan_perbaikan'] = null;

            // Kembali tampil di halaman tamu
            $data['tampil'] = true;
        }


        // =========================
        // GANTI FOTO JIKA ADA
        // =========================
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $namaFoto =
                time() . '_' .
                $file->getClientOriginalName();

            $file->move(
                public_path('kamar'),
                $namaFoto
            );

            $data['foto'] = $namaFoto;
        }


        $kamar->update($data);


        return redirect('/admin/kamar')
            ->with(
                'success',
                'Data kamar berhasil diubah.'
            );
    }


    // =========================
    // HAPUS KAMAR
    // =========================
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);

        $kamar->delete();

        return redirect('/admin/kamar')
            ->with(
                'success',
                'Data kamar berhasil dihapus.'
            );
    }
}