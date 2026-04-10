<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SidulSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Mahasiswa Test
        $mahasiswaUserId = DB::table('users')->insertGetId([
            'name'       => 'Mahasiswa Test',
            'email'      => 'mahasiswa@sidul.com',
            'password'   => Hash::make('password123'),
            'role'       => 'mahasiswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('mahasiswas')->insert([
            'user_id'    => $mahasiswaUserId,
            'nim'        => '20210001',
            'prodi'      => 'Teknik Informatika',
            'semester'   => 7,
            'ipk'        => 3.75,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Akun Dosen Test
        $dosenUserId = DB::table('users')->insertGetId([
            'name'       => 'Dosen Test',
            'email'      => 'dosen@sidul.com',
            'password'   => Hash::make('password123'),
            'role'       => 'dosen',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('dosens')->insert([
            'user_id'    => $dosenUserId,
            'nidn'       => '0012345678',
            'prodi'      => 'Teknik Informatika',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Akun Operator Test
        $operatorUserId = DB::table('users')->insertGetId([
            'name'       => 'Operator Test',
            'email'      => 'operator@sidul.com',
            'password'   => Hash::make('password123'),
            'role'       => 'operator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('operators')->insert([
            'user_id'    => $operatorUserId,
            'nip'        => '199001012020011001',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
