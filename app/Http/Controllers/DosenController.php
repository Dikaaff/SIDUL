<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Services\DosenService;
use Barryvdh\DomPDF\Facade\Pdf;
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

    # fungsi untuk mencetak PDF logbook mahasiswa bimbingan
    public function cetakLogbookPdf(Magang $magang)
    {
        $mahasiswa = $magang->peserta->first()?->mahasiswa;

        if (!$mahasiswa) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $logbooks = $magang->logbooks()->oldest()->get();

        if ($logbooks->isEmpty()) {
            return back()->with('error', 'Belum ada data logbook untuk dicetak.');
        }

        $pdf = Pdf::loadView('mahasiswa.logbook_pdf', compact('mahasiswa', 'magang', 'logbooks'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Logbook_Magang_' . $mahasiswa->nim . '.pdf');
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

    # fungsi untuk mencetak PDF laporan mahasiswa yang sudah disetujui
    public function cetakLaporanPdf(Magang $magang)
    {
        $laporan = $magang->laporan;

        if (!$laporan || $laporan->status !== 'approved') {
            return back()->with('error', 'Laporan belum disetujui.');
        }

        $mahasiswa = $magang->peserta->first()?->mahasiswa;

        if (!$mahasiswa) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $pdf = Pdf::loadView('mahasiswa.laporan_pdf', compact('mahasiswa', 'magang', 'laporan'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Akhir_' . $mahasiswa->nim . '.pdf');
    }
}
