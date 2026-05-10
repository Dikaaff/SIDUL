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
        $isPeriodeOpen   = \App\Models\Setting::get('is_periode_open', '1') == '1';
        
        // Mahasiswa yang sudah di-approve dosen wali tapi BELUM daftar magang
        $pendingPendaftaranCount = \App\Models\Mahasiswa::where('status_magang', 'Approve')
                                    ->whereDoesntHave('pesertaMagang')->count();
        
        // Mahasiswa yang SUDAH daftar tapi BELUM di-plot dosen & belum aktif
        $pendingPlottingCount = Magang::where('status_magang', 'Pending')->count();
        
        $aktifCount      = Magang::where('status_magang', 'Aktif')->count();
        $selesaiCount    = Magang::where('status_magang', 'Selesai')->count();

        $recentPending = Magang::with(['peserta.mahasiswa'])
            ->where('status_magang', 'Pending')
            ->latest()
            ->take(5)
            ->get();

        return view('operator.dashboard', compact(
            'pendingPendaftaranCount', 'pendingPlottingCount', 'aktifCount', 'selesaiCount', 'recentPending', 'isPeriodeOpen'
        ));
    }

    public function togglePeriode()
    {
        try {
            $current = \App\Models\Setting::get('is_periode_open', '1');
            $newStatus = ($current == '1' || $current === 1) ? '0' : '1';
            
            \App\Models\Setting::set('is_periode_open', $newStatus);

            $msg = $newStatus == '1' ? '🚀 Berhasil! Periode pendaftaran magang kini TELAH DIBUKA.' : '🔒 Berhasil! Periode pendaftaran magang kini TELAH DITUTUP.';
            return back()->with('success', $msg);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status periode. Pastikan database sudah ter-update (Run: php artisan migrate). Error: ' . $e->getMessage());
        }
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
        // Tampilkan mahasiswa yang statusnya Pending (Baru daftar)
        $belumAssign = Magang::with(['peserta.mahasiswa'])
            ->where('status_magang', 'Pending')
            ->get();

        $sudahAssign = Magang::with(['peserta.mahasiswa', 'pembimbing'])
            ->where('status_magang', 'Aktif')
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
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        // Auto Generate ID Magang (Prefix SIDUL-YYYY-XXX)
        $tahun     = now()->year;
        $prefix    = "SIDUL-{$tahun}-";
        $lastCount = Magang::where('kode_magang', 'LIKE', "{$prefix}%")
            ->count();
        $kode = $prefix . str_pad($lastCount + 1, 3, '0', STR_PAD_LEFT);

        // Safety check: jika kode menabrak (jarang terjadi tapi bisa di lingkungan dev), increment terus
        while (Magang::where('kode_magang', $kode)->exists()) {
            $lastCount++;
            $kode = $prefix . str_pad($lastCount + 1, 3, '0', STR_PAD_LEFT);
        }

        $magang->update([
            'dosen_pembimbing_id' => $request->dosen_id,
            'kode_magang'         => $kode,
            'status_magang'       => 'Aktif',
        ]);

        return back()->with('success', "Mahasiswa disetujui! ID Magang {$kode} diterbitkan dan Dosen Pembimbing telah ditetapkan.");
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
    public function monitoring(Request $request)
    {
        $query = Magang::with(['peserta.mahasiswa', 'pembimbing']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nim', 'LIKE', "%{$search}%")
                  ->orWhere('perusahaan', 'LIKE', "%{$search}%")
                  ->orWhere('kode_magang', 'LIKE', "%{$search}%")
                  ->orWhereHas('peserta.mahasiswa', function($mq) use ($search) {
                      $mq->where('nama', 'LIKE', "%{$search}%");
                  });
            });
        }

        $magangs = $query->latest()->get();

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

    /**
     * Hapus data magang (untuk data testing atau salah input).
     */
    public function destroy(Magang $magang)
    {
        $magang->delete();
        return back()->with('success', 'Data magang berhasil dihapus dari sistem.');
    }
}
