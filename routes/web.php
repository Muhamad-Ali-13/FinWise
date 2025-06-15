<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\kategoriContoller;
use App\Http\Controllers\LaporanPemasukanController;
use App\Http\Controllers\LaporanPengeluaranController;
use App\Http\Controllers\LaporanTabunganController;
use App\Http\Controllers\Metode_pembayaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('kategori', kategoriContoller::class)->middleware(['auth', UserMiddleware::class]);
Route::resource('metode_pembayaran', Metode_pembayaranController::class)->middleware('auth', UserMiddleware::class);
Route::get('/metode_pembayaran/create', [Metode_pembayaranController::class, 'create'])->name('metode_pembayaran.create');
Route::get('/metode_pembayaran/check-name/{name}', [Metode_pembayaranController::class, 'checkName']);
Route::resource('transaksi', TransaksiController::class)->middleware('auth');
Route::resource('pemasukan', PemasukanController::class);
Route::resource('pengeluaran', PengeluaranController::class);
Route::resource('tabungan', TabunganController::class);
Route::get('/pemasukan/create', [PemasukanController::class, 'create'])->name('pemasukan.create');
Route::post('/pemasukan', [PemasukanController::class, 'store'])->name('pemasukan.store');
Route::delete('/Kategori/{id}', [kategoriContoller::class, 'destroy'])->name('Kategori.destroy');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::resource('laporanPemasukan', LaporanPemasukanController::class)->middleware(['auth']);
Route::resource('laporanPengeluaran', LaporanPengeluaranController::class)->middleware(['auth']);
Route::resource('laporanTabungan', LaporanTabunganController::class)->middleware(['auth']);

Route::resource('error', ErrorController::class);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/pemasukan/create', [PemasukanController::class, 'create'])->name('pemasukan.create');
    Route::post('/pemasukan', [PemasukanController::class, 'store'])->name('pemasukan.store');
    
});

require __DIR__.'/auth.php';
