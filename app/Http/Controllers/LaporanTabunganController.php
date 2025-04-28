<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use Illuminate\Http\Request;

class LaporanTabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page._laporan.tabungan');
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
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        $dari = date('Y-m-d', strtotime($dari));
        $sampai = date('Y-m-d', strtotime($sampai));    

        $data = Tabungan::whereBetween('tanggal', [$dari, $sampai])->get();
        return view('page._laporan.print')->with([
            'data' => $data,
            'dari' => $dari,
            'sampai' => $sampai,
        ]); 
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
