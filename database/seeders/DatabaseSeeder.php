<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\PesertaMagang;
use App\Models\Laporan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Seed Database
        $this->call([
            UserSeeder::class,
            DosenSeeder::class,
            MahasiswaSeeder::class,
            MagangSeeder::class,
            PesertaMagangSeeder::class,
            LaporanSeeder::class,
        ]);
    }
}
