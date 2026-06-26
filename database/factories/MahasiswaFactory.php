<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->mahasiswa(),
            'nim' => fake()->unique()->numerify('23.##.####'),
            'nama' => fake()->name(),
            'status_daftar' => 'Pending',
            'dosen_wali_id' => null,
        ];
    }
}
