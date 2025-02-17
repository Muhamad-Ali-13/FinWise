<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_user',
        'id_kategori',
        'jumlah',
        'keterangan',
        'tanggal',
        'metode_pembayaran_id'
    ];

    protected $table = 'transaksi';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function metodePembayaran()
    {
        return $this->belongsTo(metode_pembayaran::class);
    }
}

