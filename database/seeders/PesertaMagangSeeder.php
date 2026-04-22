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
                    'id_magang' => $magang->id_magang,
                    'id_mahasiswa' => $mhs->id_mahasiswa,
                    'is_ketua' => $i === 0
                ]);
            }
        }
    }
}
