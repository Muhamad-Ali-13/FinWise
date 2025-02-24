<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::paginate(5);
        return view('page.pengeluaran.index')->with([
            'pengeluaran' => $pengeluaran,
        ]);
    }

    public function create()
    {
        return view('page.pengeluaran.create'); // Sesuaikan dengan file blade untuk form create
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

        Pengeluaran::create([
            'user_id' => Auth::id(), // Ambil user_id dari user yang login
            'kategori_id' => $validated['kategori_id'],
            'jumlah' => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'keterangan' => $validated['keterangan'],
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    public function show(Pengeluaran $pengeluaran)
    {
        return response()->json($pengeluaran->load(['user', 'kategori', 'metodePembayaran']));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'metode_pembayaran' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $pengeluaran->update($validated);
        return response()->json($pengeluaran);
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return response()->json(['message' => 'Pengeluaran deleted']);
    }
}
