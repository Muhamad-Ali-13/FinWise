<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{

    public function pemasukan()
    {
        $data = Pemasukan::where('user_id', Auth::id())->latest()->get();
        return view('laporan.pemasukan');
    }

    public function pengeluaran()
    {
        $data = Pengeluaran::where('user_id', Auth::id())->latest()->get();
        return view('laporan.pengeluaran');
    }

    public function tabungan()
    {
        $data = Tabungan::where('user_id', Auth::id())->latest()->get();
        return view('laporan.tabungan');
    }
}
