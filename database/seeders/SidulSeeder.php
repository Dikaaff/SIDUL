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
            ['nim' => '23.01.5003', 'nama' => 'Ahmad Rizki Pratama', 'konsentrasi' => 'Web Development'],
            ['nim' => '23.01.5004', 'nama' => 'Bella Safira Dewi', 'konsentrasi' => 'Mobile Development'],
            ['nim' => '23.01.5005', 'nama' => 'Citra Lestari', 'konsentrasi' => 'UI/UX Design'],
            ['nim' => '23.01.5006', 'nama' => 'Dimas Ardiansyah', 'konsentrasi' => 'Data Science'],
            ['nim' => '23.01.5007', 'nama' => 'Eka Putri Handayani', 'konsentrasi' => 'Web Development'],
            ['nim' => '23.01.5008', 'nama' => 'Fajar Nugroho', 'konsentrasi' => 'Network Engineering'],
            ['nim' => '23.01.5009', 'nama' => 'Gita Permata Sari', 'konsentrasi' => 'Multimedia'],
            ['nim' => '23.01.5010', 'nama' => 'Hendra Gunawan', 'konsentrasi' => 'Game Development'],
            ['nim' => '23.01.5011', 'nama' => 'Indah Wulandari', 'konsentrasi' => 'Cyber Security'],
            ['nim' => '23.01.5012', 'nama' => 'Joko Susilo', 'konsentrasi' => 'Mobile Development'],
            ['nim' => '23.01.5013', 'nama' => 'Kartika Dewi', 'konsentrasi' => 'Artificial Intelligence'],
            ['nim' => '23.01.5014', 'nama' => 'Lukman Hakim', 'konsentrasi' => 'Software Engineering'],
            ['nim' => '23.01.5015', 'nama' => 'Mega Rahmawati', 'konsentrasi' => 'UI/UX Design'],
            ['nim' => '23.01.5016', 'nama' => 'Nanda Prasetyo', 'konsentrasi' => 'Web Development'],
            ['nim' => '23.01.5017', 'nama' => 'Oktavia Sari', 'konsentrasi' => 'Data Science'],
            ['nim' => '23.01.5018', 'nama' => 'Putra Ramadhan', 'konsentrasi' => 'Multimedia'],
            ['nim' => '23.01.5019', 'nama' => 'Rina Marlina', 'konsentrasi' => 'Network Engineering'],
            ['nim' => '23.01.5020', 'nama' => 'Satria Wirawan', 'konsentrasi' => 'Game Development'],
            ['nim' => '23.01.5021', 'nama' => 'Tania Febriani', 'konsentrasi' => 'Cyber Security'],
            ['nim' => '23.01.5022', 'nama' => 'Yoga Pratama', 'konsentrasi' => 'Artificial Intelligence'],
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
                    'status_daftar' => 'Approve',
                    'created_at' => now(),
                ]
            );
        }

        // --- 4. MAGANG + PESERTA + LAPORAN (for dosen pagination testing) ---
        DB::table('logbooks')->truncate();
        $mhsRecords = DB::table('mahasiswas')->where('dosen_wali_id', $dosenIds[0])->get();
        $konsentrasiList = ['Web Development', 'Mobile Development', 'UI/UX Design', 'Data Science', 'Network Engineering'];
        $perusahaanList = ['PT. Teknologi Maju', 'CV. Kreatif Digital', 'PT. Solusi Pintar', 'PT. Inovasi Bangsa', 'CV. Media Cerdas'];
        $now = now();

        foreach ($mhsRecords as $i => $mhs) {
            $kode = 'MGN-TEST-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT);
            $konsentrasi = $konsentrasiList[$i % count($konsentrasiList)];
            $perusahaan = $perusahaanList[$i % count($perusahaanList)];

            DB::table('magangs')->updateOrInsert(
                ['kode_magang' => $kode],
                [
                    'tipe_magang' => 'individu',
                    'konsentrasi' => $konsentrasi,
                    'perusahaan' => $perusahaan,
                    'alamat' => 'Jl. Merdeka No. ' . ($i + 1) . ', Jakarta',
                    'tanggal_mulai' => now()->subDays(60),
                    'tanggal_selesai' => now()->addDays(30),
                    'dosen_pembimbing_id' => $dosenIds[0],
                    'status_magang' => 'Aktif',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            $magang = DB::table('magangs')->where('kode_magang', $kode)->first();

            DB::table('peserta_magangs')->updateOrInsert(
                ['magang_id' => $magang->id, 'mahasiswa_id' => $mhs->id],
                [
                    'is_ketua' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );



            // Laporan for first 10 mahasiswa only
            if ($i < 10) {
                $statusList = ['review', 'revisi', 'approved'];
                $laporanStatus = $statusList[$i % 3];
                DB::table('laporans')->updateOrInsert(
                    ['magang_id' => $magang->id],
                    [
                        'judul' => 'Laporan Magang ' . $mhs->nama . ' - ' . $perusahaan,
                        'bab1' => 'Bab 1: Pendahuluan - ' . $mhs->nama,
                        'bab2' => 'Bab 2: Tinjauan Pustaka - ' . $perusahaan,
                        'bab3' => 'Bab 3: Metodologi - ' . $konsentrasi,
                        'bab4' => 'Bab 4: Penutup - Testing pagination',
                        'status' => $laporanStatus,
                        'catatan_dosen' => $laporanStatus === 'revisi' ? 'Perbaiki bagian metodologi.' : null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }
}
