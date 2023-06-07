<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $guarded = ['id'];

    public $timestamps = false;

    // Relasi One-to-One dengan model User
    // Seorang guru memiliki satu entitas pengguna (user)
    public function user()
    {
        return $this->hasOne(User::class);
    }

    // Metode untuk memeriksa apakah guru memiliki akun atau terdaftar
    public function hasAccount()
    {
        return $this->user !== null;
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }


}
