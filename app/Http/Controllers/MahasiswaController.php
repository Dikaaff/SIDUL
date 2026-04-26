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
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        
        $peserta = $mahasiswa ? $mahasiswa->pesertaMagang : null;
        $magang = $peserta ? $peserta->magang : null;

        $logbookCount = $magang ? Logbook::where('id_magang', $magang->id_magang)->count() : 0;
        $laporan = $magang ? Laporan::where('id_magang', $magang->id_magang)->first() : null;
        $pendaftaran = $magang;

        $isPeriodeOpen = \App\Models\Setting::get('is_periode_open', '1') == '1';

        return view('mahasiswa.dashboard', compact('user', 'mahasiswa', 'pendaftaran', 'logbookCount', 'laporan', 'isPeriodeOpen'));
    }

    public function suratPengantar()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $peserta = $mahasiswa ? $mahasiswa->pesertaMagang : null;
        $magang = $peserta ? $peserta->magang()->with(['peserta.mahasiswa', 'pembimbing'])->first() : null;

        if (!$magang || !in_array($magang->status_magang, ['Aktif', 'Selesai'])) {
            return redirect()->route('mahasiswa.home')->with('error', 'Surat pengantar belum tersedia atau magang belum aktif.');
        }

        return view('mahasiswa.surat_pengantar', compact('magang'));
    }

    public function pendaftaran()
    {
        $isPeriodeOpen = \App\Models\Setting::get('is_periode_open', '1') == '1';
        
        if (!$isPeriodeOpen) {
            return redirect()->route('mahasiswa.home')->with('error', 'Mohon maaf, periode pendaftaran magang saat ini sedang ditutup.');
        }

        $mahasiswa = Auth::user()->mahasiswa;
        
        if ($mahasiswa->status_magang !== 'Approve') {
            return redirect()->route('mahasiswa.home')->with('error', 'Anda harus mendapatkan rekomendasi dari Dosen Wali terlebih dahulu sebelum mendaftar magang.');
        }

        $peserta = $mahasiswa ? $mahasiswa->pesertaMagang : null;
        $magang = $peserta ? $peserta->magang : null;
        
        // Mahasiswa diperbolehkan melihat halaman pendaftaran meskipun sudah memiliki magang
        // untuk melihat detail pendaftaran mereka sendiri.

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
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        // --- Perbaikan Logic Reject ---
        // Jika sebelumnya ada pendaftaran yang ditolak, hapus relasi peserta lamanya
        if ($mahasiswa->pesertaMagang) {
            $mahasiswa->pesertaMagang()->delete();
        }

        $kodeMagang = 'MGN-' . $mahasiswa->nim . '-' . strtoupper(substr(md5(time()), 0, 5));

        $magang = Magang::create([
            'kode_magang' => $kodeMagang,
            'nim' => $mahasiswa->nim,
            'perusahaan' => $request->perusahaan,
            'alamat' => $request->alamat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'konsentrasi' => $request->konsentrasi,
            'tipe_magang' => $request->tipe_magang,
            'status_magang' => 'Pending',
        ]);

        PesertaMagang::create([
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'id_magang' => $magang->id_magang,
            'nim' => $mahasiswa->nim,
        ]);

        return redirect()->route('mahasiswa.home')->with('success', 'Pendaftaran baru berhasil dikirim.');
    }

    public function logbook()
    {
        if (\App\Models\Setting::get('is_periode_open', '1') !== '1') {
            return redirect()->route('mahasiswa.home')->with('error', 'Akses ditolak. Seluruh fitur (Logbook/Laporan/Pendaftaran) sedang dinonaktifkan karena periode pendaftaran sedang ditutup.');
        }

        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $peserta = $mahasiswa ? $mahasiswa->pesertaMagang : null;
        $magang = $peserta ? $peserta->magang : null;

        if (!$magang || !in_array($magang->status_magang, ['Aktif', 'Selesai'])) {
            return redirect()->route('mahasiswa.home')->with('error', 'Fitur Logbook hanya tersedia setelah pendaftaran Anda disetujui (Status Aktif).');
        }

        $logbooks = Logbook::where('id_magang', $magang->id_magang)->latest()->get();
        return view('mahasiswa.logbook', compact('logbooks'));
    }

    public function storeLogbook(Request $request)
    {
        if (\App\Models\Setting::get('is_periode_open', '1') !== '1') {
            return redirect()->route('mahasiswa.home')->with('error', 'Akses ditolak. Periode magang sedang ditutup.');
        }

        $request->validate(['logbook' => 'required']);
        $mahasiswa = Auth::user()->mahasiswa;
        $magang = $mahasiswa->pesertaMagang->magang;

        Logbook::create([
            'id_magang' => $magang->id_magang,
            'logbook' => $request->logbook
        ]);

        return back()->with('success', 'Logbook berhasil ditambahkan.');
    }

    public function laporan()
    {
        if (\App\Models\Setting::get('is_periode_open', '1') !== '1') {
            return redirect()->route('mahasiswa.home')->with('error', 'Akses ditolak. Fitur laporan tidak tersedia selama periode ditutup.');
        }

        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $peserta = $mahasiswa ? $mahasiswa->pesertaMagang : null;
        $magang = $peserta ? $peserta->magang : null;

        if (!$magang || !in_array($magang->status_magang, ['Aktif', 'Selesai'])) {
            return redirect()->route('mahasiswa.home')->with('error', 'Fitur Laporan hanya tersedia setelah pendaftaran Anda disetujui (Status Aktif).');
        }

        $laporan = Laporan::where('id_magang', $magang->id_magang)->first();
        return view('mahasiswa.laporan', compact('laporan'));
    }

    public function storeLaporan(Request $request)
    {
        if (\App\Models\Setting::get('is_periode_open', '1') !== '1') {
            return redirect()->route('mahasiswa.home')->with('error', 'Akses ditolak. Periode magang sedang ditutup.');
        }

        $request->validate([
            'id_magang' => 'required|exists:magangs,id_magang',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        $isDraft = $request->has('save_draft');

        Laporan::updateOrCreate(
            ['id_magang' => $request->id_magang],
            [
                'judul' => $request->judul,
                'konten' => $request->konten,
                'is_draft' => $isDraft,
                'status_laporan' => $isDraft ? 'Pending' : 'Pending', // Status tetap pending atau kita bisa buat status 'Draft' jika perlu
            ]
        );

        $message = $isDraft ? 'Draf laporan berhasil disimpan.' : 'Laporan akhir berhasil dikirim dan menunggu verifikasi dosen.';
        return back()->with('success', $message);
    }

    public function profile() { return view('mahasiswa.profile', ['user' => Auth::user()]); }
    public function settings() { return view('mahasiswa.settings', ['user' => Auth::user()]); }
}
