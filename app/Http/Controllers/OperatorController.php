<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Magang;
use App\Models\Dosen;

class OperatorController extends Controller
{
    /**
     * Dashboard Operator — ringkasan statistik sistem magang.
     */
    public function dashboard()
    {
        $pendingCount    = Magang::where('status_magang', 'Pending')->count();
        $belumDosenCount = Magang::where('status_magang', 'Terverifikasi')
                            ->whereNull('dosen_pembimbing_id')->count();
        $aktifCount      = Magang::where('status_magang', 'Aktif')->count();
        $selesaiCount    = Magang::where('status_magang', 'Selesai')->count();

        $recentPending = Magang::with(['peserta.mahasiswa'])
            ->where('status_magang', 'Pending')
            ->latest()
            ->take(5)
            ->get();

        return view('operator.dashboard', compact(
            'pendingCount', 'belumDosenCount', 'aktifCount', 'selesaiCount', 'recentPending'
        ));
    }

    /**
     * Halaman Verifikasi — semua pendaftaran diurutkan status.
     */
    public function verifikasi()
    {
        $magangs = Magang::with(['peserta.mahasiswa'])
            ->orderByRaw("FIELD(status_magang, 'Pending', 'Terverifikasi', 'Aktif', 'Selesai', 'Ditolak')")
            ->latest()
            ->get();

        return view('operator.verifikasi', compact('magangs'));
    }

    /**
     * Approve (Verifikasi) pendaftaran magang.
     */
    public function verifikasiApprove(Magang $magang)
    {
        $magang->update(['status_magang' => 'Terverifikasi']);
        return back()->with('success', 'Pendaftaran berhasil diverifikasi.');
    }

    /**
     * Tolak / Batalkan pendaftaran magang (termasuk pergantian tim).
     */
    public function verifikasiTolak(Request $request, Magang $magang)
    {
        $request->validate([
            'catatan' => 'required|string|min:5',
        ]);

        $magang->update([
            'status_magang'    => 'Ditolak',
            'catatan_operator' => $request->catatan,
        ]);

        return back()->with('success', 'Pendaftaran ditolak. Mahasiswa dapat mendaftar ulang.');
    }

    /**
     * Halaman Plotting Dosen Pembimbing.
     */
    public function dosenPembimbing()
    {
        $belumAssign = Magang::with(['peserta.mahasiswa'])
            ->where('status_magang', 'Terverifikasi')
            ->whereNull('dosen_pembimbing_id')
            ->get();

        $sudahAssign = Magang::with(['peserta.mahasiswa', 'pembimbing'])
            ->whereNotNull('dosen_pembimbing_id')
            ->latest()
            ->get();

        $dosens = Dosen::orderBy('nama')->get();

        return view('operator.dosen_pembimbing', compact('belumAssign', 'sudahAssign', 'dosens'));
    }

    /**
     * Assign Dosen Pembimbing ke Magang — otomatis set status = Aktif.
     */
    public function assignDosen(Request $request, Magang $magang)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id_dosen',
        ]);

        $magang->update([
            'dosen_pembimbing_id' => $request->dosen_id,
            'status_magang'       => 'Aktif',
        ]);

        return back()->with('success', 'Dosen Pembimbing berhasil di-assign. Status magang kini Aktif.');
    }

    /**
     * Halaman Kelola ID Magang.
     */
    public function idMagang()
    {
        $belumId = Magang::with(['peserta.mahasiswa'])
            ->where('status_magang', 'Terverifikasi')
            ->whereNull('kode_magang')
            ->get();

        $sudahId = Magang::with(['peserta.mahasiswa'])
            ->whereNotNull('kode_magang')
            ->latest()
            ->get();

        return view('operator.id_magang', compact('belumId', 'sudahId'));
    }

    /**
     * Generate kode ID Magang unik: format MGG-YYYY-NNN.
     */
    public function generateId(Magang $magang)
    {
        $tahun     = now()->year;
        $lastCount = Magang::whereNotNull('kode_magang')
            ->whereYear('created_at', $tahun)
            ->count();
        $kode = 'MGG-' . $tahun . '-' . str_pad($lastCount + 1, 3, '0', STR_PAD_LEFT);

        $magang->update(['kode_magang' => $kode]);

        return back()->with('success', "ID Magang {$kode} berhasil dibuat.");
    }

    /**
     * Monitoring — semua mahasiswa magang di seluruh sistem.
     */
    public function monitoring()
    {
        $magangs = Magang::with(['peserta.mahasiswa', 'pembimbing'])
            ->latest()
            ->get();

        return view('operator.monitoring', compact('magangs'));
    }

    /**
     * Laporan magang (view only untuk Operator).
     */
    public function laporan()
    {
        $magangs = Magang::with(['peserta.mahasiswa', 'laporan'])
            ->whereHas('laporan')
            ->latest()
            ->get();

        return view('operator.laporan', compact('magangs'));
    }
}
