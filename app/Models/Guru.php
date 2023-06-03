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

    public function user()
    {
        return $this->hasOne(User::class);
    }

    // Metode untuk memeriksa apakah guru memiliki akun atau terdaftar
    public function hasAccount()
    {
        return $this->user !== null;
    }
}
