<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kerja Praktik - {{ $mahasiswa->nama }}</title>
    <style>
        @page {
            margin: 3cm 3cm 3cm 4cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }
        .cover-page {
            page-break-after: always;
            text-align: center;
            padding-top: 4cm;
        }
        .cover-page .title {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1.5cm;
            letter-spacing: 1pt;
        }
        .cover-page .judul-laporan {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1cm;
        }
        .cover-page .subtitle {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 3cm;
        }
        .cover-page .info-label {
            font-size: 12pt;
            font-weight: bold;
            margin-top: 2.5cm;
            margin-bottom: 0.5cm;
        }
        .cover-page .info-text {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 0.2cm;
        }
        .cover-page .identity {
            font-size: 12pt;
            font-weight: bold;
            margin-top: 2cm;
            line-height: 1.8;
        }
        .cover-page .identity div {
            font-weight: bold;
        }
        .cover-page .identity .label {
            font-weight: normal;
        }
        .cover-page .univ-info {
            margin-top: 2.5cm;
            font-size: 12pt;
            font-weight: bold;
            line-height: 1.8;
        }
        .cover-page .year {
            margin-top: 0.5cm;
            font-size: 12pt;
            font-weight: bold;
        }

        .pengesahan-page {
            page-break-after: always;
            text-align: center;
        }
        .pengesahan-page h2 {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1cm;
        }
        .pengesahan-page .data-diri {
            text-align: left;
            margin: 0 auto 1.5cm;
            width: 70%;
            font-size: 12pt;
            line-height: 2;
        }
        .pengesahan-page .data-diri .row {
            display: block;
        }
        .pengesahan-page .data-diri .row .field {
            display: inline-block;
            width: 3cm;
        }
        .pengesahan-page .lokasi {
            text-align: center;
            font-size: 12pt;
            margin-bottom: 1cm;
        }
        .pengesahan-page .approval {
            margin-top: 1cm;
        }
        .signature-table {
            width: 100%;
            max-width: 90%;
            margin: 0.5cm auto 1cm;
            border-collapse: collapse;
            font-size: 12pt;
        }
        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0.5cm 0.3cm;
        }
        .signature-table .jabatan {
            font-weight: bold;
            margin-bottom: 2cm;
        }
        .signature-table .nama {
            margin-top: 2.5cm;
            font-weight: bold;
            text-decoration: underline;
        }
        .signature-table .nik {
            font-size: 11pt;
        }
        .pengesahan-page .mengetahui {
            margin-top: 0.5cm;
            font-size: 12pt;
            text-align: center;
        }
        .pengesahan-page .ketua-prodi {
            margin-top: 2.5cm;
            font-weight: bold;
            text-decoration: underline;
            font-size: 12pt;
        }
        .pengesahan-page .nik-prodi {
            font-size: 11pt;
        }

        .kata-pengantar-page {
            page-break-after: always;
        }
        .kata-pengantar-page h2 {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1cm;
        }
        .kata-pengantar-page p {
            text-align: justify;
            text-indent: 1.5cm;
            font-size: 12pt;
        }
        .kata-pengantar-page .penutup {
            margin-top: 2cm;
            text-align: right;
            font-size: 12pt;
        }
        .kata-pengantar-page .penutup .kota {
            margin-bottom: 2.5cm;
        }

        .daftarisi-page {
            page-break-after: always;
        }
        .daftarisi-page h2 {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1cm;
        }
        .daftarisi-page .toc-item {
            font-size: 12pt;
            line-height: 2;
        }
        .daftarisi-page .toc-item .num {
            display: inline-block;
            width: 1.5cm;
        }
        .daftarisi-page .toc-item .dots {
            float: right;
        }
        .daftarisi-page .toc-sub {
            padding-left: 1.5cm;
            font-size: 12pt;
            line-height: 1.8;
        }

        .bab-section {
            page-break-before: always;
        }
        .bab-section .bab-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1cm;
        }
        .bab-section .content {
            text-align: justify;
            font-size: 12pt;
        }
        .bab-section .content p {
            text-indent: 1.5cm;
        }
        .bab-section .content table {
            width: 100%;
            border-collapse: collapse;
            margin: 0.5cm 0;
        }
        .bab-section .content table, .bab-section .content th, .bab-section .content td {
            border: 1px solid #000;
        }
        .bab-section .content th, .bab-section .content td {
            padding: 5px 8px;
            text-align: left;
            font-size: 12pt;
        }

        .referensi-page {
            page-break-before: always;
        }
        .referensi-page h2 {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1cm;
        }
        .referensi-page ol {
            font-size: 12pt;
            text-align: justify;
            padding-left: 1.5cm;
        }

        .lampiran-page {
            page-break-before: always;
        }
        .lampiran-page h2 {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1cm;
        }
        .lampiran-page .lampiran-item {
            font-size: 12pt;
            margin-bottom: 0.5cm;
        }

        footer {
            position: fixed;
            bottom: -1.5cm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10pt;
            color: #555;
        }
        .page-number:before {
            content: counter(page);
        }
        .content img {
            max-width: 100%;
            height: auto;
        }
        .clearfix {
            clear: both;
        }
        .page-break {
            page-break-after: always;
        }
        .content h1, .content h2, .content h3, .content h4 {
            font-size: 12pt;
            font-weight: bold;
        }
    </style>
