<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SidulSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Dosen Test
        $dosenUserId = DB::table('users')->insertGetId([
            'name'       => 'Dosen Test',
            'username'   => '19876001', // NIK
            'password'   => Hash::make('password123'),
            'role'       => 'dosen',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $dosenId = DB::table('dosens')->insertGetId([
            'user_id'    => $dosenUserId,
            'nik'        => '19876001',
            'nama'       => 'Dosen Test',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Akun Mahasiswa Test
        $mahasiswaUserId = DB::table('users')->insertGetId([
            'name'       => 'Mahasiswa Test',
            'username'   => '20210001', // NIM
            'password'   => Hash::make('password123'),
            'role'       => 'mahasiswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $mahasiswaId = DB::table('mahasiswas')->insertGetId([
            'user_id'       => $mahasiswaUserId,
            'nim'           => '20210001',
            'nama'          => 'Mahasiswa Test',
            'dosen_wali_id' => $dosenId,
            'status_magang' => 'Pending',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // 4. Data Magang Test (Mahasiswa ini sudah mendaftar)
        $magangId = DB::table('magangs')->insertGetId([
            'kode_magang' => 'MGN-20210001-A1B2C',
            'nim' => '20210001',
            'perusahaan' => 'PT. Teknologi Masa Depan',
            'alamat' => 'Jl. Digital No. 101, Jakarta',
            'tanggal_mulai' => '2026-04-01',
            'tanggal_selesai' => '2026-07-01',
            'konsentrasi' => 'Web Development',
            'tipe_magang' => 'individu',
            'link_bukti_magang' => 'https://drive.google.com/test-bukti',
            'link_survey_perusahaan' => 'https://forms.gle/test-survey',
            'status_magang' => 'Approve',
            'dosen_pembimbing_id' => $dosenId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('peserta_magangs')->insert([
            'id_mahasiswa' => $mahasiswaId,
            'id_magang' => $magangId,
            'nim' => '20210001',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 5. Data Logbook Test
        DB::table('logbooks')->insert([
            [
                'id_magang' => $magangId,
                'logbook' => 'Hari pertama: Setup environment Laravel dan mempelajari struktur database.',
                'catatan_dosen' => 'Bagus, lanjutkan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_magang' => $magangId,
                'logbook' => 'Hari kedua: Membuat layout dashboard menggunakan TailwindCSS.',
                'catatan_dosen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
