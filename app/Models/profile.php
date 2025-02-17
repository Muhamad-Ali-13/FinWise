<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = ['user_id', 'alamat', 'no_hp', 'foto_profil'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
