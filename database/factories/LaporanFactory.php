<?php

namespace Database\Factories;

use App\Models\Magang;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaporanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'magang_id' => Magang::factory(),
            'judul' => 'Laporan Magang - ' . fake()->sentence(3),
            'bab1' => fake()->paragraphs(3, true),
            'bab2' => fake()->paragraphs(3, true),
            'bab3' => fake()->paragraphs(3, true),
            'bab4' => fake()->paragraphs(3, true),
            'status' => 'draft',
            'catatan_dosen' => null,
        ];
    }
}
