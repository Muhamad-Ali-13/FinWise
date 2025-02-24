<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model {
    use HasFactory;

    protected $table = 'pemasukan';
    protected $fillable = [
        'user_id',
        'kategori_id',
        'jumlah',
        'tanggal',
        'metode_pembayaran_id',
        'keterangan',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function metodePembayaran() {
        return $this->belongsTo(metode_pembayaran::class);
    }
}
