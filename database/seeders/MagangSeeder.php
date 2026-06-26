<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Magang;
use Illuminate\Database\Seeder;

class MagangSeeder extends Seeder
{
    public function run(): void
    {
        $connectedDosens = Dosen::orderBy('id')->limit(5)->get();
        $tahun = now()->year;

        $data = [
            [
                'tipe_magang' => 'kelompok',
                'perusahaan' => 'PT. Teknologi Maju',
                'alamat' => 'Jl. Sudirman No. 101, Jakarta',
                'konsentrasi' => 'Web Development',
            ],
            [
                'tipe_magang' => 'kelompok',
                'perusahaan' => 'CV. Kreatif Digital',
                'alamat' => 'Jl. Gatot Subroto No. 55, Bandung',
                'konsentrasi' => '2D Animation',
            ],
            [
                'tipe_magang' => 'kelompok',
                'perusahaan' => 'PT. Solusi Pintar',
                'alamat' => 'Jl. Ahmad Yani No. 32, Surabaya',
                'konsentrasi' => 'Networking',
            ],
            [
                'tipe_magang' => 'individu',
                'perusahaan' => 'PT. Inovasi Bangsa',
                'alamat' => 'Jl. Diponegoro No. 77, Yogyakarta',
                'konsentrasi' => 'Web Development',
            ],
            [
                'tipe_magang' => 'individu',
                'perusahaan' => 'CV. Media Cerdas',
                'alamat' => 'Jl. Pattimura No. 15, Semarang',
                'konsentrasi' => '2D Animation',
            ],
        ];

        foreach ($data as $i => $item) {
            $kode = "SIDUL-{$tahun}-" . str_pad($i + 1, 3, '0', STR_PAD_LEFT);

            Magang::factory()->create([
                'kode_magang' => $kode,
                'tipe_magang' => $item['tipe_magang'],
                'perusahaan' => $item['perusahaan'],
                'alamat' => $item['alamat'],
                'konsentrasi' => $item['konsentrasi'],
                'dosen_pembimbing_id' => $connectedDosens[$i]->id,
                'status_magang' => 'Aktif',
            ]);
        }
    }
}
