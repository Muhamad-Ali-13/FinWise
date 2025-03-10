<?php

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\kategoriContoller;
use App\Http\Controllers\Metode_pembayaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('kategori', kategoriContoller::class)->middleware('auth');
Route::resource('metode_pembayaran', Metode_pembayaranController::class)->middleware('auth');
Route::get('/metode_pembayaran/check-name/{name}', [Metode_pembayaranController::class, 'checkName']);
Route::resource('transaksi', TransaksiController::class)->middleware('auth');
Route::resource('pemasukan', PemasukanController::class);
Route::resource('pengeluaran', PengeluaranController::class);
Route::resource('tabungan', TabunganController::class);
Route::get('/pemasukan/create', [PemasukanController::class, 'create'])->name('pemasukan.create');
Route::post('/pemasukan', [PemasukanController::class, 'store'])->name('pemasukan.store');

Route::delete('/Kategori/{id}', [kategoriContoller::class, 'destroy'])->name('Kategori.destroy');
// Route::get('/Kategori/check-name/{name}', [kategoriContoller::class, 'checkName'])->name('Kategori.checkName');

Route::resource('error', ErrorController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
