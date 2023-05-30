<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $guarded = ['id'];

    public $timestamps = false;

    // Mendefinisikan relasi antara Siswa dengan User (asumsi menggunakan relasi One-to-One)
    public function user()
    {
        return $this->hasOne(User::class);
    }

    // Metode untuk memeriksa apakah siswa memiliki akun atau terdaftar
    public function hasAccount()
    {
        return $this->user !== null;
    }
}
