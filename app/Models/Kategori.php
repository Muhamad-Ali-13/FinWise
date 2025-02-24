<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;


    protected $table = 'kategori';

    protected $fillable = ['nama_kategori'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function create()
    {
        // Generate ID otomatis (contoh: PM001, PM002, dst.)
        $lastPemasukan = Pemasukan::latest('id')->first();
        $lastId = $lastPemasukan ? intval(substr($lastPemasukan->id_pemasukan, 2)) + 1 : 1;
        $id_pemasukan = 'PM' . str_pad($lastId, 3, '0', STR_PAD_LEFT);

        // Ambil data kategori
        $kategori = Kategori::all();

        return view('pemasukan.create', compact('id_pemasukan', 'kategori'));
    }
}
