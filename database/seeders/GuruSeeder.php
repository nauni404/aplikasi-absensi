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
            'nip' => '151020304050607080',
            'nama' => 'Bambang Suparno',
            'jk' => 'L',
        ]);

        Guru::create([
            'nip' => '151020304050607081',
            'nama' => 'Siti Rahayu',
            'jk' => 'P',
        ]);

        Guru::create([
            'nip' => '151020304050607082',
            'nama' => 'Slamet Santoso',
            'jk' => 'L',
        ]);
        Guru::create([
            'nip' => '151020304050607083',
            'nama' => 'Rini Wulandari',
            'jk' => 'P',
        ]);

        Guru::create([
            'nip' => '151020304050607084',
            'nama' => 'Joko Prasetyo',
            'jk' => 'L',
        ]);

        Guru::create([
            'nip' => '151020304050607085',
            'nama' => 'Tri Utami',
            'jk' => 'P',
        ]);
        Guru::create([
            'nip' => '151020304050607086',
            'nama' => 'Heru Nugroho',
            'jk' => 'L',
        ]);

        Guru::create([
            'nip' => '151020304050607087',
            'nama' => 'Ratna Sari',
            'jk' => 'P',
        ]);

        Guru::create([
            'nip' => '151020304050607088',
            'nama' => 'Slamet Riyadi',
            'jk' => 'L',
        ]);

        Guru::create([
            'nip' => '151020304050607089',
            'nama' => 'Dewi Anggraini',
            'jk' => 'P',
        ]);
    }
}
