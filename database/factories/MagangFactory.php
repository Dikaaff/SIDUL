<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MagangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_magang' => fake()->unique()->bothify('MAG-###'),
            'id_dosen_pembimbing' => \App\Models\Dosen::inRandomOrder()->first()->id_dosen ?? \App\Models\Dosen::factory(),
            'status_magang' => 'berjalan'
        ];
    }
}
