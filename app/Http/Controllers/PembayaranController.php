<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $tamu = auth()->user()->tamu;

        $reservasiId = session('reservasi_id');

        /*
        |--------------------------------------------------------------------------
        | CARI RESERVASI
        |--------------------------------------------------------------------------
        |
        | Pertama ambil dari session.
        | Kalau session kosong, cari reservasi milik tamu
        | yang belum memiliki pembayaran.
        |
        */

        $reservasi = null;

        if ($reservasiId) {

            $reservasi = Reservasi::with([
                'tamu',
                'kamar',
                'pembayaran'
            ])
                ->where('id', $reservasiId)
                ->where('tamu_id', $tamu->id)
                ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | JIKA SESSION KOSONG
        |--------------------------------------------------------------------------
        |
        | Cari reservasi terbaru yang:
        | - milik tamu yang sedang login
        | - status masih menunggu
        | - belum mempunyai pembayaran
        |
        */

        if (!$reservasi) {

            $reservasi = Reservasi::with([
                'tamu',
                'kamar',
                'pembayaran'
            ])
                ->where('tamu_id', $tamu->id)
                ->where('status', 'menunggu')
                ->whereDoesntHave('pembayaran')
                ->latest()
                ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | JIKA TIDAK ADA RESERVASI YANG BISA DIBAYAR
        |--------------------------------------------------------------------------
        */

        if (!$reservasi) {

            return redirect('/tamu')->with(
                'error',
                'Tidak ada reservasi yang perlu melakukan pembayaran.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | JIKA RESERVASI SUDAH MEMPUNYAI PEMBAYARAN
        |--------------------------------------------------------------------------
        |
        | Artinya tamu sudah melakukan pembayaran.
        | Tidak boleh melakukan pembayaran kedua.
        |
        */

        if ($reservasi->pembayaran) {

            return redirect('/tamu')->with(
                'error',
                'Reservasi ini sudah melakukan pembayaran. Silakan menunggu pemeriksaan Admin.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN SESSION
        |--------------------------------------------------------------------------
        */

        session([
            'reservasi_id' => $reservasi->id
        ]);


        /*
        |--------------------------------------------------------------------------
        | HITUNG JUMLAH MALAM
        |--------------------------------------------------------------------------
        */

        $jumlahMalam = 0;
        $totalPembayaran = 0;

        if ($reservasi->kamar) {

            $checkIn =
                Carbon::parse(
                    $reservasi->check_in
                );

            $checkOut =
                Carbon::parse(
                    $reservasi->check_out
                );

            $jumlahMalam =
                $checkIn->diffInDays(
                    $checkOut
                );

            $totalPembayaran =
                $reservasi->kamar->harga *
                $jumlahMalam;
        }


        return view(
            'tamu.pembayaran',
            compact(
                'reservasi',
                'jumlahMalam',
                'totalPembayaran'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | METODE PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function metode($metode)
    {
        $tamu = auth()->user()->tamu;

        $reservasiId =
            session('reservasi_id');


        /*
        |--------------------------------------------------------------------------
        | CARI RESERVASI DARI SESSION
        |--------------------------------------------------------------------------
        */

        $reservasi = null;

        if ($reservasiId) {

            $reservasi =
                Reservasi::with([
                    'tamu',
                    'kamar',
                    'pembayaran'
                ])
                    ->where(
                        'id',
                        $reservasiId
                    )
                    ->where(
                        'tamu_id',
                        $tamu->id
                    )
                    ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | SESSION KOSONG
        |--------------------------------------------------------------------------
        */

        if (!$reservasi) {

            $reservasi =
                Reservasi::with([
                    'tamu',
                    'kamar',
                    'pembayaran'
                ])
                    ->where(
                        'tamu_id',
                        $tamu->id
                    )
                    ->where(
                        'status',
                        'menunggu'
                    )
                    ->whereDoesntHave(
                        'pembayaran'
                    )
                    ->latest()
                    ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | RESERVASI TIDAK ADA
        |--------------------------------------------------------------------------
        */

        if (!$reservasi) {

            return redirect('/tamu')->with(
                'error',
                'Tidak ada reservasi yang perlu melakukan pembayaran.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SUDAH BAYAR
        |--------------------------------------------------------------------------
        */

        if ($reservasi->pembayaran) {

            return redirect('/tamu')->with(
                'error',
                'Reservasi ini sudah melakukan pembayaran. Silakan menunggu pemeriksaan Admin.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN SESSION
        |--------------------------------------------------------------------------
        */

        session([
            'reservasi_id' =>
                $reservasi->id
        ]);


        /*
        |--------------------------------------------------------------------------
        | HITUNG TOTAL
        |--------------------------------------------------------------------------
        */

        $checkIn =
            Carbon::parse(
                $reservasi->check_in
            );

        $checkOut =
            Carbon::parse(
                $reservasi->check_out
            );

        $jumlahMalam =
            $checkIn->diffInDays(
                $checkOut
            );

        $totalPembayaran =
            $reservasi->kamar->harga *
            $jumlahMalam;


        /*
        |--------------------------------------------------------------------------
        | NAMA METODE
        |--------------------------------------------------------------------------
        */

        $metodePembayaran = match ($metode) {

            'dana' =>
                'E-Wallet - DANA',

            'ovo' =>
                'E-Wallet - OVO',

            'gopay' =>
                'E-Wallet - GoPay',

            'bank' =>
                'Transfer Bank - Virtual Account',

            'qris' =>
                'QRIS',

            default =>
                abort(404),
        };


        /*
        |--------------------------------------------------------------------------
        | NOMOR E-WALLET
        |--------------------------------------------------------------------------
        */

        $nomorEwallet =
            '08087458679';


        /*
        |--------------------------------------------------------------------------
        | DATA BANK
        |--------------------------------------------------------------------------
        */

        $bank = [

            [
                'kode' =>
                    'bca',

                'nama' =>
                    'BCA',

                'va' =>
                    '123456789001',

                'url' =>
                    'https://www.bca.co.id'
            ],

            [
                'kode' =>
                    'bri',

                'nama' =>
                    'BRI',

                'va' =>
                    '123456789002',

                'url' =>
                    'https://bri.co.id'
            ],

            [
                'kode' =>
                    'bni',

                'nama' =>
                    'BNI',

                'va' =>
                    '123456789003',

                'url' =>
                    'https://www.bni.co.id'
            ],

            [
                'kode' =>
                    'mandiri',

                'nama' =>
                    'Mandiri',

                'va' =>
                    '123456789004',

                'url' =>
                    'https://www.bankmandiri.co.id'
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | BANK DIPILIH
        |--------------------------------------------------------------------------
        */

        $bankDipilih = null;

        if ($metode === 'bank') {

            $bankKode =
                request()->query(
                    'bank'
                );

            if ($bankKode) {

                foreach ($bank as $item) {

                    if (
                        $item['kode'] ===
                        $bankKode
                    ) {

                        $bankDipilih =
                            $item;

                        break;
                    }
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | QRIS
        |--------------------------------------------------------------------------
        */

        $qrisExpiredAt = null;

        if ($metode === 'qris') {

            $sessionKey =
                'qris_expired_at_' .
                $reservasi->id;


            if (
                request()->query(
                    'baru'
                ) == '1'
            ) {

                session()->forget(
                    $sessionKey
                );
            }


            if (
                !session()->has(
                    $sessionKey
                )
            ) {

                $qrisExpiredAt =
                    now()
                        ->addMinutes(5)
                        ->timestamp;

                session([
                    $sessionKey =>
                        $qrisExpiredAt
                ]);

            } else {

                $qrisExpiredAt =
                    session(
                        $sessionKey
                    );
            }


            if (
                now()->timestamp >=
                $qrisExpiredAt
            ) {

                $qrisExpiredAt =
                    now()
                        ->addMinutes(5)
                        ->timestamp;

                session([
                    $sessionKey =>
                        $qrisExpiredAt
                ]);
            }
        }


        return view(
            'tamu.metode-pembayaran',
            compact(
                'reservasi',
                'jumlahMalam',
                'totalPembayaran',
                'metodePembayaran',
                'metode',
                'nomorEwallet',
                'bank',
                'bankDipilih',
                'qrisExpiredAt'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'reservasi_id' =>
                'required|exists:reservasis,id',

            'metode' => [
                'required',

                'in:Transfer Bank - Virtual Account,E-Wallet - DANA,E-Wallet - OVO,E-Wallet - GoPay,QRIS'
            ],

            'bukti_pembayaran' =>
                'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $tamu =
            auth()->user()->tamu;


        /*
        |--------------------------------------------------------------------------
        | AMBIL RESERVASI MILIK TAMU
        |--------------------------------------------------------------------------
        */

        $reservasi =
            Reservasi::with('kamar')
                ->where(
                    'id',
                    $request->reservasi_id
                )
                ->where(
                    'tamu_id',
                    $tamu->id
                )
                ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | CEK SUDAH BAYAR ATAU BELUM
        |--------------------------------------------------------------------------
        */

        $sudahBayar =
            Pembayaran::where(
                'reservasi_id',
                $reservasi->id
            )->exists();


        if ($sudahBayar) {

            return redirect('/tamu')->with(
                'error',
                'Reservasi ini sudah melakukan pembayaran. Tidak dapat melakukan pembayaran lagi.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK KAMAR
        |--------------------------------------------------------------------------
        */

        if (!$reservasi->kamar) {

            return redirect('/tamu')->with(
                'error',
                'Kamar reservasi tidak ditemukan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | HITUNG MALAM
        |--------------------------------------------------------------------------
        */

        $checkIn =
            Carbon::parse(
                $reservasi->check_in
            );

        $checkOut =
            Carbon::parse(
                $reservasi->check_out
            );


        $jumlahMalam =
            $checkIn->diffInDays(
                $checkOut
            );


        if ($jumlahMalam <= 0) {

            return back()->withErrors([
                'reservasi_id' =>
                    'Tanggal check-out harus setelah tanggal check-in.'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | HITUNG TOTAL PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        $jumlah =
            $reservasi->kamar->harga *
            $jumlahMalam;


        /*
        |--------------------------------------------------------------------------
        | CEK QRIS
        |--------------------------------------------------------------------------
        */

        if ($request->metode === 'QRIS') {

            $sessionKey =
                'qris_expired_at_' .
                $reservasi->id;


            $qrisExpiredAt =
                session(
                    $sessionKey
                );


            if (!$qrisExpiredAt) {

                return redirect(
                    '/pembayaran/metode/qris'
                )->withErrors([
                    'metode' =>
                        'QRIS belum dibuat. Silakan buka QRIS terlebih dahulu.'
                ]);
            }


            if (
                now()->timestamp >=
                $qrisExpiredAt
            ) {

                session()->forget(
                    $sessionKey
                );


                return redirect(
                    '/pembayaran/metode/qris'
                )->withErrors([
                    'metode' =>
                        'QRIS sudah kedaluwarsa. Silakan buat QRIS baru.'
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN BUKTI PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        $bukti =
            $request
                ->file(
                    'bukti_pembayaran'
                )
                ->store(
                    'bukti-pembayaran',
                    'public'
                );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        Pembayaran::create([

            'reservasi_id' =>
                $reservasi->id,

            'jumlah' =>
                $jumlah,

            'metode' =>
                $request->metode,

            'tanggal' =>
                now(),

            'status' =>
                'menunggu',

            'bukti_pembayaran' =>
                $bukti,
        ]);


        /*
        |--------------------------------------------------------------------------
        | HAPUS SESSION
        |--------------------------------------------------------------------------
        |
        | Setelah pembayaran berhasil dikirim,
        | session pembayaran dihapus.
        |
        */

        session()->forget([
            'reservasi_id',

            'qris_expired_at_' .
                $reservasi->id
        ]);


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE DASHBOARD
        |--------------------------------------------------------------------------
        */

        return redirect('/tamu')->with(
            'success',
            'Pembayaran berhasil dikirim dan sedang menunggu pemeriksaan Admin.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | KUITANSI
    |--------------------------------------------------------------------------
    */

    public function kuitansi($id)
    {
        $tamu =
            auth()->user()->tamu;


        $pembayaran =
            Pembayaran::with([
                'reservasi.tamu',
                'reservasi.kamar'
            ])
                ->where(
                    'id',
                    $id
                )
                ->where(
                    'status',
                    'disetujui'
                )
                ->whereHas(
                    'reservasi',
                    function ($query) use ($tamu) {

                        $query->where(
                            'tamu_id',
                            $tamu->id
                        );

                    }
                )
                ->firstOrFail();


        $reservasi =
            $pembayaran->reservasi;


        return view(
            'tamu.kuitansi',
            compact(
                'pembayaran',
                'reservasi'
            )
        );
    }
}