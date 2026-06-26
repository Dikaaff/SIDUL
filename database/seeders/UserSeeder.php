<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public static array $connectedDosen = [
        ['nik' => '19876001', 'nama' => 'Dr. Aris Sudaryanto, M.T.'],
        ['nik' => '19876002', 'nama' => 'Siti Aminah, S.Kom., M.Cs.'],
        ['nik' => '19750101', 'nama' => 'Prof. Dr. Budi Santoso, M.Kom.'],
        ['nik' => '19780102', 'nama' => 'Dra. Dewi Lestari, M.Si.'],
        ['nik' => '19800103', 'nama' => 'Ir. Eko Prasetyo, M.T.'],
    ];

    public static array $notConnectedDosen = [
        ['nik' => '19810104', 'nama' => 'Mega Wati, S.Kom., M.Cs.'],
        ['nik' => '19820105', 'nama' => 'Fajar Hidayat, S.T., M.Kom.'],
        ['nik' => '19830106', 'nama' => 'Gita Permata, S.Pd., M.Pd.'],
        ['nik' => '19840107', 'nama' => 'Hendra Gunawan, S.Si., M.T.'],
        ['nik' => '19850108', 'nama' => 'Indra Wirawan, S.Kom., M.Kom.'],
    ];

    public static array $mahasiswa = [
        ['nim' => '23.01.5001', 'nama' => 'Ahmad Rizki Pratama'],
        ['nim' => '23.01.5002', 'nama' => 'Bella Safira Dewi'],
        ['nim' => '23.01.5003', 'nama' => 'Citra Lestari'],
        ['nim' => '23.01.5004', 'nama' => 'Dimas Ardiansyah'],
        ['nim' => '23.01.5005', 'nama' => 'Eka Putri Handayani'],
        ['nim' => '23.01.5006', 'nama' => 'Fajar Nugroho'],
        ['nim' => '23.01.5007', 'nama' => 'Gita Permata Sari'],
        ['nim' => '23.01.5008', 'nama' => 'Hendra Gunawan'],
        ['nim' => '23.01.5009', 'nama' => 'Indah Wulandari'],
        ['nim' => '23.01.5010', 'nama' => 'Joko Susilo'],
        ['nim' => '23.01.5011', 'nama' => 'Kartika Dewi'],
        ['nim' => '23.01.5012', 'nama' => 'Lukman Hakim'],
        ['nim' => '23.01.5013', 'nama' => 'Mega Rahmawati'],
        ['nim' => '23.01.5014', 'nama' => 'Nanda Prasetyo'],
        ['nim' => '23.01.5015', 'nama' => 'Oktavia Sari'],
        ['nim' => '23.01.5016', 'nama' => 'Putra Ramadhan'],
        ['nim' => '23.01.5017', 'nama' => 'Rina Marlina'],
        ['nim' => '23.01.5018', 'nama' => 'Satria Wirawan'],
        ['nim' => '23.01.5019', 'nama' => 'Tania Febriani'],
        ['nim' => '23.01.5020', 'nama' => 'Yoga Pratama'],
    ];

    public static function dosenNik(): array
    {
        return array_merge(
            array_column(self::$connectedDosen, 'nik'),
            array_column(self::$notConnectedDosen, 'nik'),
        );
    }

    public static function mahasiswaNim(): array
    {
        return array_column(self::$mahasiswa, 'nim');
    }

    public function run(): void
    {
        User::factory()->admin()->create(['username' => 'admin']);
        User::factory()->operator()->create(['username' => 'operator']);

        foreach (self::dosenNik() as $nik) {
            User::factory()->dosen()->create(['username' => $nik]);
        }

        foreach (self::mahasiswaNim() as $nim) {
            User::factory()->mahasiswa()->create(['username' => $nim]);
        }
    }
}
