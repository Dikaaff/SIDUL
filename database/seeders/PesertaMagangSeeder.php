<?php

namespace Database\Seeders;

use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\PesertaMagang;
use Illuminate\Database\Seeder;

class PesertaMagangSeeder extends Seeder
{
    public function run(): void
    {
        $approvedMhs = Mahasiswa::where('status_daftar', 'Approve')
            ->orderBy('id')
            ->get();

        $magangs = Magang::orderBy('id')->get();

        $groups = [
            ['magang_index' => 0, 'mahasiswa_indices' => [0, 1, 2], 'ketua' => 0],
            ['magang_index' => 1, 'mahasiswa_indices' => [3, 4, 5], 'ketua' => 0],
            ['magang_index' => 2, 'mahasiswa_indices' => [6, 7], 'ketua' => 0],
            ['magang_index' => 3, 'mahasiswa_indices' => [8], 'ketua' => 0],
            ['magang_index' => 4, 'mahasiswa_indices' => [9], 'ketua' => 0],
        ];

        foreach ($groups as $group) {
            $magang = $magangs[$group['magang_index']];

            foreach ($group['mahasiswa_indices'] as $j => $mhsIdx) {
                PesertaMagang::factory()->create([
                    'magang_id' => $magang->id,
                    'mahasiswa_id' => $approvedMhs[$mhsIdx]->id,
                    'is_ketua' => $j === $group['ketua'],
                ]);
            }
        }

        $remainingMhs = $approvedMhs->slice(10);
        $availableMagangs = $magangs->slice(5);
        foreach ($remainingMhs as $i => $mhs) {
            if (!isset($availableMagangs[$i])) break;
            PesertaMagang::factory()->create([
                'magang_id' => $availableMagangs[$i]->id,
                'mahasiswa_id' => $mhs->id,
                'is_ketua' => true,
            ]);
        }
    }
}
