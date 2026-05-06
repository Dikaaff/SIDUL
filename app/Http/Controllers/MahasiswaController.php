<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\PesertaMagang;
use App\Models\Logbook;
use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        
        if (!$mahasiswa) {
            return redirect('/dashboard')->with('error', 'Data profil mahasiswa tidak ditemukan.');
        }
        
        $peserta = $mahasiswa->pesertaMagang;
        $magang = $peserta ? $peserta->magang : null;

        $logbookCount = $magang ? Logbook::where('magang_id', $magang->id)->count() : 0;
        $laporan = $magang ? Laporan::where('magang_id', $magang->id)->first() : null;
        $pendaftaran = $magang;

        $isPeriodeOpen = \App\Models\Setting::get('is_periode_open', '1') == '1';

        return view('mahasiswa.dashboard', compact('mahasiswa', 'magang', 'logbookCount', 'laporan', 'pendaftaran', 'isPeriodeOpen'));
    }

    public function pendaftaran()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        if (!$mahasiswa) return redirect('/dashboard');
        
        if ($mahasiswa->pesertaMagang) {
            return redirect()->route('mahasiswa.home')->with('info', 'Anda sudah terdaftar dalam sistem magang.');
        }

        if (\App\Models\Setting::get('is_periode_open', '1') == '0') {
            return redirect()->route('mahasiswa.home')->with('error', 'Mohon maaf, periode pendaftaran magang saat ini sedang ditutup.');
        }

        return view('mahasiswa.pendaftaran');
    }

    public function storePendaftaran(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        if (!$mahasiswa) return redirect('/dashboard');

        $request->validate([
            'tipe_magang' => 'required|in:individu,kelompok',
            'konsentrasi' => 'required|string',
            'perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        $magang = Magang::create([
            'kode_magang' => 'MGN-' . strtoupper(bin2hex(random_bytes(3))),
            'tipe_magang' => $request->tipe_magang,
            'konsentrasi' => $request->konsentrasi,
            'perusahaan' => $request->perusahaan,
            'alamat' => $request->alamat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_magang' => 'Pending',
        ]);

        PesertaMagang::create([
            'mahasiswa_id' => $mahasiswa->id,
            'magang_id' => $magang->id,
            'is_ketua' => true,
        ]);

        return redirect()->route('mahasiswa.home')->with('success', 'Pendaftaran magang berhasil dikirim. Menunggu verifikasi Operator.');
    }

    public function suratPengantar()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        if (!$mahasiswa) return redirect('/dashboard');

        $peserta = $mahasiswa->pesertaMagang;
        if (!$peserta || !$peserta->magang) {
            return redirect()->route('mahasiswa.home')->with('error', 'Surat pengantar belum tersedia.');
        }

        $magang = $peserta->magang;
        return view('mahasiswa.surat_pengantar', compact('mahasiswa', 'magang'));
    }

    public function logbook()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        
        // Pengecekan data mahasiswa
        if (!$mahasiswa) {
            return redirect('/dashboard')->with('error', 'Data profil mahasiswa tidak ditemukan.');
        }

        $peserta = $mahasiswa->pesertaMagang;
        
        if (!$peserta || !in_array($peserta->magang->status_magang, ['Aktif', 'berjalan', 'Approve', 'Selesai'])) {
            return redirect()->route('mahasiswa.home')->with('error', 'Fitur Logbook hanya tersedia setelah pendaftaran Anda disetujui.');
        }

        $magang = $peserta->magang;
        $logbooks = Logbook::where('magang_id', $magang->id)->latest()->get();
        return view('mahasiswa.logbook', compact('logbooks'));
    }

    public function storeLogbook(Request $request)
    {
        $request->validate([
            'logbook' => 'required|string',
        ]);

        $mahasiswa = Auth::user()->mahasiswa;
        if (!$mahasiswa || !$mahasiswa->pesertaMagang) return back();

        $magang = $mahasiswa->pesertaMagang->magang;

        Logbook::create([
            'magang_id' => $magang->id,
            'tanggal' => now(),
            'kegiatan' => $request->logbook
        ]);

        return back()->with('success', 'Logbook hari ini berhasil disimpan.');
    }

    public function laporan()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        if (!$mahasiswa) return redirect('/dashboard');

        $peserta = $mahasiswa->pesertaMagang;
        
        if (!$peserta || !in_array($peserta->magang->status_magang, ['Aktif', 'berjalan', 'Approve', 'Selesai'])) {
            return redirect()->route('mahasiswa.home')->with('error', 'Fitur Laporan hanya tersedia setelah pendaftaran Anda disetujui.');
        }

        $magang = $peserta->magang;
        $laporan = Laporan::where('magang_id', $magang->id)->first();
        return view('mahasiswa.laporan', compact('laporan'));
    }

    public function storeLaporan(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        if (!$mahasiswa || !$mahasiswa->pesertaMagang) {
            return back()->with('error', 'Data magang tidak ditemukan.');
        }

        $request->validate([
            'magang_id' => 'required|exists:magangs,id',
            'judul' => 'required|string|max:255',
            'bab1' => 'nullable|string',
            'bab2' => 'nullable|string',
            'bab3' => 'nullable|string',
            'bab4' => 'nullable|string',
        ]);

        Laporan::updateOrCreate(
            ['magang_id' => $request->magang_id],
            [
                'judul' => $request->judul,
                'bab1' => $request->bab1,
                'bab2' => $request->bab2,
                'bab3' => $request->bab3,
                'bab4' => $request->bab4,
                'status' => 'review',
            ]
        );

        return back()->with('success', 'Laporan berhasil disimpan.');
    }

    public function cetakLaporan()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        if (!$mahasiswa) return redirect('/dashboard');

        $peserta = $mahasiswa->pesertaMagang;
        if (!$peserta || !$peserta->magang) {
            return redirect()->route('mahasiswa.home')->with('error', 'Laporan tidak ditemukan.');
        }

        $magang = $peserta->magang;
        $laporan = Laporan::where('magang_id', $magang->id)->first();

        if (!$laporan) {
            return redirect()->back()->with('error', 'Silakan simpan draft laporan terlebih dahulu.');
        }

        $pdf = Pdf::loadView('mahasiswa.laporan_pdf', compact('mahasiswa', 'magang', 'laporan'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Akhir_' . $mahasiswa->nim . '.pdf');
    }

    public function profile()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        return view('mahasiswa.profile', compact('mahasiswa'));
    }

    public function settings()
    {
        return view('mahasiswa.settings');
    }
}
