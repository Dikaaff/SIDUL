<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Services\DosenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    # fungsi constructor untuk menginisialisasi service
    public function __construct(
        protected DosenService $dosenService
    ) {}

    # fungsi untuk menampilkan dashboard dosen
    public function dashboard()
    {
        $data = $this->dosenService->getDashboardData(Auth::user());

        return view('dosen.dashboard', $data);
    }

    # fungsi untuk menampilkan halaman rekomendasi mahasiswa
    public function rekomendasi(Request $request)
    {
        $search = $request->input('search');
        $mhsWali = $this->dosenService->getMhsWali(Auth::user(), 10, $search)->withQueryString();
        return view('dosen.rekomendasi', compact('mhsWali'));
    }

    # fungsi untuk menyetujui rekomendasi mahasiswa
    public function rekomendasikan(Mahasiswa $mahasiswa)
    {
        $this->dosenService->rekomendasikan($mahasiswa);
        return back()->with('success', 'Mahasiswa berhasil direkomendasikan.');
    }

    # fungsi untuk menolak rekomendasi mahasiswa
    public function tolakRekomendasi(Mahasiswa $mahasiswa)
    {
        $this->dosenService->tolakRekomendasi($mahasiswa);
        return back()->with('info', 'Rekomendasi mahasiswa ditolak.');
    }

    # fungsi untuk menampilkan halaman monitoring mahasiswa bimbingan
    public function monitoring()
    {
        $mhsBimbingan = $this->dosenService->getMhsBimbingan(Auth::user(), perPage: 10);
        return view('dosen.monitoring', compact('mhsBimbingan'));
    }

    # fungsi untuk menampilkan logbook mahasiswa bimbingan
    public function logbook()
    {
        $mhsBimbingan = $this->dosenService->getMhsBimbingan(Auth::user(), ['logbooks']);
        return view('dosen.logbook', compact('mhsBimbingan'));
    }

    # fungsi untuk menampilkan laporan mahasiswa bimbingan
    public function laporan(Request $request)
    {
        $search = $request->input('search');
        $mhsBimbingan = $this->dosenService->getMhsBimbingan(Auth::user(), perPage: 10, search: $search);
        return view('dosen.laporan', compact('mhsBimbingan'));
    }

    # fungsi untuk menyetujui atau merevisi laporan mahasiswa
    public function approveLaporan(Request $request, Magang $magang)
    {
        $request->validate([
            'status'   => 'required|in:revisi,approved',
            'feedback' => $request->status === 'revisi' ? 'required|string' : 'nullable|string',
        ]);

        $this->dosenService->approveLaporan($magang, $request->status, $request->feedback);

        return back()->with('success', 'Review laporan berhasil disimpan.');
    }
}
