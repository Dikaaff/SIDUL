<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\Magang;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $magangs = Magang::orderBy('id')->get();

        $laporanData = [
            [
                'judul' => 'Pengembangan Sistem Informasi Manajemen Magang Berbasis Web',
                'bab1' => "BAB 1: PENDAHULUAN\n\n1.1 Latar Belakang\nPerkembangan teknologi informasi yang pesat menuntut dunia pendidikan untuk terus beradaptasi. Sistem informasi manajemen magang menjadi kebutuhan penting dalam mengelola data magang mahasiswa secara efektif dan efisien.\n\n1.2 Rumusan Masalah\nBagaimana merancang dan membangun sistem informasi manajemen magang yang dapat mengakomodasi kebutuhan administrasi magang mahasiswa secara digital.\n\n1.3 Tujuan\nMengembangkan sistem informasi manajemen magang berbasis web yang memudahkan pengelolaan data magang.",
                'bab2' => "BAB 2: TINJAUAN PUSTAKA\n\n2.1 Sistem Informasi Manajemen\nSistem informasi manajemen adalah sistem yang menyediakan informasi untuk pengambilan keputusan manajerial.\n\n2.2 Framework Laravel\nLaravel adalah framework PHP modern yang mengikuti arsitektur MVC dan menyediakan berbagai fitur seperti Eloquent ORM, Blade templating, dan Artisan CLI.\n\n2.3 Database MySQL\nMySQL adalah sistem manajemen database relasional yang banyak digunakan dalam pengembangan aplikasi web.",
                'bab3' => "BAB 3: METODOLOGI PENELITIAN\n\n3.1 Metode Pengembangan\nMetode pengembangan yang digunakan adalah Agile dengan framework Scrum.\n\n3.2 Perancangan Sistem\nPerancangan sistem menggunakan UML meliputi Use Case Diagram, Activity Diagram, dan Class Diagram.\n\n3.3 Implementasi\nSistem dibangun menggunakan Laravel 11 dengan database MySQL dan Bootstrap untuk tampilan frontend.",
                'bab4' => "BAB 4: PENUTUP\n\n4.1 Kesimpulan\nSistem informasi manajemen magang berhasil dikembangkan sesuai dengan kebutuhan yang telah didefinisikan.\n\n4.2 Saran\nPengembangan selanjutnya dapat menambahkan fitur notifikasi email otomatis dan integrasi dengan sistem akademik kampus.",
            ],
            [
                'judul' => 'Pengembangan Aplikasi Multimedia Interaktif untuk Media Pembelajaran',
                'bab1' => "BAB 1: PENDAHULUAN\n\n1.1 Latar Belakang\nMedia pembelajaran interaktif menjadi kebutuhan penting dalam meningkatkan kualitas pendidikan di era digital.\n\n1.2 Rumusan Masalah\nBagaimana mengembangkan aplikasi multimedia interaktif yang efektif sebagai media pembelajaran.\n\n1.3 Tujuan\nMembangun aplikasi multimedia interaktif yang dapat meningkatkan pemahaman materi pembelajaran.",
                'bab2' => "BAB 2: TINJAUAN PUSTAKA\n\n2.1 Multimedia Interaktif\nMultimedia interaktif menggabungkan teks, gambar, audio, video dan animasi.\n\n2.2 Adobe Creative Suite\nPerangkat lunak untuk merancang konten multimedia profesional.\n\n2.3 Unity Engine\nGame engine yang digunakan untuk mengembangkan aplikasi interaktif 2D dan 3D.",
                'bab3' => "BAB 3: METODOLOGI PENELITIAN\n\n3.1 Metode Pengembangan\nMenggunakan metode Multimedia Development Life Cycle (MDLC).\n\n3.2 Perancangan Aplikasi\nPerancangan meliputi storyboard, navigasi, dan desain antarmuka.\n\n3.3 Implementasi\nAplikasi dibangun menggunakan Unity Engine dengan bahasa pemrograman C#.",
                'bab4' => "BAB 4: PENUTUP\n\n4.1 Kesimpulan\nAplikasi multimedia interaktif berhasil dikembangkan dan diuji coba.\n\n4.2 Saran\nPerlu dilakukan pengujian lebih lanjut dengan responden yang lebih banyak.",
            ],
            [
                'judul' => 'Rancang Bangun Sistem Informasi Inventory Berbasis Web',
                'bab1' => "BAB 1: PENDAHULUAN\n\n1.1 Latar Belakang\nPengelolaan inventory yang masih manual sering menimbulkan masalah akurasi data dan efisiensi kerja.\n\n1.2 Rumusan Masalah\nBagaimana merancang sistem informasi inventory yang dapat mengelola stok barang secara real-time.\n\n1.3 Tujuan\nMembangun sistem informasi inventory berbasis web yang akurat dan efisien.",
                'bab2' => "BAB 2: TINJAUAN PUSTAKA\n\n2.1 Sistem Inventory\nSistem inventory adalah sistem yang mengelola pencatatan barang masuk dan keluar.\n\n2.2 Metode FIFO\nFirst In First Out adalah metode pencatatan stok dimana barang yang pertama masuk adalah yang pertama keluar.\n\n2.3 CodeIgniter\nFramework PHP alternatif yang ringan dan cepat untuk pengembangan web.",
                'bab3' => "BAB 3: METODOLOGI PENELITIAN\n\n3.1 Metode Pengembangan\nMenggunakan metode Waterfall yang terdiri dari analisis, desain, implementasi, pengujian, dan pemeliharaan.\n\n3.2 Perancangan Database\nMenggunakan MySQL dengan struktur tabel yang dinormalisasi.\n\n3.3 Implementasi\nSistem dibangun dengan CodeIgniter dan menggunakan template AdminLTE.",
                'bab4' => "BAB 4: PENUTUP\n\n4.1 Kesimpulan\nSistem inventory berhasil diimplementasikan dan membantu dalam pengelolaan stok.\n\n4.2 Saran\nIntegrasi dengan sistem barcode scanner dapat ditambahkan untuk meningkatkan efisiensi.",
            ],
            [
                'judul' => 'Analisis Data Penjualan Menggunakan Machine Learning',
                'bab1' => "BAB 1: PENDAHULUAN\n\n1.1 Latar Belakang\nData penjualan yang besar dapat dimanfaatkan untuk memprediksi tren pasar menggunakan machine learning.\n\n1.2 Rumusan Masalah\nBagaimana menerapkan algoritma machine learning untuk menganalisis data penjualan.\n\n1.3 Tujuan\nMengimplementasikan model machine learning untuk prediksi penjualan.",
                'bab2' => "BAB 2: TINJAUAN PUSTAKA\n\n2.1 Data Science\nData science adalah ilmu yang menggabungkan statistik, matematika, dan pemrograman.\n\n2.2 Machine Learning\nMachine learning adalah cabang AI yang memungkinkan sistem belajar dari data.\n\n2.3 Python\nPython adalah bahasa pemrograman yang populer untuk data science dan machine learning.",
                'bab3' => "BAB 3: METODOLOGI PENELITIAN\n\n3.1 Metode Pengembangan\nMenggunakan CRISP-DM (Cross Industry Standard Process for Data Mining).\n\n3.2 Pengumpulan Data\nData dikumpulkan dari sistem transaksi penjualan selama 2 tahun terakhir.\n\n3.3 Implementasi\nMenggunakan Python dengan library Scikit-learn, Pandas, dan Matplotlib.",
                'bab4' => "BAB 4: PENUTUP\n\n4.1 Kesimpulan\nModel prediksi penjualan berhasil mencapai akurasi 85% pada data testing.\n\n4.2 Saran\nData dengan rentang waktu yang lebih panjang dapat meningkatkan akurasi model.",
            ],
            [
                'judul' => 'Implementasi Keamanan Jaringan Menggunakan Firewall dan IDS',
                'bab1' => "BAB 1: PENDAHULUAN\n\n1.1 Latar Belakang\nKeamanan jaringan menjadi isu kritis seiring meningkatnya serangan siber di Indonesia.\n\n1.2 Rumusan Masalah\nBagaimana mengimplementasikan sistem keamanan jaringan yang efektif menggunakan firewall dan IDS.\n\n1.3 Tujuan\nMembangun sistem keamanan jaringan yang dapat mendeteksi dan mencegah serangan.",
                'bab2' => "BAB 2: TINJAUAN PUSTAKA\n\n2.1 Firewall\nFirewall adalah sistem keamanan yang memonitor dan mengontrol lalu lintas jaringan.\n\n2.2 Intrusion Detection System\nIDS adalah sistem yang mendeteksi aktivitas mencurigakan dalam jaringan.\n\n2.3 Snort\nSnort adalah IDS open source yang banyak digunakan untuk analisis jaringan real-time.",
                'bab3' => "BAB 3: METODOLOGI PENELITIAN\n\n3.1 Metode Pengembangan\nMenggunakan metode PPDIOO (Prepare, Plan, Design, Implement, Operate, Optimize).\n\n3.2 Perancangan Topologi\nMerancang topologi jaringan dengan segmentasi dan demilitarized zone (DMZ).\n\n3.3 Implementasi\nMenggunakan pfSense sebagai firewall dan Snort sebagai IDS.",
                'bab4' => "BAB 4: PENUTUP\n\n4.1 Kesimpulan\nSistem keamanan berhasil mendeteksi 95% serangan pada pengujian penetrasi.\n\n4.2 Saran\nPenambahan sistem SIEM dapat meningkatkan kemampuan monitoring keamanan.",
            ],
        ];

        foreach ($magangs as $i => $magang) {
            Laporan::factory()->create([
                'magang_id' => $magang->id,
                'judul' => $laporanData[$i]['judul'],
                'bab1' => $laporanData[$i]['bab1'],
                'bab2' => $laporanData[$i]['bab2'],
                'bab3' => $laporanData[$i]['bab3'],
                'bab4' => $laporanData[$i]['bab4'],
                'status' => 'review',
                'catatan_dosen' => null,
            ]);
        }
    }
}
