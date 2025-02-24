<?php
namespace App\Http\Controllers;

use App\Models\Tabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller {
    public function index() {
        $tabungan = Tabungan::paginate(5);
        return view('page.tabungan.index')->with([
            'tabungan' => $tabungan,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jumlah' => 'required|numeric',
            'tujuan' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        return response()->json(Tabungan::create($request->all()), 201);
    }

    public function show(Tabungan $tabungan) {
        return response()->json($tabungan->load('user'));
    }

    public function update(Request $request, Tabungan $tabungan) {
        $tabungan->update($request->all());
        return response()->json($tabungan);
    }

    public function destroy(Tabungan $tabungan) {
        $tabungan->delete();
        return response()->json(['message' => 'Tabungan deleted']);
    }
}
