<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::paginate(5);
        $user_id = Auth::id();
        // $pemasukan = Pemasukan::where('user_id', $user_id)->paginate(5);
        return view('page.pemasukan.index')->with([
            'pemasukan' => $pemasukan,
        ]);
    }

    public function create()
    {
        return view('page.pemasukan.create'); // Sesuaikan dengan nama file blade untuk form create
    }


    public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id', // Validasi user_id dari tabel users
        'kategori_id' => 'required|exists:kategori,id', // Validasi kategori_id dari tabel kategori
        'jumlah' => 'required|numeric',
        'tanggal' => 'required|date',
        'metode_pembayaran' => 'required|string',
        'keterangan' => 'nullable|string',
    ]);

    Pemasukan::create([
        'user_id' => Auth::id(), // Ambil user_id dari user yang login
        'kategori_id' => $validated['kategori_id'],
        'jumlah' => $validated['jumlah'],
        'tanggal' => $validated['tanggal'],
        'metode_pembayaran' => $validated['metode_pembayaran'],
        'keterangan' => $validated['keterangan'],
    ]);

    return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil ditambahkan!');
}
    
    public function show(Pemasukan $pemasukan)
    {
        return response()->json($pemasukan->load(['user', 'kategori', 'metodePembayaran']));
    }

    public function update(Request $request, Pemasukan $pemasukan)
    {
        $pemasukan->update($request->all());
        return response()->json($pemasukan);
    }

    public function destroy(Pemasukan $pemasukan)
    {
        $pemasukan->delete();
        return response()->json(['message' => 'Pemasukan deleted']);
    }
}
