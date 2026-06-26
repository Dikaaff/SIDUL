<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MagangFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kode_magang' => fn() => 'MGN-' . strtoupper(bin2hex(random_bytes(3))),
            'tipe_magang' => fake()->randomElement(['individu', 'kelompok']),
            'konsentrasi' => fake()->randomElement([
                'Web Development', 'Networking', '2D Animation',
            ]),
            'perusahaan' => fake()->company(),
            'alamat' => fake()->address(),
            'tanggal_mulai' => fake()->dateTimeBetween('-2 months', '-1 month'),
            'tanggal_selesai' => fake()->dateTimeBetween('+1 month', '+3 months'),
            'dosen_pembimbing_id' => null,
            'status_magang' => 'Pending',
        ];
    }
}
