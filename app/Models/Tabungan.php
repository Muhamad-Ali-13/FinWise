<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model {
    use HasFactory;

    protected $table = 'tabungan';
    protected $fillable = [
        'user_id',
        'jumlah',
        'tujuan',
        'tanggal',
        'keterangan',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
