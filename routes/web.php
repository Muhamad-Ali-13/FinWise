<?php

use App\Http\Controllers\kategoriContoller;
use App\Http\Controllers\Metode_pembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Target_pembayaranController;
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
Route::resource('target_pembayaran', Target_pembayaranController::class)->middleware('auth');
Route::resource('transaksi', TransaksiController::class)->middleware('auth');
Route::get('/paket/{id}', [kategoriContoller::class, 'getJenis']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
