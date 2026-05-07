<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SidulSeeder extends Seeder
{
    public function run(): void
    {
        // --- 0. ADMIN ---
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
            DB::table('users')->updateOrInsert(
                ['username' => $d['nik']],
                [
                    'name' => $d['nama'],
                    'password' => Hash::make('password123'),
                    'role' => 'dosen',
                    'created_at' => now(),
                ]
            );
            
            $uId = DB::table('users')->where('username', $d['nik'])->first()->id;
            
            DB::table('dosens')->updateOrInsert(
                ['nik' => $d['nik']],
                [
                    'user_id' => $uId,
                    'nama' => $d['nama'],
                    'created_at' => now(),
                ]
            );
            
            $dosenIds[] = DB::table('dosens')->where('nik', $d['nik'])->first()->id;
        }

        // --- 2. OPERATOR ---
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
        $mhs = [
            ['nim' => '20210001', 'nama' => 'Ahmad Fauzi', 'konsentrasi' => 'Web Development'],
            ['nim' => '12345678', 'nama' => 'Dika Afif', 'konsentrasi' => 'Web Development'],
            ['nim' => '23015010', 'nama' => 'Arbyan', 'konsentrasi' => 'Web Development'],
            ['nim' => '010101', 'nama' => 'Ayan234', 'konsentrasi' => 'Web Development'],
            ['nim' => '010102', 'nama' => 'lalaa', 'konsentrasi' => 'Web Development'],
            ['nim' => '010103', 'nama' => 'jaja', 'konsentrasi' => 'Web Development'],
            ['nim' => '010104', 'nama' => 'Ayasan', 'konsentrasi' => 'Web Development'],
            
            
        ];

        foreach ($mhs as $m) {
            DB::table('users')->updateOrInsert(
                ['username' => $m['nim']],
                [
                    'name' => $m['nama'],
                    'password' => Hash::make('password123'),
                    'role' => 'mahasiswa',
                    'created_at' => now(),
                ]
            );
            
            $uId = DB::table('users')->where('username', $m['nim'])->first()->id;
            
            DB::table('mahasiswas')->updateOrInsert(
                ['nim' => $m['nim']],
                [
                    'user_id' => $uId,
                    'nama' => $m['nama'],
                    'konsentrasi' => $m['konsentrasi'],
                    'dosen_wali_id' => $dosenIds[0],
                    'created_at' => now(),
                ]
            );
        }

        // --- 4. MAGANG DATA ---
        $m1 = DB::table('mahasiswas')->where('nim', '20210001')->first();
        
        DB::table('magangs')->updateOrInsert(
            ['kode_magang' => 'MGN-20210001-PEND'],
            [
                'dosen_pembimbing_id' => $dosenIds[1],
                'status_magang' => 'berjalan',
                'created_at' => now(),
            ]
        );
        
        $magang1 = DB::table('magangs')->where('kode_magang', 'MGN-20210001-PEND')->first()->id;
        
        DB::table('peserta_magangs')->updateOrInsert(
            ['mahasiswa_id' => $m1->id, 'magang_id' => $magang1],
            ['is_ketua' => true, 'created_at' => now()]
        );
    }
}
