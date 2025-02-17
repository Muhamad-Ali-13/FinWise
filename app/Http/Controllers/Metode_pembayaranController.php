<?php

namespace App\Http\Controllers;

use App\Models\metode_pembayaran;
use App\Models\target_pembayaran;
use Illuminate\Http\Request;

class Metode_pembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodeP = metode_pembayaran::paginate(5);
        return view('page.metodeP.index')->with([
            'metodeP' => $metodeP,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'metode_pembayaran' => $request->input('metode_pembayaran'),
        ];

        metode_pembayaran::create($data);

        return back()->with('success', 'Data Metode Pembayaran Sudah ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari data target pembayaran berdasarkan ID
        $targetP = target_pembayaran::findOrFail($id);

        // Validasi data input
        $request->validate([
            'id_user' => 'required|exists:users,id', // Pastikan id_user ada di tabel users
            'id_kategori' => 'required|exists:kategori,id', // Pastikan id_kategori ada di tabel kategori
            'jumlah_target' => 'required|numeric|min:0', // Jumlah target harus angka positif
            'periode' => 'required|string|max:255', // Periode harus string maksimal 255 karakter
        ]);

        // Update data target pembayaran
        $targetP->update([
            'id_user' => $request->id_user,
            'id_kategori' => $request->id_kategori,
            'jumlah_target' => $request->jumlah_target,
            'periode' => $request->periode,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('message_update', 'Target Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data target pembayaran berdasarkan ID
        $targetP = target_pembayaran::findOrFail($id);

        // Hapus data
        $targetP->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('message_delete', 'Target Pembayaran berhasil dihapus.');
    }
}
