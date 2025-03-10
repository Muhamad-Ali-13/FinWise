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
        try {
            $kategori = Kategori::paginate(5);
            return view('page.kategori.index')->with([
                'Kategori' => $kategori,
            ]);
        } catch (\Exception $e) {
            echo "<script>console.log(' PHP Error: " .
                addslashes($e->getMessage()) . "')</script>";
            return view('error.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi data
            $data = [
                'nama_kategori' => $request->nama_kategori,
            ];
            // Menambahkan data kategori
            Kategori::create($data);
            return redirect()
                ->route('Kategori.index')
                ->with('message_insert', 'Data Kategori Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->route('kategori.index')
                ->with('error_message', 'Terjadi kesalahan
            saat menambahkan data kategori.:' . $e->getMessage());
        }
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
        try {
            // Validasi data
            $data = [
                'nama_kategori' => $request->nama_kategori,
            ];
            // Update data kategori
            $datas = Kategori::find($id);
            $datas->update($data);
            return redirect()
                ->route('kategori.index')
                ->with('message_update', 'Data Kategori Berhasil Diubah');
        } catch (\Exception $e) {
            return redirect()
                ->route('kategori.index')
                ->with('error_message', 'Terjadi kesalahan
            saat mengubah data kategori.:' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Hapus data kategori
            $data = Kategori::find($id);
            $data->delete();
            return back()->with('message_delete', 'Data Kategori Berhasil Dihapus');
        } catch (\Exception $e) {
            return back()->with('error_message', 'Terjadi kesalahan saat menghapus data kategori.:' . $e->getMessage());
        }
    }
}
