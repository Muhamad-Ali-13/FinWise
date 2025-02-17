<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class kategoriContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::paginate(5);
        return view('page.kategori.index')->with([
            'Kategori' => $kategori,
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
            'id_kategori' => $request->input('id_kategori'),
            'nama_kategori' => $request->input('nama_kategori'),
        ];

        Kategori::create($data);

        return back()->with('success', 'Data Kategori Sudah ditambahkan');
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
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        
        // Validasi data
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
    
        // Update data kategori
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
    
        return redirect()->back()->with('message_update', 'Kategori berhasil diperbarui.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kategori::findOrFail($id);
        $data->delete();
        return back()->with('message_delete', 'Data Kategori Sudah dihapus');
    }
}
