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
            'id_magang' => \App\Models\Magang::inRandomOrder()->first()->id_magang,
            'id_mahasiswa' => \App\Models\Mahasiswa::inRandomOrder()->first()->id_mahasiswa,
            'is_ketua' => false
        ];
    }
}
