<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        User::create([
            'username' => 'guru@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'guru'
        ]);

        User::create([
            'username' => 'siswa@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);

    }
}
