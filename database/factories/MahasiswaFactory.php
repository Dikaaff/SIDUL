<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $nim = fake()->unique()->numerify('23.01.5###');
    return [
        'user_id' => User::factory()->create([
            'username' => $nim,
            // 'password' =>'password123',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa'
        ])->id,

        'nim' => $nim,
        'nama' => fake()->name(),
        'prodi' => 'Informatika',
        'dosen_wali_id' => Dosen::inRandomOrder()->first()->id
    ];
}
}
