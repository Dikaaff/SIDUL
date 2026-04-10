<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Logbook;
use App\Models\Bimbingan;
use App\Models\Laporan;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        $user = Auth::user();

        $pendaftaran = Pendaftaran::where('user_id', $userId)->first();
        $logbookCount = Logbook::where('user_id', $userId)->count();
        $bimbinganCount = Bimbingan::where('user_id', $userId)->count();
        $laporan = Laporan::where('user_id', $userId)->first();

        return view('mahasiswa.dashboard', compact('user', 'pendaftaran', 'logbookCount', 'bimbinganCount', 'laporan'));
    }

    public function progress()
    {
        $userId = Auth::id();
        $pendaftaran = Pendaftaran::where('user_id', $userId)->first();
        $logbooks = Logbook::where('user_id', $userId)->get();
        $bimbingans = Bimbingan::where('user_id', $userId)->get();
        $laporan = Laporan::where('user_id', $userId)->first();

        return view('mahasiswa.progress', compact('pendaftaran', 'logbooks', 'bimbingans', 'laporan'));
    }

    public function pendaftaran()
    {
        return view('mahasiswa.pendaftaran');
    }

    public function storePendaftaran(Request $request)
    {
        // Validasi Sederhana
        $request->validate([
            'tipe_magang' => 'required',
            'perusahaan' => 'required',
            'alamat' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        // Simpan File Proposal (Simulasi)
        $path = null;
        if ($request->hasFile('proposal')) {
            $path = $request->file('proposal')->getClientOriginalName();
        }

        Pendaftaran::create([
            'user_id' => Auth::id(),
            'tipe' => $request->tipe_magang,
            'perusahaan' => $request->perusahaan,
            'alamat' => $request->alamat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'proposal_path' => $path,
            'status' => 'Menunggu ACC'
        ]);

        return redirect()->route('mahasiswa.progress')->with('success', 'Pendaftaran berhasil dikirim. Menunggu verifikasi.');
    }
}
