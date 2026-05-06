<!DOCTYPE html>
<html>
<head>
    <title>Logbook Magang - {{ $mahasiswa->nama }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.4;
            margin: 1.5cm;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 1cm;
            border-bottom: 2px solid #333;
            padding-bottom: 0.5cm;
        }
        .header h1 {
            text-transform: uppercase;
            font-size: 16pt;
            margin: 0;
        }
        .header p {
            margin: 5px 0;
            font-size: 10pt;
        }
        .info-table {
            width: 100%;
            margin-bottom: 0.8cm;
            font-size: 10pt;
        }
        .info-table td {
            padding: 3px 0;
        }
        .log-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
        }
        .log-table th, .log-table td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        .log-table th {
            background-color: #f2f2f2;
            text-align: center;
            text-transform: uppercase;
        }
        .footer {
            margin-top: 1.5cm;
            font-size: 10pt;
        }
        .signature-box {
            float: right;
            width: 200px;
            text-align: center;
            margin-top: 1cm;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LOGBOOK AKTIVITAS MAGANG</h1>
        <p>Program Studi Teknik Informatika - Universitas SIDUL</p>
    </div>

    <table class="info-table">
        <tr>
            <td width="120">Nama Mahasiswa</td>
            <td width="10">:</td>
            <td><strong>{{ $mahasiswa->nama }}</strong></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>:</td>
            <td>{{ $mahasiswa->nim }}</td>
        </tr>
        <tr>
            <td>Instansi Magang</td>
            <td>:</td>
            <td>{{ $magang->perusahaan }}</td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($magang->tanggal_mulai)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($magang->tanggal_selesai)->format('d/m/Y') }}</td>
        </tr>
    </table>

    <table class="log-table">
        <thead>
            <tr>
                <th width="30">No</th>
                <th width="100">Tanggal</th>
                <th>Aktivitas / Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logbooks as $index => $log)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d/m/Y') }}</td>
                <td style="text-align: justify;">{{ $log->kegiatan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div class="signature-box">
            <p>Dicetak pada: {{ date('d/m/Y') }}</p>
            <br><br><br>
            <p><strong>( ____________________ )</strong></p>
            <p>Pembimbing Lapangan</p>
        </div>
    </div>
</body>
</html>
