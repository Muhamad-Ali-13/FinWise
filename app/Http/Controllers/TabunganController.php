<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use App\Models\User;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    public function index()
    {
        try {
            $tabungan = Tabungan::paginate(5);
            $users = User::all();
            return view('page.tabungan.index')->with([
                'tabungan' => $tabungan,
                'users' => $users,
            ]);
        } catch (\Exception $e) {
            echo "<script>console.log(' PHP Error: " .
                addslashes($e->getMessage()) . "')</script>";
            return view('error.index');
        }
    }


    public function store(Request $request)
    {
        try {
            // Validasi data
            $data = [
                'user_id' => $request->user_id,
                'jumlah' => $request->jumlah,
                'tujuan' => $request->tujuan,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
            ];
            // Menambahkan data tabungan
            Tabungan::create($data);
            return redirect()
                ->route('tabungan.index')
                ->with('message_insert', 'Data Tabungan Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->route('tabungan.index')
                ->with('error_message', 'Terjadi kesalahan
            saat menambahkan data tabungan.:' . $e->getMessage());
        }
    }

    public function show(Tabungan $tabungan) {}

    public function update(Request $request, Tabungan $tabungan)
    {
        try {
            // Validasi data
            $data = [
                'user_id' => $request->user_id,
                'jumlah' => $request->jumlah,
                'tujuan' => $request->tujuan,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
            ];
            // Menambahkan data tabungan
            $tabungan->update($data);
            return redirect()
                ->route('tabungan.index')
                ->with('message_insert', 'Data Tabungan Berhasil Diubah');
        } catch (\Exception $e) {
            return redirect()
                ->route('tabungan.index')
                ->with('error_message', 'Terjadi kesalahan
            saat mengubah data tabungan.:' . $e->getMessage());
        }
    }

    public function destroy(Tabungan $tabungan)
    {
        try {
            $tabungan->delete();
            return redirect()
                ->route('tabungan.index')
                ->with('message_insert', 'Data Tabungan Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('tabungan.index')
                ->with('error_message', 'Terjadi kesalahan
            saat menghapus data tabungan.:' . $e->getMessage());
        }
    }
}
