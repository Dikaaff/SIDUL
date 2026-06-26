<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DosenSeeder::class,
            MahasiswaSeeder::class,
            MagangSeeder::class,
            PesertaMagangSeeder::class,
            LogbookSeeder::class,
            LaporanSeeder::class,
        ]);
    }
}
