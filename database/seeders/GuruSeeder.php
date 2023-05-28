<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guru::create([
            'nip' => '1800150010',
            'nama' => 'Chandra',
            'jk' => 'L',
            'mapel' => 'Matematika'
        ]);

        Guru::create([
            'nip' => '1800150011',
            'nama' => 'Fairuz Nabila',
            'jk' => 'P',
            'mapel' => 'Ekonomi'
        ]);

        Guru::create([
            'nip' => '1800150012',
            'nama' => 'Marsela',
            'jk' => 'P',
            'mapel' => 'Bahasa Arab'
        ]);
    }
}
