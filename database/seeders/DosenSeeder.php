<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        foreach (UserSeeder::$connectedDosen as $data) {
            $user = User::where('username', $data['nik'])->first();

            Dosen::factory()->create([
                'user_id' => $user->id,
                'nik' => $data['nik'],
                'nama' => $data['nama'],
            ]);
        }

        foreach (UserSeeder::$notConnectedDosen as $data) {
            $user = User::where('username', $data['nik'])->first();

            Dosen::factory()->create([
                'user_id' => $user->id,
                'nik' => $data['nik'],
                'nama' => $data['nama'],
            ]);
        }
    }
}
