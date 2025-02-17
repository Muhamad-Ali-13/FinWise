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
        $targetP = target_pembayaran::findOrFail($id);

        // Validasi data
        $request->validate([
            'metode_pembayaran' => 'required|string|max:255',
        ]);

        // Update data kategori
        $targetP->update([
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->back()->with('message_update', 'Metode Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
