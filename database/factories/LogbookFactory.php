<?php

namespace Database\Factories;

use App\Models\Magang;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogbookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'magang_id' => Magang::factory(),
            'tanggal' => fake()->dateTimeBetween('-2 months', 'now'),
            'kegiatan' => fake()->paragraph(),
        ];
    }
}
