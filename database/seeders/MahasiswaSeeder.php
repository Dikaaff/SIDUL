<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $connectedDosens = Dosen::orderBy('id')->limit(5)->get();

        foreach (UserSeeder::$mahasiswa as $i => $mhs) {
            $user = User::where('username', $mhs['nim'])->first();

            $status = $i < 10 ? 'Pending' : 'Approve';
            $dosenWali = $connectedDosens[$i % 5];

            Mahasiswa::factory()->create([
                'user_id' => $user->id,
                'nim' => $mhs['nim'],
                'nama' => $mhs['nama'],
                'status_daftar' => $status,
                'dosen_wali_id' => $dosenWali->id,
            ]);
        }
    }
}
