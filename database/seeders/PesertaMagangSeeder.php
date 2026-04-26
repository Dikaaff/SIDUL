<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesertaMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $magangs = \App\Models\Magang::all();
        $mahasiswas = \App\Models\Mahasiswa::all();

        foreach ($magangs as $magang) {
            $anggota = $mahasiswas->random(3);

            foreach ($anggota as $i => $mhs) {
                \App\Models\PesertaMagang::create([
                    'magang_id' => $magang->id,
                    'mahasiswa_id' => $mhs->id,
                    'is_ketua' => $i === 0
                ]);
            }
        }
    }
}
