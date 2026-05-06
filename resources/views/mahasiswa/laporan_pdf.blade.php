<!DOCTYPE html>
<html>
<head>
    <title>Laporan Akhir Magang - {{ $mahasiswa->nama }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            margin: 2cm;
            color: #333;
        }
        .cover {
            text-align: center;
            margin-top: 5cm;
            page-break-after: always;
        }
        .cover h1 {
            font-size: 24pt;
            margin-bottom: 2cm;
            text-transform: uppercase;
        }
        .cover h2 {
            font-size: 18pt;
            margin-bottom: 3cm;
            text-transform: uppercase;
        }
        .cover .info {
            font-size: 14pt;
            margin-bottom: 5cm;
        }
        .section-title {
            text-align: center;
            text-transform: uppercase;
            font-size: 14pt;
            margin-top: 1cm;
            margin-bottom: 0.5cm;
            font-weight: bold;
        }
        .content {
            text-align: justify;
            margin-bottom: 1cm;
        }
        .page-break {
            page-break-after: always;
        }
        footer {
            position: fixed;
            bottom: -1cm;
            left: 0;
            right: 0;
            height: 1cm;
            text-align: center;
            font-size: 10pt;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="cover">
        <h1>LAPORAN AKHIR MAGANG</h1>
        <h2>{{ $laporan->judul }}</h2>
        
        <div class="info">
            Disusun Oleh:<br><br>
            <strong>{{ $mahasiswa->nama }}</strong><br>
            NIM: {{ $mahasiswa->nim }}<br><br>
            Program Studi Teknik Informatika<br>
            Universitas SIDUL
        </div>
        
        <div style="margin-top: 3cm;">
            {{ date('Y') }}
        </div>
    </div>

    <div class="section-title">BAB I: PENDAHULUAN</div>
    <div class="content">
        {!! $laporan->bab1 !!}
    </div>

    <div class="page-break"></div>

    <div class="section-title">BAB II: PROFIL INSTANSI</div>
    <div class="content">
        {!! $laporan->bab2 !!}
    </div>

    <div class="page-break"></div>

    <div class="section-title">BAB III: PELAKSANAAN</div>
    <div class="content">
        {!! $laporan->bab3 !!}
    </div>

    <div class="page-break"></div>

    <div class="section-title">BAB IV: PENUTUP</div>
    <div class="content">
        {!! $laporan->bab4 !!}
    </div>

    <footer>
        Laporan Akhir Magang - {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
    </footer>
</body>
</html>
