<?php

namespace Database\Factories;

use App\Models\Guru;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    protected $model = Guru::class;
    static $nip = 150010004000500100; // Nilai awal NIP


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$nip++; // Menambahkan +1 pada NIP

        return [
            'nip' => self::$nip,
            'nama' => $this->faker->name(),
            'jk' => $this->faker->randomElement(['L', 'P']),
        ];
    }
}
