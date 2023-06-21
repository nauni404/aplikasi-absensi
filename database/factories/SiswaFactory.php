<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    protected $model = Siswa::class;
    static $nis = 2003010000;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$nis++; // Menambahkan +1 pada NIS

        return [
            'nis' => self::$nis,
            'nama' => $this->faker->firstName,
            'jk' => $this->faker->randomElement(['L', 'P']),
        ];
    }
}
