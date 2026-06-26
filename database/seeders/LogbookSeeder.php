<?php

namespace Database\Seeders;

use App\Models\Logbook;
use App\Models\Magang;
use Illuminate\Database\Seeder;

class LogbookSeeder extends Seeder
{
    public function run(): void
    {
        $magangs = Magang::orderBy('id')->get();
        $kegiatanList = [
            'Melakukan analisis kebutuhan sistem dan wawancara dengan client.',
            'Merancang database dan membuat Entity Relationship Diagram.',
            'Mengimplementasikan fitur autentikasi pengguna.',
            'Membuat halaman dashboard admin dengan tabel data dinamis.',
            'Melakukan pengujian unit pada modul yang telah selesai.',
            'Melakukan integrasi API pihak ketiga untuk layanan pembayaran.',
            'Memperbaiki bug pada fitur pencarian dan filtering data.',
            'Mengoptimasi query database yang lambat.',
            'Membuat dokumentasi teknis untuk modul yang sudah dikerjakan.',
            'Melakukan deploy aplikasi ke server staging dan testing.',
            'Mengembangkan fitur notifikasi real-time menggunakan WebSocket.',
            'Melakukan code review dan refactoring pada modul lama.',
            'Membuat laporan progress mingguan dan rencana kerja selanjutnya.',
        ];

        foreach ($magangs as $magang) {
            for ($i = 0; $i < 10; $i++) {
                Logbook::factory()->create([
                    'magang_id' => $magang->id,
                    'tanggal' => now()->subDays(9 - $i),
                    'kegiatan' => $kegiatanList[$i % count($kegiatanList)],
                ]);
            }
        }
    }
}
