<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $magangs = \App\Models\Magang::all();

        foreach ($magangs as $magang) {
            \App\Models\Laporan::create([
                'magang_id' => $magang->id,
                'judul' => 'Laporan ' . $magang->kode_magang,
                'bab1' => 'Bab 1',
                'bab2' => 'Bab 2',
                'bab3' => 'Bab 3',
                'bab4' => 'Bab 4',
                'status' => 'review'
            ]);
        }
    }
}
