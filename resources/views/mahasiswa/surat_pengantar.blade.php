<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengantar Magang - {{ $magang->kode_magang }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; line-height: 1.6; color: #333; margin: 0; padding: 40px; }
        .header { text-align: center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .header p { margin: 5px 0; font-size: 14px; }
        .content { margin-top: 30px; }
        .content p { font-size: 16px; margin-bottom: 15px; }
        .student-info { margin: 20px 0; }
        .student-info table { width: 100%; border-collapse: collapse; }
        .student-info td { padding: 5px; font-size: 16px; }
        .student-info td:first-child { width: 150px; font-weight: bold; }
        .footer { margin-top: 50px; text-align: right; }
        .signature { margin-top: 80px; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
        .btn-print {
            padding: 10px 20px;
            background: #6B21A8;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center;">
        <button onclick="window.print()" class="btn-print">Cetak Surat Sekarang (Ctrl+P)</button>
        <p style="font-size: 12px; color: #666;">Gunakan browser Google Chrome atau Microsoft Edge untuk hasil terbaik (Save as PDF).</p>
    </div>

    <div class="header">
        <h1>Sistem Informasi Management Magang (SIDUL)</h1>
        <p>Jl. Raya Kampus, Kota Pelajar, Indonesia | Email: sidul@kampus.ac.id</p>
    </div>

    <div class="content">
        <p style="text-align: right;"><strong>Tanggal:</strong> {{ now()->format('d F Y') }}</p>
        <p><strong>Nomor Surat:</strong> {{ $magang->kode_magang }}/SIDUL/{{ now()->year }}</p>
        
        <p>Hal: <strong>Permohonan / Pengantar Magang Mahasiswa</strong></p>

        <p>Kepada Yth,<br>
        <strong>Pimpinan / HRD {{ $magang->perusahaan }}</strong><br>
        Di Tempat</p>

        <p>Dengan hormat,<br>
        Bersama surat ini, kami memberitahukan bahwa mahasiswa yang namanya tercantum di bawah ini telah secara resmi terdaftar dalam Program Magang yang dikelola oleh fakultas kami. Kami mohon bantuan Bapak/Ibu untuk dapat menerima mahasiswa kami dalam menjalankan praktek kerja lapangan (magang):</p>

        <div class="student-info">
            <table>
                @foreach($magang->peserta as $p)
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td>: {{ $p->mahasiswa->nama }}</td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>: {{ $p->mahasiswa->nim }}</td>
                </tr>
                @endforeach
                <tr>
                    <td>Konsentrasi</td>
                    <td>: {{ $magang->konsentrasi }}</td>
                </tr>
                <tr>
                    <td>ID Magang</td>
                    <td>: {{ $magang->kode_magang }}</td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing</td>
                    <td>: {{ $magang->pembimbing->nama ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>

        <p>Mahasiswa tersebut direncanakan akan melaksanakan magang mulai tanggal <strong>{{ \Carbon\Carbon::parse($magang->tanggal_mulai)->format('d F Y') }}</strong> sampai dengan <strong>{{ \Carbon\Carbon::parse($magang->tanggal_selesai)->format('d F Y') }}</strong>.</p>

        <p>Demikian surat pengantar ini kami sampaikan. Atas perhatian dan kerjasama Bapak/Ibu, kami ucapkan terima kasih.</p>
    </div>

    <div class="footer">
        <p>Hormat kami,</p>
        <div class="signature">
            <p><strong>Administrator SIDUL</strong></p>
            <p>Sistem Informasi Management Magang</p>
        </div>
    </div>
</body>
</html>
