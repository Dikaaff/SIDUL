<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $nik = fake()->unique()->numerify('19########');
    return [
        'user_id' => User::factory()->create([
            'username' => $nik,
            // 'password' => 'password123',
            'password' => Hash::make('password123'),
            'role' => 'dosen'
        ])->id,

        'nik' => $nik,
        'nama' => fake()->name()
    ];
}
}
