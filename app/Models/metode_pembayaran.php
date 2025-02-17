<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metode_pembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayaran';

    protected $fillable = ['metode_pembayaran'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
