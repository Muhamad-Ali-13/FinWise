<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Tabungan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'A' || $user->role === 'K') {
            $totalPemasukan = Pemasukan::sum('jumlah');
            $totalPengeluaran = Pengeluaran::sum('jumlah');
            $totalTabungan = Tabungan::sum('jumlah');
        } else {
            $totalPemasukan = Pemasukan::where('user_id', $user->id)->sum('jumlah');
            $totalPengeluaran = Pengeluaran::where('user_id', $user->id)->sum('jumlah');
            $totalTabungan = Tabungan::where('user_id', $user->id)->sum('jumlah');
        }

        $ringkasan = [
            'akses' => $user->role,
            'label' => $user->role === 'U' ? 'Transaksi Anda' : 'Semua Transaksi'
        ];

        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'totalTabungan',
            'ringkasan'
        ));
    }
}
