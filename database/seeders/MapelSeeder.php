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
        Mapel::create([
            'nama' => 'Matematika',
        ]);
        Mapel::create([
            'nama' => 'Bahasa Arab',
        ]);
        Mapel::create([
            'nama' => 'Bahasa Indonesia',
        ]);
    }
}
