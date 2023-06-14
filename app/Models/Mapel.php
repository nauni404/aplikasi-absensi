<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
