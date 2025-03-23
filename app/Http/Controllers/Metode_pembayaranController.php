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
        try {
            $metode = metode_pembayaran::paginate(3);
            return view('page.metodeP.index')->with([
                'metode' => $metode,
            ]);
        } catch (\Exception $e) {
            echo "<script>console.log(' PHP Error: ".
            addslashes($e->getMessage())."')</script>";
            return view('error.index');
        }
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
        try {
            // Validasi data
            $data = [
                'metode_pembayaran' => $request->metode_pembayaran,
            ];
            // Menambahkan data kategori
            metode_pembayaran::create($data);
            return redirect()
                ->route('metode_pembayaran.index')
                ->with('message_insert', 'Data Metode Pembayaran Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->route('metode_pembayaran.index')
                ->with('error_message', 'Terjadi Kesalahan
            Saat Menambahkan Data Metode Pembayaran:' . $e->getMessage());
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
    public function update(Request $request, string $id)
    {
        try {
            // Validasi data
            $data = [
                'metode_pembayaran' => $request->metode_pembayaran,
            ];
            // Update data kategori
            $datas = metode_pembayaran::find($id);
            $datas->update($data);
            return redirect()
                ->route('metode_pembayaran.index')
                ->with('message_update', 'Data Metode Pembayaran Berhasil Diubah');
        } catch (\Exception $e) {
            return redirect()
                ->route('metode_pembayaran.index')
                ->with('error_message', 'Terjadi Kesalahan
            Saat Mengubah Data Metode Pembayaran:' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Hapus data kategori
            metode_pembayaran::where('id', $id)->delete();
            return back()->with('message_delete', 'Data Metode Pembayaran Berhasil Dihapus');
        } catch (\Exception $e) {
            return back()->with('error_message', 'Terjadi Kesalahan
            Saat Menghapus Data Metode Pembayaran:' . $e->getMessage());
        }
    }
}
