<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pemasukan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::paginate(5);
        $users = User::all();
        $kategori = Kategori::all();
        return view('page.pemasukan.index')->with([
            'pemasukan' => $pemasukan,
            'users' => $users,
            'kategori' => $kategori,
        ]);
    }

    public function create()
    {
        return view('page.pemasukan.create'); // Sesuaikan dengan nama file blade untuk form create
    }


    public function store(Request $request)
    {
        try {
            $data = [
                'user_id' => $request->user_id,
                'kategori_id' => $request->kategori_id,
                'jumlah' => $request->jumlah,
                'tanggal' => $request->tanggal,
                'metode_pembayaran' => $request->metode_pembayaran,
                'keterangan' => $request->keterangan,
            ];
            Pemasukan::create($data);
            return redirect()
                ->route('pemasukan.index')
                ->with('message_insert', 'Data Pemasukan Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->route('pemasukan.index')
                ->with('error_message', 'Terjadi kesalahan saat menambahkan data pemasukan: ' . $e->getMessage());
        }

    }

    public function show(Pemasukan $pemasukan)
    {
    
    }

    public function update(Request $request, Pemasukan $pemasukan)
    {
        try {
            $data = [
                'user_id' => $request->user_id,
                'kategori_id' => $request->kategori_id,
                'jumlah' => $request->jumlah,
                'tanggal' => $request->tanggal,
                'metode_pembayaran' => $request->metode_pembayaran,
                'keterangan' => $request->keterangan,
            ];
            $pemasukan->update($data);
            return redirect()
                ->route('pemasukan.index')
                ->with('message_update', 'Data Pemasukan Berhasil Diupdate');
        } catch (\Exception $e) {
            return redirect()
                ->route('pemasukan.index')
                ->with('error_message', 'Terjadi kesalahan saat mengupdate data pemasukan: ' . $e->getMessage());
        }
    }

    public function destroy(Pemasukan $pemasukan)
    {
        try {
            $pemasukan->delete();
            return redirect()
                ->route('pemasukan.index')
                ->with('message_delete', 'Data Pemasukan Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('pemasukan.index')
                ->with('error_message', 'Terjadi kesalahan saat menghapus data pemasukan: ' . $e->getMessage());    
        }
    }
}
