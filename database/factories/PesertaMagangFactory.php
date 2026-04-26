<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PesertaMagangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'magang_id' => \App\Models\Magang::inRandomOrder()->first()->id ?? \App\Models\Magang::factory(),
            'mahasiswa_id' => \App\Models\Mahasiswa::inRandomOrder()->first()->id ?? \App\Models\Mahasiswa::factory(),
            'is_ketua' => false
        ];
    }
}
