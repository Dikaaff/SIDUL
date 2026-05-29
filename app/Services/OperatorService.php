<?php

namespace App\Services;

use App\Models\Dosen;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\User;

class OperatorService
{
    # fungsi untuk mengambil statistik dashboard operator
    public function getDashboardStats(): array
    {
        $pendingPendaftaran = Mahasiswa::where('status_magang', 'Approve')
            ->whereDoesntHave('pesertaMagang')->count();

        return [
            'isPeriodeOpen'          => PeriodeService::isOpen(),
            'pendingPendaftaranCount' => $pendingPendaftaran,
            'pendingPlottingCount'    => Magang::where('status_magang', 'Pending')->count(),
            'aktifCount'              => Magang::where('status_magang', 'Aktif')->count(),
            'selesaiCount'            => Magang::where('status_magang', 'Selesai')->count(),
            'recentPending'           => Magang::with(['peserta.mahasiswa'])
                ->where('status_magang', 'Pending')
                ->latest()->take(5)->get(),
        ];
    }

    # fungsi untuk menugaskan dosen pembimbing ke magang
    public function assignDosen(Magang $magang, int $dosenId): string
    {
        $tahun = now()->year;
        $prefix = "SIDUL-{$tahun}-";
        $lastCount = Magang::where('kode_magang', 'LIKE', "{$prefix}%")->count();
        $kode = $prefix . str_pad($lastCount + 1, 3, '0', STR_PAD_LEFT);

        while (Magang::where('kode_magang', $kode)->exists()) {
            $lastCount++;
            $kode = $prefix . str_pad($lastCount + 1, 3, '0', STR_PAD_LEFT);
        }

        $magang->update([
            'dosen_pembimbing_id' => $dosenId,
            'kode_magang'         => $kode,
            'status_magang'       => 'Aktif',
        ]);

        return $kode;
    }

    # fungsi untuk mengambil data magang yang belum ditugaskan
    public function getBelumAssign()
    {
        return Magang::with(['peserta.mahasiswa'])
            ->where('status_magang', 'Pending')
            ->get();
    }

    # fungsi untuk mengambil data magang yang sudah ditugaskan
    public function getSudahAssign()
    {
        return Magang::with(['peserta.mahasiswa', 'pembimbing'])
            ->where('status_magang', 'Aktif')
            ->latest()
            ->get();
    }

    # fungsi untuk mengambil daftar dosen
    public function getDosens()
    {
        return Dosen::orderBy('nama')->get();
    }

    # fungsi untuk memfilter data monitoring magang
    public function monitoring(array $filters = [])
    {
        $query = Magang::with(['peserta.mahasiswa', 'pembimbing', 'laporan'])
            ->withCount('logbooks');

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('perusahaan', 'LIKE', "%{$search}%")
                  ->orWhere('kode_magang', 'LIKE', "%{$search}%")
                  ->orWhereHas('peserta.mahasiswa', function ($mq) use ($search) {
                      $mq->where('nama', 'LIKE', "%{$search}%")
                        ->orWhere('nim', 'LIKE', "%{$search}%");
                  });
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status_magang', $filters['status']);
        }

        return $query->latest()->get();
    }

    # fungsi untuk mengambil data magang yang sudah memiliki laporan
    public function getLaporanMagang()
    {
        return Magang::with(['peserta.mahasiswa', 'laporan'])
            ->whereHas('laporan')
            ->latest()
            ->get();
    }
}
