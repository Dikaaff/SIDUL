<?php

namespace Database\Factories;
use App\Models\Dosen;
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
            'dosen_pembimbing_id' => Dosen::inRandomOrder()->first()->id ?? Dosen::factory()->create()->id,
            'status_magang' => 'berjalan'
        ];
    }
}
