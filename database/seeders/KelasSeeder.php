<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'tingkat_kelas' => 'X',
            'jurusan' => 'IPA',
            'nama' => '1',
            'tahun_masuk' => '2023',
            'tahun_keluar' => '2024',
        ]);
        Kelas::create([
            'tingkat_kelas' => 'XI',
            'jurusan' => 'IPS',
            'nama' => '1',
            'tahun_masuk' => '2022',
            'tahun_keluar' => '2023',
        ]);
        Kelas::create([
            'tingkat_kelas' => 'XII',
            'jurusan' => 'AGAMA',
            'nama' => '1',
            'tahun_masuk' => '2021',
            'tahun_keluar' => '2022',
        ]);
    }
}
