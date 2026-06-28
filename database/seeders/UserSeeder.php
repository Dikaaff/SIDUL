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
        ['nim' => '23.01.5021', 'nama' => 'Aditya Saputra'],
        ['nim' => '23.01.5022', 'nama' => 'Bayu Pratama'],
        ['nim' => '23.01.5023', 'nama' => 'Candra Wijaya'],
        ['nim' => '23.01.5024', 'nama' => 'Dwi Lestari'],
        ['nim' => '23.01.5025', 'nama' => 'Fitri Handayani'],
        ['nim' => '23.01.5026', 'nama' => 'Gilang Ramadhan'],
        ['nim' => '23.01.5027', 'nama' => 'Hesti Purnamasari'],
        ['nim' => '23.01.5028', 'nama' => 'Iwan Setiawan'],
        ['nim' => '23.01.5029', 'nama' => 'Jeni Susanti'],
        ['nim' => '23.01.5030', 'nama' => 'Kurniawan'],
        ['nim' => '23.01.5031', 'nama' => 'Erik Susanto'],
        ['nim' => '23.01.5032', 'nama' => 'Tari Handayani'],
        ['nim' => '23.01.5033', 'nama' => 'Bagas Pratama'],
        ['nim' => '23.01.5034', 'nama' => 'Siska Anggraeni'],
        ['nim' => '23.01.5035', 'nama' => 'Wahyu Nugroho'],
        ['nim' => '23.01.5036', 'nama' => 'Nadia Paramitha'],
        ['nim' => '23.01.5037', 'nama' => 'Lutfi Hakim'],
        ['nim' => '23.01.5038', 'nama' => 'Jihan Fauziah'],
        ['nim' => '23.01.5039', 'nama' => 'Edi Santoso'],
        ['nim' => '23.01.5040', 'nama' => 'Umi Kalsum'],
        ['nim' => '23.01.5041', 'nama' => 'Eko Prasetyo'],
        ['nim' => '23.01.5042', 'nama' => 'Feni Marlina'],
        ['nim' => '23.01.5043', 'nama' => 'Fajar Ramadhan'],
        ['nim' => '23.01.5044', 'nama' => 'Bunga Citra'],
        ['nim' => '23.01.5045', 'nama' => 'Junaidi Al-Farizi'],
        ['nim' => '23.01.5046', 'nama' => 'Amalia Putri'],
        ['nim' => '23.01.5047', 'nama' => 'Ibnu Sina'],
        ['nim' => '23.01.5048', 'nama' => 'Puji Astuti'],
        ['nim' => '23.01.5049', 'nama' => 'Slamet Riyadi'],
        ['nim' => '23.01.5050', 'nama' => 'Dian Permata'],
        ['nim' => '23.01.5051', 'nama' => 'Kuncoro Aji'],
        ['nim' => '23.01.5052', 'nama' => 'Eka Safitri'],
        ['nim' => '23.01.5053', 'nama' => 'Zainal Arifin'],
        ['nim' => '23.01.5054', 'nama' => 'Kartika Sari'],
        ['nim' => '23.01.5055', 'nama' => 'Marzuki Alamsyah'],
        ['nim' => '23.01.5056', 'nama' => 'Ocha Ramadhani'],
        ['nim' => '23.01.5057', 'nama' => 'Danang Prakoso'],
        ['nim' => '23.01.5058', 'nama' => 'Yuni Lestari'],
        ['nim' => '23.01.5059', 'nama' => 'Wawan Setiawan'],
        ['nim' => '23.01.5060', 'nama' => 'Ratna Sari'],
        ['nim' => '23.01.5061', 'nama' => 'Vicky Maulana'],
        ['nim' => '23.01.5062', 'nama' => 'Weni Lestari'],
        ['nim' => '23.01.5063', 'nama' => 'Kusnadi Hartono'],
        ['nim' => '23.01.5064', 'nama' => 'Dina Fadhilah'],
        ['nim' => '23.01.5065', 'nama' => 'Doni Lesmana'],
        ['nim' => '23.01.5066', 'nama' => 'Sari Dewi'],
        ['nim' => '23.01.5067', 'nama' => 'Rendi Kurniawan'],
        ['nim' => '23.01.5068', 'nama' => 'Bella Oktaviani'],
        ['nim' => '23.01.5069', 'nama' => 'Agus Setiawan'],
        ['nim' => '23.01.5070', 'nama' => 'Nina Susanti'],
        ['nim' => '23.01.5071', 'nama' => 'Catur Wicaksono'],
        ['nim' => '23.01.5072', 'nama' => 'Gita Cahyani'],
        ['nim' => '23.01.5073', 'nama' => 'Umar Hadi'],
        ['nim' => '23.01.5074', 'nama' => 'Winda Puspita'],
        ['nim' => '23.01.5075', 'nama' => 'Novian Adi'],
        ['nim' => '23.01.5076', 'nama' => 'Ika Puspitasari'],
        ['nim' => '23.01.5077', 'nama' => 'Haikal Firdaus'],
        ['nim' => '23.01.5078', 'nama' => 'Hesti Wulandari'],
        ['nim' => '23.01.5079', 'nama' => 'Arief Budiman'],
        ['nim' => '23.01.5080', 'nama' => 'Dewi Sartika'],
        ['nim' => '23.01.5081', 'nama' => 'Jefri Ardiansyah'],
        ['nim' => '23.01.5082', 'nama' => 'Friska Dewi'],
        ['nim' => '23.01.5083', 'nama' => 'Heru Setiawan'],
        ['nim' => '23.01.5084', 'nama' => 'Lestari Handayani'],
        ['nim' => '23.01.5085', 'nama' => 'Yusuf Permadi'],
        ['nim' => '23.01.5086', 'nama' => 'Cindy Permata'],
        ['nim' => '23.01.5087', 'nama' => 'Andi Firmansyah'],
        ['nim' => '23.01.5088', 'nama' => 'Via Aulia'],
        ['nim' => '23.01.5089', 'nama' => 'Bimo Sakti'],
        ['nim' => '23.01.5090', 'nama' => 'Jeni Rahayu'],
        ['nim' => '23.01.5091', 'nama' => 'Farhan Ramadhan'],
        ['nim' => '23.01.5092', 'nama' => 'Indriyani'],
        ['nim' => '23.01.5093', 'nama' => 'Saeful Anwar'],
        ['nim' => '23.01.5094', 'nama' => 'Ayu Pratiwi'],
        ['nim' => '23.01.5095', 'nama' => 'Mulyadi'],
        ['nim' => '23.01.5096', 'nama' => 'Gina Safitri'],
        ['nim' => '23.01.5097', 'nama' => 'Dede Supriyadi'],
        ['nim' => '23.01.5098', 'nama' => 'Ulfa Maulida'],
        ['nim' => '23.01.5099', 'nama' => 'Nurhadi Saputra'],
        ['nim' => '23.01.5100', 'nama' => 'Yulia Rahma'],

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
