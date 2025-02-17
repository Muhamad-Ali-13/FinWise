<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\target_pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Target_pembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $targetP = target_pembayaran::paginate(5);
        $kategoriP = Kategori::all();
        $user = User::all();
        return view('page.targetP.index')->with([
            'targetP' => $targetP,
            'kategoriP' => $kategoriP,
            'user' => $user,
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
            'nama_target' => $request->nama_target,
            'id_user' => Auth::user()->id,
            'id_kategori' => $request->id_kategori,
            'jumlah_target' => $request->jumlah_target,
            'periode' => $request->periode,
        ];

        target_pembayaran::create($data);

        return back()->with('success', 'Data Target Pembayaran Sudah ditambahkan');
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
            'nama_target' => 'required|string|max:255',
            'id_user' => 'required|exists:users,id', // Pastikan id_user ada di tabel users
            'id_kategori' => 'required|exists:kategori,id', // Pastikan id_kategori ada di tabel kategori
            'jumlah_target' => 'required|numeric|min:0', // Jumlah target harus angka positif
            'periode' => 'required|string|max:255', // Periode harus string maksimal 255 karakter
        ]);

        // Update data target pembayaran
        $targetP->update([
            'nama_target' => $request->nama_target,
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
        $data = target_pembayaran::findOrFail($id);
        $data->delete();
        return back()->with('message_delete', 'Data Metode Pembayaran Sudah dihapus');
    }
}
