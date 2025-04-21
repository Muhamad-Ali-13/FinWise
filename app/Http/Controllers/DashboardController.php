<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $totalPemasukan = Pemasukan::where('user_id', $userId)->sum('jumlah');
        $totalPengeluaran = Pengeluaran::where('user_id', $userId)->sum('jumlah');
        $totalTabungan = Tabungan::where('user_id', $userId)->sum('jumlah');

        return view('dashboard', compact('totalPemasukan', 'totalPengeluaran', 'totalTabungan'));
    }
}
