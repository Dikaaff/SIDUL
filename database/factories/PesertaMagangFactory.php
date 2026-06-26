<?php

namespace Database\Factories;

use App\Models\Magang;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class PesertaMagangFactory extends Factory
{
    public function definition(): array
    {
        return [
            'magang_id' => Magang::factory(),
            'mahasiswa_id' => Mahasiswa::factory(),
            'is_ketua' => false,
        ];
    }
}
