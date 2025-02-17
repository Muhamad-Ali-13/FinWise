<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class target_pembayaran extends Model
{

    use HasFactory;

    protected $table = 'target_pembayaran';

    protected $fillable = [
        'nama_target',
        'id_user',
        'id_kategori', 
        'jumlah_target', 
        'periode'];


    public function kategori(){
        return $this->belongsTo(target_pembayaran::class, 'id_kategori', 'id');
    }
    public function user(){
        return $this->belongsTo(target_pembayaran::class, 'id_user', 'id');
    }
}

