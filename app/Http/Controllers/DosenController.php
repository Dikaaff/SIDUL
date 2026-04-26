<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function dashboard()
    {
        $dosen = Auth::user()->dosen;
        
        // Data Dosen Wali
        $mhsWaliCount = $dosen ? $dosen->mahasiswaWali()->count() : 0;
        $pendingRekomendasiCount = $dosen ? $dosen->mahasiswaWali()->where('status_magang', 'Pending')->count() : 0;
        
        // Data Dosen Pembimbing
        $mhsBimbinganCount = $dosen ? $dosen->bimbinganMagang()->count() : 0;
        $mhsBimbinganList = $dosen ? $dosen->bimbinganMagang()->with('peserta.mahasiswa')->take(5)->get() : collect();
        $lulusCount = $dosen ? $dosen->bimbinganMagang()->where('status_magang', 'Selesai')->count() : 0;

        return view('dosen.dashboard', compact(
            'mhsWaliCount', 
            'mhsBimbinganCount', 
            'pendingRekomendasiCount', 
            'mhsBimbinganList',
            'lulusCount'
        ));
    }

    // --- FUNGSI DOSEN WALI ---
    public function rekomendasi()
    {
        $dosen = Auth::user()->dosen;
        $mhsWali = $dosen ? $dosen->mahasiswaWali()->with('user')->get() : collect();
        return view('dosen.rekomendasi', compact('mhsWali'));
    }

    public function rekomendasikan(Mahasiswa $mahasiswa)
    {
        $mahasiswa->update([
            'status_magang' => 'Approve' // Dosen wali merekomendasikan
        ]);
        return back()->with('success', 'Mahasiswa berhasil direkomendasikan.');
    }

    // --- FUNGSI DOSEN PEMBIMBING ---
    public function monitoring()
    {
        $dosen = Auth::user()->dosen;
        $mhsBimbingan = $dosen ? $dosen->bimbinganMagang()->with('peserta.mahasiswa')->get() : collect();
        return view('dosen.monitoring', compact('mhsBimbingan'));
    }

    public function logbook()
    {
        $dosen = Auth::user()->dosen;
        $mhsBimbingan = $dosen ? $dosen->bimbinganMagang()
            ->with(['peserta.mahasiswa', 'logbooks'])
            ->get() : collect();
            
        return view('dosen.logbook', compact('mhsBimbingan'));
    }

    public function laporan()
    {
        $dosen = Auth::user()->dosen;
        $mhsBimbingan = $dosen ? $dosen->bimbinganMagang()
            ->with(['peserta.mahasiswa', 'laporan'])
            ->get() : collect();

        return view('dosen.laporan', compact('mhsBimbingan'));
    }

    public function approveLaporan(Request $request, Magang $magang)
    {
        $request->validate([
            'status' => 'required|in:Revisi,Approve',
            'feedback' => 'required|string',
        ]);

        $laporan = $magang->laporan;
        if ($laporan) {
            $laporan->update([
                'status_laporan' => $request->status,
                'feedback_dosen' => $request->feedback,
                'is_draft' => ($request->status === 'Revisi'), // Jika revisi, kembalikan ke draf agar mahasiswa bisa edit
            ]);

            // Jika Approve, tandai magang sebagai Selesai
            if ($request->status === 'Approve') {
                $magang->update(['status_magang' => 'Selesai']);
            }
        }

        return back()->with('success', 'Review laporan berhasil disimpan.');
    }
}
