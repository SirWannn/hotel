<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KetersediaanController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\StatusReservasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AdminReservasiController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ManajerController;
use App\Http\Controllers\ManajerKamarController;
use App\Http\Controllers\ManajerTamuController;
use App\Http\Controllers\ManajerReservasiController;
use App\Http\Controllers\ManajerLaporanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RatingController;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingPageController::class, 'index']);


/*
|--------------------------------------------------------------------------
| KAMAR UNTUK TAMU
|--------------------------------------------------------------------------
*/

Route::get('/kamar', [KamarController::class, 'index']);

Route::get('/kamar/{id}', function ($id) {

    $kamar = \App\Models\Kamar::findOrFail($id);

    return view('tamu.detail-kamar', compact('kamar'));

});


/*
|--------------------------------------------------------------------------
| RESERVASI TAMU
|--------------------------------------------------------------------------
*/

Route::get('/reservasi', [ReservasiController::class, 'create']);

Route::post('/reservasi', [ReservasiController::class, 'store'])
    ->middleware('role:tamu');

Route::get('/reservasi/{id}/edit', [ReservasiController::class, 'edit'])
    ->middleware('role:tamu');

Route::put('/reservasi/{id}', [ReservasiController::class, 'update'])
    ->middleware('role:tamu');


/*
|--------------------------------------------------------------------------
| PEMBAYARAN TAMU
|--------------------------------------------------------------------------
*/

Route::get('/pembayaran', [PembayaranController::class, 'create'])
    ->middleware('role:tamu');

Route::post('/pembayaran', [PembayaranController::class, 'store'])
    ->middleware('role:tamu');

Route::get('/pembayaran/metode/{metode}', [PembayaranController::class, 'metode'])
    ->middleware('role:tamu');

Route::get('/pembayaran/{id}/kuitansi', [PembayaranController::class, 'kuitansi'])
    ->middleware('role:tamu');


/*
|--------------------------------------------------------------------------
| STATUS DAN KETERSEDIAAN TAMU
|--------------------------------------------------------------------------
*/

Route::get('/status-reservasi', [StatusReservasiController::class, 'index'])
    ->middleware('role:tamu')
    ->name('status.reservasi');

Route::get('/ketersediaan', [KetersediaanController::class, 'index'])
    ->middleware('role:tamu');

Route::get('/tamu', [ReservasiController::class, 'dashboard'])
    ->middleware('role:tamu');


    // =========================
// RATING KAMAR TAMU
// =========================

Route::post('/tamu/reservasi/{id}/rating', [
    RatingController::class,
    'store'
])->middleware('role:tamu')
  ->name('tamu.rating.store');

/*
|--------------------------------------------------------------------------
| PROFIL TAMU
|--------------------------------------------------------------------------
*/

Route::get('/profil', function () {

    return view('tamu.profil');

})->middleware('role:tamu');


/*
|--------------------------------------------------------------------------
| LOGIN & REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisterController::class, 'showRegister']);

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLogin']);

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('role:admin');


/*
|--------------------------------------------------------------------------
| DATA KAMAR ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/kamar', [KamarController::class, 'admin'])
    ->middleware('role:admin');

Route::get('/admin/kamar/tambah', [KamarController::class, 'create'])
    ->middleware('role:admin');

Route::post('/admin/kamar', [KamarController::class, 'store'])
    ->middleware('role:admin');

Route::get('/admin/kamar/{id}/edit', [KamarController::class, 'edit'])
    ->middleware('role:admin');

Route::put('/admin/kamar/{id}', [KamarController::class, 'update'])
    ->middleware('role:admin');

Route::delete('/admin/kamar/{id}', [KamarController::class, 'destroy'])
    ->middleware('role:admin');

Route::post('/admin/kamar/{id}/toggle-tampil', [KamarController::class, 'toggleTampil'])
    ->middleware('role:admin');


/*
|--------------------------------------------------------------------------
| DATA TAMU ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/tamu', [TamuController::class, 'index'])
    ->middleware('role:admin');


/*
|--------------------------------------------------------------------------
| DATA RESERVASI ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/reservasi', [AdminReservasiController::class, 'index'])
    ->middleware('role:admin');


/*
|--------------------------------------------------------------------------
| DATA PEMBAYARAN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/pembayaran', [AdminPembayaranController::class, 'index'])
    ->middleware('role:admin');

Route::post('/admin/pembayaran/{id}/setuju', [AdminPembayaranController::class, 'setuju'])
    ->middleware('role:admin');

Route::post('/admin/pembayaran/{id}/tolak', [AdminPembayaranController::class, 'tolak'])
    ->middleware('role:admin');


/*
|--------------------------------------------------------------------------
| CHECK-IN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/checkin', [CheckinController::class, 'index'])
    ->middleware('role:admin');

Route::post('/admin/checkin/{id}', [CheckinController::class, 'checkin'])
    ->middleware('role:admin');


/*
|--------------------------------------------------------------------------
| CHECK-OUT ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/checkout', [CheckoutController::class, 'index'])
    ->middleware('role:admin');

Route::post('/admin/checkout/{id}', [CheckoutController::class, 'checkout'])
    ->middleware('role:admin');


/*
|--------------------------------------------------------------------------
| LAPORAN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/laporan', [LaporanController::class, 'index'])
    ->middleware('role:admin');


/*
|--------------------------------------------------------------------------
| DASHBOARD MANAJER
|--------------------------------------------------------------------------
*/

Route::get('/manajer', [ManajerController::class, 'index'])
    ->middleware('role:manajer');

Route::get('/manajer/kamar', [ManajerKamarController::class, 'index'])
    ->middleware('role:manajer');

Route::get('/manajer/tamu', [ManajerTamuController::class, 'index'])
    ->middleware('role:manajer');

Route::get('/manajer/reservasi', [ManajerReservasiController::class, 'index'])
    ->middleware('role:manajer');

Route::get('/manajer/laporan', [ManajerLaporanController::class, 'index'])
    ->middleware('role:manajer');

