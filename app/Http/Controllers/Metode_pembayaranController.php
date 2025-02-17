<?php

namespace App\Http\Controllers;

use App\Models\metode_pembayaran;
use Illuminate\Http\Request;

class Metode_pembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metode = metode_pembayaran::paginate(5);
        return view('page.metodeP.index')->with([
            'metode' => $metode,
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
        $metode = metode_pembayaran::findOrFail($id);

        // Validasi data
        $request->validate([
            'metode_pembayaran' => 'required|string|max:255',
        ]);

        // Update data kategori
        $metode->update([
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->back()->with('message_update', 'Metode Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = metode_pembayaran::findOrFail($id);
        $data->delete();
        return back()->with('message_delete', 'Data Metode Pembayaran Sudah dihapus');
    }
}
