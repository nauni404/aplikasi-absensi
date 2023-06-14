<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $guarded = ['id'];

    public $timestamps = false;

    // Relasi Many-to-One dengan model Siswa // 1 Absensi dimiliki oleh 1 siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi Many-to-One dengan model Guru // 1 Absensi dimiliki oleh 1 guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // Relasi Many-to-One dengan model Kelas

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