</head>
<body>

    {{-- ============================================================ --}}
    {{-- COVER PAGE --}}
    {{-- ============================================================ --}}
    <div class="cover-page">
        <div class="title">LAPORAN KERJA PRAKTIK</div>
        <div class="judul-laporan">{{ $laporan->judul }}</div>
        <div class="subtitle">Diajukan sebagai bukti telah melaksanakan kerja praktik (magang)</div>

        <div class="info-label">Disusun oleh:</div>
        <div class="info-text">Nama : {{ $mahasiswa->nama }}</div>
        <div class="info-text">NIM  : {{ $mahasiswa->nim }}</div>

        <div class="identity">
            @if($magang->konsentrasi)
                <div>Program Keahlian {{ $magang->konsentrasi }}</div>
            @endif
        </div>

        <div class="univ-info">
            <div>PROGRAM STUDI TEKNIK INFORMATIKA</div>
            <div>FAKULTAS ILMU KOMPUTER</div>
            <div>UNIVERSITAS AMIKOM YOGYAKARTA</div>
            <div class="year">{{ date('Y') }}</div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- LEMBAR PENGESAHAN --}}
    {{-- ============================================================ --}}
    <div class="pengesahan-page">
        <h2>LEMBAR PENGESAHAN</h2>

        <div class="data-diri">
            <div class="row"><span class="field">Nama</span>: {{ $mahasiswa->nama }}</div>
            <div class="row"><span class="field">NIM</span>: {{ $mahasiswa->nim }}</div>
            <div class="row"><span class="field">Program Studi</span>: Teknik Informatika</div>
        </div>

        <div class="lokasi">
            Disahkan,<br>
            Yogyakarta, ................... 20....
        </div>

        <div class="approval">
            <table class="signature-table">
                <tr>
                    <td>
                        <div class="jabatan">Dosen Pembimbing</div>
                        <br><br><br>
                        <div class="nama">
                            @if($magang->pembimbing)
                                {{ $magang->pembimbing->nama }}
                            @else
                                ................................
                            @endif
                        </div>
                        <div class="nik">
                            @if($magang->pembimbing)
                                NIK. {{ $magang->pembimbing->nik }}
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="jabatan">Pembimbing Lapangan</div>
                        <br><br><br>
                        <div class="nama">................................</div>
                        <div class="nik">&nbsp;</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="mengetahui">Mengetahui,</div>
        <div class="mengetahui" style="margin-top:0.3cm;">Ketua Program Studi Teknik Informatika</div>
        <div class="mengetahui" style="margin-top:0.3cm; font-style:italic;">Universitas Amikom Yogyakarta</div>
        <div class="ketua-prodi">
            @if($mahasiswa->dosenWali)
                {{ $mahasiswa->dosenWali->nama }}
            @else
                ................................
            @endif
        </div>
        <div class="nik-prodi">
            @if($mahasiswa->dosenWali)
                NIK. {{ $mahasiswa->dosenWali->nik }}
            @endif
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- KATA PENGANTAR --}}
    {{-- ============================================================ --}}
    <div class="kata-pengantar-page">
        <h2>KATA PENGANTAR</h2>
        <p>
            Puji syukur ke hadirat Tuhan Yang Maha Esa atas segala rahmat dan karunia-Nya sehingga 
            laporan kerja praktik ini dapat diselesaikan dengan baik. Laporan ini disusun sebagai 
            bukti telah melaksanakan kegiatan kerja praktik (magang) yang telah dilakukan.
        </p>
        <p>
            Penyusunan laporan ini tidak lepas dari bantuan, bimbingan, dan dukungan dari berbagai 
            pihak. Oleh karena itu, pada kesempatan ini penulis menyampaikan ucapan terima kasih kepada:
        </p>
        <p>
            1. Bapak/Ibu Dosen Pembimbing yang telah memberikan arahan dan bimbingan selama 
               pelaksanaan magang dan penyusunan laporan ini.<br>
            2. Pihak instansi/perusahaan yang telah memberikan kesempatan untuk melaksanakan magang.<br>
            3. Seluruh pihak yang telah membantu dalam pelaksanaan magang dan penyusunan laporan ini.
        </p>
        <p>
            Penulis menyadari bahwa laporan ini masih jauh dari sempurna. Oleh karena itu, kritik 
            dan saran yang membangun sangat diharapkan untuk perbaikan di masa mendatang. Semoga 
            laporan ini dapat memberikan manfaat bagi pembaca dan pihak-pihak yang membutuhkan.
        </p>
        <div class="penutup">
            <div class="kota">Yogyakarta, ................... 20....</div>
            <div>Penulis</div>
            <br><br><br><br>
            <div><strong>{{ $mahasiswa->nama }}</strong></div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- DAFTAR ISI --}}
    {{-- ============================================================ --}}
    <div class="daftarisi-page">
        <h2>DAFTAR ISI</h2>

        <div class="toc-item">HALAMAN JUDUL</div>
        <div class="toc-item">LEMBAR PENGESAHAN</div>
        <div class="toc-item">KATA PENGANTAR</div>
        <div class="toc-item">DAFTAR ISI</div>
        <div class="toc-item">DAFTAR TABEL</div>
        <div class="toc-item">DAFTAR GAMBAR</div>
        <br>
        <div class="toc-item">BAB I &nbsp; PENDAHULUAN</div>
        <div class="toc-sub">1.1 Latar Belakang</div>
        <div class="toc-sub">1.2 Tujuan</div>
        <div class="toc-sub">1.3 Manfaat</div>
        <div class="toc-sub">1.4 Sistematika Laporan</div>
        <br>
        <div class="toc-item">BAB II &nbsp; PROFIL PERUSAHAAN</div>
        <div class="toc-sub">2.1 Profil Perusahaan / Instansi</div>
        <div class="toc-sub">2.2 Bidang Usaha</div>
        <div class="toc-sub">2.3 Produk / Jasa Utama</div>
        <br>
        <div class="toc-item">BAB III &nbsp; PELAKSANAAN MAGANG</div>
        <div class="toc-sub">3.1 Stack Role</div>
        <div class="toc-sub">3.2 Waktu, Tempat dan Pelaksanaan</div>
        <div class="toc-sub">3.3 Permasalahan dan Solusi Kegiatan</div>
        <div class="toc-sub">3.4 Deskripsi Kegiatan</div>
        <div class="toc-sub">3.5 Proses Pelaksanaan</div>
        <div class="toc-sub">3.6 Deskripsi Detail Proses Pelaksanaan</div>
        <br>
        <div class="toc-item">BAB IV &nbsp; PEMBAHASAN</div>
        <div class="toc-sub">4.1 Hasil Kegiatan</div>
        <div class="toc-sub">4.2 Permasalahan dan Peluang Kegiatan Keberlanjutan Magang</div>
        <br>
        <div class="toc-item">BAB V &nbsp; PENUTUP</div>
        <div class="toc-sub">5.1 Kesimpulan</div>
        <div class="toc-sub">5.2 Saran</div>
        <br>
        <div class="toc-item">DAFTAR REFERENSI</div>
        <div class="toc-item">LAMPIRAN</div>
    </div>

    {{-- ============================================================ --}}
    {{-- BAB I: PENDAHULUAN --}}
    {{-- ============================================================ --}}
    <div class="bab-section">
        <div class="bab-title">BAB I<br>PENDAHULUAN</div>
        <div class="content">
            {!! $laporan->bab1 !!}
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- BAB II: PROFIL PERUSAHAAN --}}
    {{-- ============================================================ --}}
    <div class="bab-section">
        <div class="bab-title">BAB II<br>PROFIL PERUSAHAAN</div>
        <div class="content">
            {!! $laporan->bab2 !!}
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- BAB III: PELAKSANAAN MAGANG --}}
    {{-- ============================================================ --}}
    <div class="bab-section">
        <div class="bab-title">BAB III<br>PELAKSANAAN MAGANG</div>
        <div class="content">
            {!! $laporan->bab3 !!}
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- BAB IV: PEMBAHASAN --}}
    {{-- ============================================================ --}}
    <div class="bab-section">
        <div class="bab-title">BAB IV<br>PEMBAHASAN</div>
        <div class="content">
            {!! $laporan->bab4 !!}
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- BAB V: PENUTUP --}}
    {{-- ============================================================ --}}
    <div class="bab-section">
        <div class="bab-title">BAB V<br>PENUTUP</div>
        <div class="content">
            <p style="text-indent: 1.5cm;">
                <strong>5.1 Kesimpulan</strong><br>
                Bagian ini memuat simpulan-simpulan yang merupakan rangkuman dari hasil analisis 
                kinerja pada bagian sebelumnya. Simpulan ini merujuk pada tujuan Magang yang ada 
                pada Bab I.
            </p>
            <p style="text-indent: 1.5cm;">
                <strong>5.2 Saran</strong><br>
                Bagian ini berisi saran-saran yang perlu diperhatikan berdasarkan keterbatasan-
                keterbatasan yang ditemukan dan asumsi-asumsi yang dibuat selama pengembangan.
            </p>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- DAFTAR REFERENSI --}}
    {{-- ============================================================ --}}
    <div class="referensi-page">
        <h2>DAFTAR REFERENSI</h2>
        <p style="text-align:justify; font-size:12pt; text-indent:0cm;">
            Daftar referensi memuat semua sumber kepustakaan yang digunakan dalam pelaksanaan dan 
            pembuatan laporan Magang, baik berupa buku, majalah, maupun sumber-sumber kepustakaan 
            lain. Ditulis dengan style IEEE.
        </p>
    </div>

    {{-- ============================================================ --}}
    {{-- LAMPIRAN --}}
    {{-- ============================================================ --}}
    <div class="lampiran-page">
        <h2>LAMPIRAN</h2>
        <div class="lampiran-item">1. Logbook Kegiatan</div>
        <div class="lampiran-item">2. Foto Kegiatan</div>
    </div>

    <footer>
        Laporan Kerja Praktik - {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
    </footer>
</body>
</html>
