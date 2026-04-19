<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\PesertaMagang;
use App\Models\Logbook;
use App\Models\Laporan;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        $user = Auth::user();
        
        // Get Mahasiswa Profile
        $mahasiswa = $user->mahasiswa;
        
        // Get Current Internship (via PesertaMagang)
        $peserta = $mahasiswa ? $mahasiswa->pesertaMagang : null;
        $magang = $peserta ? $peserta->magang : null;

        // Statistics based on Magang ID
        $logbookCount = $magang ? Logbook::where('id_magang', $magang->id_magang)->count() : 0;
        $laporan = $magang ? Laporan::where('id_magang', $magang->id_magang)->first() : null;
        
        // Map 'magang' to 'pendaftaran' variable name for Blade compatibility
        $pendaftaran = $magang;


        return view('mahasiswa.dashboard', compact('user', 'pendaftaran', 'logbookCount', 'laporan'));
    }

    public function progress()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $peserta = $mahasiswa ? $mahasiswa->pesertaMagang : null;
        $magang = $peserta ? $peserta->magang : null;

        $logbooks = $magang ? Logbook::where('id_magang', $magang->id_magang)->get() : collect();
        $laporan = $magang ? Laporan::where('id_magang', $magang->id_magang)->first() : null;
        
        // Map to blade variables
        $pendaftaran = $magang;


        return view('mahasiswa.progress', compact('pendaftaran', 'logbooks', 'laporan'));
    }

    public function pendaftaran()
    {
        return view('mahasiswa.pendaftaran');
    }

    public function storePendaftaran(Request $request)
    {
        $request->validate([
            'tipe_magang' => 'required',
            'perusahaan' => 'required',
            'alamat' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'konsentrasi' => 'required',
            'link_bukti_magang' => 'required|url',
            'link_survey_perusahaan' => 'required|url',
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        // Auto generate kode_magang: MGN-[NIM]-[RANDOM]
        $kodeMagang = 'MGN-' . $mahasiswa->nim . '-' . strtoupper(substr(md5(time()), 0, 5));

        // 1. Create Magang
        $magang = Magang::create([
            'kode_magang' => $kodeMagang,
            'nim' => $mahasiswa->nim, // Ketua
            'perusahaan' => $request->perusahaan,
            'alamat' => $request->alamat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'konsentrasi' => $request->konsentrasi,
            'tipe_magang' => $request->tipe_magang,
            'link_bukti_magang' => $request->link_bukti_magang,
            'link_survey_perusahaan' => $request->link_survey_perusahaan,
            'status_magang' => 'Pending',
        ]);

        // 2. Add as Peserta
        PesertaMagang::create([
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'id_magang' => $magang->id_magang,
            'nim' => $mahasiswa->nim,
        ]);

        return redirect()->route('mahasiswa.progress')->with('success', 'Pendaftaran berhasil dikirim.');
    }
}
