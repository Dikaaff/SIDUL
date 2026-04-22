<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_magang' => \App\Models\Magang::inRandomOrder()->first()->id_magang,
            'judul' => 'Laporan Magang',
            'bab1' => fake()->paragraph(),
            'bab2' => fake()->paragraph(),
            'bab3' => fake()->paragraph(),
            'bab4' => fake()->paragraph(),
            'status' => 'review'
        ];
    }
}
