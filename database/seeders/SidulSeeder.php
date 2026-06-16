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
                'password' => Hash::make('password123'),
                'role' => 'operator',
                'created_at' => now(),
            ]
        );

        // --- 3. MAHASISWAS ---
        $mhs = [
            ['nim' => '23.01.5029', 'nama' => 'Dika Afif', 'konsentrasi' => 'Web Development'],
            ['nim' => '23.01.5001', 'nama' => 'budi', 'konsentrasi' => 'Web Development'],
            ['nim' => '23.01.5002', 'nama' => 'joko', 'konsentrasi' => 'Web Development'],
            
        ];

        foreach ($mhs as $m) {
            DB::table('users')->updateOrInsert(
                ['username' => $m['nim']],
                [
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
                    'dosen_wali_id' => $dosenIds[0],
                    'created_at' => now(),
                ]
            );
        }
    }
}
