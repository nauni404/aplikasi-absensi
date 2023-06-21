<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MapelSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapels = [
            'Matematika',
            'Bahasa Indonesia',
            'Biologi',
            'Fisika',
            'Kimia',
            'Sejarah Indonesia',
            'Bahasa Inggris',
            'Pendidikan Agama Islam',
            'Geografi',
            'Seni Budaya',
            'Ekonomi',
            'Pendidikan Jasmani',
            'Bahasa Arab',
            'Al-Quran Hadits',
            'Aqidah Akhlak',
            'Sosiologi',
            'Bahasa Sunda',
            'Fiqih',
            'Pendidikan Kewarganegaraan',
        ];

        foreach ($mapels as $mapel) {
            Mapel::create([
                'nama' => $mapel,
            ]);
        }
    }
}
