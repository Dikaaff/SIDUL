<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SidulSeeder extends Seeder
{
    public function run(): void
    {
        // --- 0. ADMIN (Username: admin) ---
        DB::table('users')->updateOrInsert(
            ['username' => 'admin'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
            ]
        );

        // --- 1. DOSENS ---
        $dosens = [
            ['nik' => '19876001', 'nama' => 'Dr. Aris Sudaryanto, M.T.'],
            ['nik' => '19876002', 'nama' => 'Siti Aminah, S.Kom., M.Cs.'],
        ];
        
        $dosenIds = [];
        foreach ($dosens as $d) {
            // Update or Insert User
            DB::table('users')->updateOrInsert(
                ['username' => $d['nik']],
                [
                    'name' => $d['nama'],
                    'password' => Hash::make('password123'),
                    'role' => 'dosen',
                    'created_at' => now(),
                ]
            );
            
            $uId = DB::table('users')->where('username', $d['nik'])->first()->id_user;
            
            // Update or Insert Dosen Profile
            DB::table('dosens')->updateOrInsert(
                ['nik' => $d['nik']],
                [
                    'user_id' => $uId,
                    'nama' => $d['nama'],
                    'created_at' => now(),
                ]
            );
            
            $dosenIds[] = DB::table('dosens')->where('nik', $d['nik'])->first()->id_dosen;
        }

        // --- 2. OPERATOR (Username: operator) ---
        DB::table('users')->updateOrInsert(
            ['username' => 'operator'],
            [
                'name' => 'Admin Operator',
                'password' => Hash::make('password123'),
                'role' => 'operator',
                'created_at' => now(),
            ]
        );

        // --- 3. MAHASISWAS ---
        
        // AKUN TESTING UTAMA (Username: 3311)
        DB::table('users')->updateOrInsert(
            ['username' => '3311'],
            [
                'name' => 'Mahasiswa Test 3311',
                'password' => Hash::make('akuakuaku'),
                'role' => 'mahasiswa',
                'created_at' => now(),
            ]
        );
        $m3311u = DB::table('users')->where('username', '3311')->first()->id_user;
        
        DB::table('mahasiswas')->updateOrInsert(
            ['nim' => '3311'],
            [
                'user_id' => $m3311u,
                'nama' => 'Mahasiswa Test 3311',
                'dosen_wali_id' => $dosenIds[0],
                'status_magang' => 'Approve',
                'created_at' => now(),
            ]
        );

        // MHS 1 (Username: 20210001)
        DB::table('users')->updateOrInsert(
            ['username' => '20210001'],
            [
                'name' => 'Ahmad Fauzi',
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa',
                'created_at' => now(),
            ]
        );
        $m1u = DB::table('users')->where('username', '20210001')->first()->id_user;
        
        DB::table('mahasiswas')->updateOrInsert(
            ['nim' => '20210001'],
            [
                'user_id' => $m1u,
                'nama' => 'Ahmad Fauzi',
                'dosen_wali_id' => $dosenIds[0],
                'status_magang' => 'Approve',
                'created_at' => now(),
            ]
        );

        // Tambahkan Magang Data untuk MHS 1
        $m1Id = DB::table('mahasiswas')->where('nim', '20210001')->first()->id_mahasiswa;
        DB::table('magangs')->updateOrInsert(
            ['kode_magang' => 'MGN-20210001-PEND'],
            [
                'nim' => '20210001',
                'perusahaan' => 'PT. Gojek Indonesia',
                'status_magang' => 'Pending',
                'created_at' => now(),
            ]
        );
        $magang1 = DB::table('magangs')->where('kode_magang', 'MGN-20210001-PEND')->first()->id_magang;
        
        DB::table('peserta_magangs')->updateOrInsert(
            ['id_mahasiswa' => $m1Id, 'id_magang' => $magang1],
            ['nim' => '20210001', 'created_at' => now()]
        );
    }
}
