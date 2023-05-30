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

        Siswa::create([
            'nis' => '1',
            'nama' => 'A',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '2',
            'nama' => 'B',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '3',
            'nama' => 'C',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '4',
            'nama' => 'D',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '5',
            'nama' => 'E',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '6',
            'nama' => 'F',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '7',
            'nama' => 'G',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '8',
            'nama' => 'H',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '9',
            'nama' => 'i',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '10',
            'nama' => 'j',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '11',
            'nama' => 'k',
            'jk' => 'L'
        ]);
        Siswa::create([
            'nis' => '12',
            'nama' => 'l',
            'jk' => 'L'
        ]);
    }
}
