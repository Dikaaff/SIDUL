<?php

namespace App\Http\Controllers;

use App\Services\MahasiswaService;
use App\Services\PeriodeService;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Laporan;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    # fungsi constructor untuk menginisialisasi service
    public function __construct(
        protected MahasiswaService $mahasiswaService
    ) {}

    # fungsi untuk menampilkan dashboard mahasiswa
    public function dashboard()
    {
        $user = Auth::user();
        $mahasiswa = $this->mahasiswaService->getCurrentMahasiswa($user);

        if (!$mahasiswa) {
            return redirect('/dashboard')->with('error', 'Data profil mahasiswa tidak ditemukan.');
        }

        $magang = $this->mahasiswaService->getMagang($user);
        $logbookCount = $magang ? Logbook::where('magang_id', $magang->id)->count() : 0;
        $laporan = $magang ? Laporan::where('magang_id', $magang->id)->first() : null;

        return view('mahasiswa.dashboard', [
            'mahasiswa'    => $mahasiswa,
            'magang'       => $magang,
            'logbookCount' => $logbookCount,
            'laporan'      => $laporan,
            'pendaftaran'  => $magang,
            'isPeriodeOpen' => PeriodeService::isOpen(),
        ]);
    }

    # fungsi untuk menampilkan halaman pendaftaran magang
    public function pendaftaran()
    {
        $user = Auth::user();
        $mahasiswa = $this->mahasiswaService->getCurrentMahasiswa($user);

        if (!$mahasiswa) {
            return redirect('/dashboard');
        }

        $check = $this->mahasiswaService->isPendaftaranAllowed($mahasiswa);
        if (!$check->success) {
            return redirect()->route('mahasiswa.dashboard')->with('error', $check->message);
        }

        return view('mahasiswa.pendaftaran');
    }

    # fungsi untuk menyimpan data pendaftaran magang
    public function storePendaftaran(Request $request)
    {
        $request->validate([
            'tipe_magang'     => 'required|in:individu,kelompok',
            'konsentrasi'     => 'required|string',
            'perusahaan'      => 'required|string|max:255',
            'alamat'          => 'required|string',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'nim_anggota'     => 'nullable|array',
            'nim_anggota.*'   => 'nullable|string|exists:mahasiswas,nim',
        ], [
            'nim_anggota.*.exists' => 'Salah satu NIM anggota tidak terdaftar di sistem.',
        ]);

        $result = $this->mahasiswaService->daftar(Auth::user(), $request->all());

        if (!$result->success) {
            return back()->with('error', $result->message)->withInput();
        }

        return redirect()->route('mahasiswa.dashboard')->with('success', $result->message);
    }

    # fungsi untuk menampilkan halaman surat pengantar magang
    public function suratPengantar()
    {
        $user = Auth::user();
        $mahasiswa = $this->mahasiswaService->getCurrentMahasiswa($user);
        if (!$mahasiswa) return redirect('/dashboard');

        $magang = $this->mahasiswaService->getMagang($user);
        if (!$magang) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Surat pengantar belum tersedia.');
        }

        return view('mahasiswa.surat_pengantar', compact('mahasiswa', 'magang'));
    }

    # fungsi untuk menampilkan halaman logbook
    public function logbook()
    {
        $user = Auth::user();
        $mahasiswa = $this->mahasiswaService->getCurrentMahasiswa($user);
        if (!$mahasiswa) return redirect('/dashboard')->with('error', 'Data profil mahasiswa tidak ditemukan.');

        $magang = $this->mahasiswaService->getMagang($user);
        if (!$magang || !$this->mahasiswaService->isMagangAktif($magang)) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Fitur Logbook hanya tersedia setelah pendaftaran Anda disetujui.');
        }

        $logbooks = $this->mahasiswaService->getLogbooks($user);
        return view('mahasiswa.logbook', [
            'logbooks'     => $logbooks,
            'isPeriodeOpen' => PeriodeService::isOpen(),
        ]);
    }

    # fungsi untuk menyimpan data logbook
    public function storeLogbook(Request $request)
    {
        $request->validate(['logbook' => 'required|string']);

        $result = $this->mahasiswaService->simpanLogbook(Auth::user(), $request->logbook);

        return back()->with($result->success ? 'success' : 'error', $result->message);
    }

    # fungsi untuk menampilkan halaman laporan magang
    public function laporan()
    {
        $user = Auth::user();
        $mahasiswa = $this->mahasiswaService->getCurrentMahasiswa($user);
        if (!$mahasiswa) return redirect('/dashboard');

        $magang = $this->mahasiswaService->getMagang($user);
        if (!$magang || !$this->mahasiswaService->isMagangAktif($magang)) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Fitur Laporan hanya tersedia setelah pendaftaran Anda disetujui.');
        }

        $laporan = Laporan::where('magang_id', $magang->id)->first();
        return view('mahasiswa.laporan', [
            'laporan'      => $laporan,
            'isPeriodeOpen' => PeriodeService::isOpen(),
        ]);
    }

    # fungsi untuk menyimpan data laporan magang
    public function storeLaporan(Request $request)
    {
        $request->validate([
            'magang_id' => 'required|exists:magangs,id',
            'judul'     => 'required|string|max:255',
            'bab1'      => 'nullable|string',
            'bab2'      => 'nullable|string',
            'bab3'      => 'nullable|string',
            'bab4'      => 'nullable|string',
        ]);

        $result = $this->mahasiswaService->simpanLaporan(Auth::user(), $request->all());

        return back()->with($result->success ? 'success' : 'error', $result->message);
    }

    # fungsi untuk mencetak laporan magang dalam format PDF
    public function cetakLaporan()
    {
        $user = Auth::user();
        $mahasiswa = $this->mahasiswaService->getCurrentMahasiswa($user);
        if (!$mahasiswa) return redirect('/dashboard');

        $magang = $this->mahasiswaService->getMagang($user);
        if (!$magang) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Laporan tidak ditemukan.');
        }

        $laporan = Laporan::where('magang_id', $magang->id)->first();
        if (!$laporan) {
            return redirect()->back()->with('error', 'Silakan simpan draft laporan terlebih dahulu.');
        }

        $pdf = Pdf::loadView('mahasiswa.laporan_pdf', compact('mahasiswa', 'magang', 'laporan'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Akhir_' . $mahasiswa->nim . '.pdf');
    }

    # fungsi untuk mencetak logbook dalam format PDF
    public function cetakLogbook()
    {
        $user = Auth::user();
        $mahasiswa = $this->mahasiswaService->getCurrentMahasiswa($user);
        if (!$mahasiswa) return redirect('/dashboard');

        $magang = $this->mahasiswaService->getMagang($user);
        if (!$magang) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Data magang tidak ditemukan.');
        }

        $logbooks = Logbook::where('magang_id', $magang->id)->oldest()->get();
        if ($logbooks->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada data logbook untuk dicetak.');
        }

        $pdf = Pdf::loadView('mahasiswa.logbook_pdf', compact('mahasiswa', 'magang', 'logbooks'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Logbook_Magang_' . $mahasiswa->nim . '.pdf');
    }
}
