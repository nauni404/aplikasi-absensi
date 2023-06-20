<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Siswa::factory(120)->create();
        Guru::factory(19)->create();
        $this->call(UserSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(GuruSeeder::class);
    }
}
