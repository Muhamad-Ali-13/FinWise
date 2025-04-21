<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\metode_pembayaran;
use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::paginate(5);
        $users = User::all();
        $kategori = Kategori::all();
        $metode_pembayaran = metode_pembayaran::all();
        return view('page.pengeluaran.index')->with([
            'pengeluaran' => $pengeluaran,
            'users' => $users,
            'kategori' => $kategori,
            'metode_pembayaran' => $metode_pembayaran,
        ]);
    }

    public function create()
    {
    //     $users = User::all();
    //     $kategori = Kategori::all();
    //     $metode_pembayaran = metode_pembayaran::all();
    //     return view('page.pengeluaran.create')->with([
    //         'kategori' => $kategori,
    //         'users' => $users,
    //         'metode_pembayaran' => $metode_pembayaran,
    //     ]); // Sesuaikan dengan nama file blade untuk form create
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'user_id' => $request->user_id,
                'kategori_id' => $request->kategori_id,
                'jumlah' => $request->jumlah,
                'tanggal' => $request->tanggal,
                'metode_pembayaran_id' => $request->metode_pembayaran_id,
                'keterangan' => $request->keterangan,
            ];
            
            Pengeluaran::create($data);
            return redirect()
                ->route('pengeluaran.index')
                ->with('message_insert', 'Data Pengeluaran Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->route('pengeluaran.index')
                ->with('error_message', 'Terjadi kesalahan saat menambahkan data pengeluaran: ' . $e->getMessage());
        }
    }

    public function show(Pengeluaran $pengeluaran)
    {
        // Tampilkan detail pengeluaran (opsional)
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        try {
            $data = [
                'user_id' => $request->edit_user_id,
                'kategori_id' => $request->kategori_id,
                'jumlah' => $request->jumlah,
                'tanggal' => $request->tanggal,
                'metode_pembayaran_id' => $request->metode_pembayaran_id,
                'keterangan' => $request->keterangan,
            ];
    
            $pengeluaran->update($data);
    
            return response()->json(['message' => 'Data berhasil diperbarui.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memperbarui data: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        try {
            $pengeluaran->delete();
            return redirect()
                ->route('pengeluaran.index')
                ->with('message_delete', 'Data Pengeluaran Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('pengeluaran.index')
                ->with('error_message', 'Terjadi kesalahan saat menghapus data pengeluaran: ' . $e->getMessage());
        }
    }
}