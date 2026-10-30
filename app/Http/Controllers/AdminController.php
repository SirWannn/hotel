<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Tamu;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // =========================
        // DATA KAMAR
        // =========================
        $totalKamar = Kamar::count();

        $kamarTersedia = Kamar::where(
            'status',
            'tersedia'
        )->count();

        $kamarPerbaikan = Kamar::where(
            'status',
            'perbaikan'
        )->count();


        // =========================
        // DATA TAMU
        // =========================
        $totalTamu = Tamu::count();


        // =========================
        // DATA RESERVASI
        // =========================
        $totalReservasi = Reservasi::count();

        $reservasis = Reservasi::with([
            'tamu',
            'kamar',
            'pembayaran'
        ])
            ->latest()
            ->take(5)
            ->get();


        // =========================
        // GRAFIK RESERVASI 6 BULAN
        // =========================
        $namaBulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];

        $reservasiBulanan = collect();

        $awalBulan = Carbon::now()
            ->startOfMonth()
            ->subMonths(5);

        for ($i = 0; $i < 6; $i++) {
            $tanggal = $awalBulan->copy()->addMonths($i);

            $jumlah = Reservasi::whereYear(
                'created_at',
                $tanggal->year
            )
                ->whereMonth(
                    'created_at',
                    $tanggal->month
                )
                ->count();

            $reservasiBulanan->push([
                'bulan' => $namaBulan[$tanggal->month],
                'tahun' => $tanggal->year,
                'jumlah' => $jumlah,
            ]);
        }


        // =========================
        // DATA PEMBAYARAN
        // =========================
        $totalPembayaran = Pembayaran::count();

        $totalPembayaranDisetujui = Pembayaran::where(
            'status',
            'disetujui'
        )->count();

        $totalUangMasuk = Pembayaran::where(
            'status',
            'disetujui'
        )->sum('jumlah');

        $totalPembayaranMenunggu = Pembayaran::where(
            'status',
            'menunggu'
        )->count();

        $totalUangMenunggu = Pembayaran::where(
            'status',
            'menunggu'
        )->sum('jumlah');


        // =========================
        // CHECK-IN & CHECK-OUT
        // =========================
        $totalCheckin = Reservasi::where(
            'status',
            'check-in'
        )->count();

        $totalCheckout = Reservasi::where(
            'status',
            'check-out'
        )->count();


        // =========================
        // LAPORAN
        // =========================
        $jumlahLaporan = 1;


        // =========================
        // TAMPILKAN DASHBOARD
        // =========================
        return view('admin.dashboard', compact(
            'totalKamar',
            'kamarTersedia',
            'kamarPerbaikan',
            'totalTamu',
            'totalReservasi',
            'reservasis',
            'reservasiBulanan',
            'totalPembayaran',
            'totalPembayaranDisetujui',
            'totalUangMasuk',
            'totalPembayaranMenunggu',
            'totalUangMenunggu',
            'totalCheckin',
            'totalCheckout',
            'jumlahLaporan'
        ));
    }
}
