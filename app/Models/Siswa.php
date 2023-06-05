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

    // Relasi One-to-One dengan model User
    // Seorang siswa memiliki satu entitas pengguna (user)
    public function user()
    {
        return $this->hasOne(User::class);
    }

    // Metode untuk memeriksa apakah siswa memiliki akun atau terdaftar
    public function hasAccount()
    {
        return $this->user !== null;
    }

    // Relasi Many-to-One dengan model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi One-to-Many dengan model Absensi // 1 Siswa memiliki banyak data Absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
