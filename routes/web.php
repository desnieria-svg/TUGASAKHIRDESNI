<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PreferensiController;

Route::get('/', [HomeController::class, 'index']);
Route::view('/tentang', 'tentang');
Route::view('/kontak', 'pages.kontak');

/* Login */
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/barang/search', [BarangController::class, 'search'])->name('barang.search');

    Route::get('/preferensi',        [PreferensiController::class, 'index'])->name('preferensi');
    Route::post('/preferensi/simpan',[PreferensiController::class, 'simpan'])->name('preferensi.simpan');

    Route::get('/reset-kunjungan', function () {
        session()->forget(['kunjungan','pertama_kunjungan','terakhir_kunjungan']);
        return redirect('/')->with('success','Hitungan kunjungan berhasil direset!');
    })->name('reset.kunjungan');

    /* Pesanan — user */
    Route::get('/checkout',               [PesananController::class, 'checkout'])->name('pesanan.checkout');
    Route::post('/pesanan',               [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/sukses/{pesanan}',[PesananController::class, 'sukses'])->name('pesanan.sukses');
    Route::get('/riwayat',                [PesananController::class, 'riwayat'])->name('pesanan.riwayat');
    Route::get('/pesanan/{pesanan}',      [PesananController::class, 'show'])->name('pesanan.show');
    Route::get('/pesanan/{pesanan}/bukti',[PesananController::class, 'buktiBayar'])->name('pesanan.bukti');

});

/* Admin only */
Route::middleware(['auth','cek.admin'])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::get('/admin/pesanan',                        [PesananController::class, 'adminIndex'])->name('admin.pesanan');
    Route::patch('/admin/pesanan/{pesanan}/status',      [PesananController::class, 'updateStatus'])->name('admin.pesanan.status');
    Route::patch('/admin/pesanan/{pesanan}/konfirmasi',  [PesananController::class, 'konfirmasiBayar'])->name('admin.pesanan.konfirmasi');
});
