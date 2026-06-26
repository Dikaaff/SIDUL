<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DosenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->dosen(),
            'nik' => fake()->unique()->numerify('19########'),
            'nama' => fake()->name(),
        ];
    }
}
