<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\metode_pembayaran;
use App\Models\Pemasukan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::paginate(5);
        $users = User::all();
        $kategori = Kategori::all();
        $metode_pembayaran = metode_pembayaran::all();
        return view('page.pemasukan.index')->with([
            'pemasukan' => $pemasukan,
            'users' => $users,
            'kategori' => $kategori,
            'metode_pembayaran' => $metode_pembayaran,
        ]);
    }

    public function create()
    {
        // $kategori = Kategori::all();
        // $users = User::all();
        // $metode_pembayaran = metode_pembayaran::all();
        // return view('page.pemasukan.create')->with([
        //     'kategori' => $kategori,
        //     'users' => $users,
        //     'metode_pembayaran' => $metode_pembayaran,

        // ]); // Sesuaikan dengan nama file blade untuk form create
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
            // dd($data);
            Pemasukan::create($data);

            return redirect()
                ->route('pemasukan.index')
                ->with('message_insert', 'Data Pemasukan Berhasil Ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error inserting pemasukan: ' . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => Auth::id(),
            ]);
            return redirect()
                ->route('pemasukan.index')
                ->with('error_message', 'Terjadi kesalahan saat menambahkan data pemasukan: ' . $e->getMessage());
        }
    }

    public function show(Pemasukan $pemasukan) {}

    public function update(Request $request, Pemasukan $pemasukan)
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

            $pemasukan->update($data);

            return response()->json(['message' => 'Data berhasil diperbarui.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memperbarui data: ' . $e->getMessage()], 500);
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
