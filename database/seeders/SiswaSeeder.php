<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nis' => '2103010077',
            'nama' => 'Alfan',
            'jk' => 'L'
        ]);

        Siswa::create([
            'nis' => '2103010078',
            'nama' => 'Tia',
            'jk' => 'P'
        ]);

        Siswa::create([
            'nis' => '2103010079',
            'nama' => 'Naufal',
            'jk' => 'L'
        ]);
    }
}
