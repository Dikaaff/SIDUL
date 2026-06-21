<?php

namespace App\Services;

use App\Models\Laporan;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\User;

class DosenService
{
    # fungsi untuk mengambil data mahasiswa wali
    public function getMhsWali(User $user, int $perPage = 5, ?string $search = null)
    {
        $dosen = $user->dosen;
        if (!$dosen) return $perPage ? new \Illuminate\Pagination\LengthAwarePaginator([], 0, $perPage) : collect();

        $query = $dosen->mahasiswaWali()->with('user');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nim', 'LIKE', "%{$search}%");
            });
        }

        return $query->paginate($perPage);
    }

    # fungsi untuk mengambil data mahasiswa bimbingan
    public function getMhsBimbingan(User $user, array $with = [], ?int $limit = null, ?int $perPage = null, ?string $search = null)
    {
        $dosen = $user->dosen;
        if (!$dosen) return $perPage ? new \Illuminate\Pagination\LengthAwarePaginator([], 0, $perPage) : collect();

        $query = $dosen->bimbinganMagang()->with(array_merge([
            'peserta.mahasiswa', 'laporan'
        ], $with))->withCount(['logbooks']);

        if ($search) {
            $query->whereHas('peserta.mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nim', 'LIKE', "%{$search}%");
            });
        }

        if ($limit) {
            $query->take($limit);
        }

        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    # fungsi untuk mengambil data dashboard dosen
    public function getDashboardData(User $user): array
    {
        $dosen = $user->dosen;
        return [
            'mhsWaliCount'          => $dosen ? $dosen->mahasiswaWali()->count() : 0,
            'pendingRekomendasiCount' => $dosen ? $dosen->mahasiswaWali()->where('status_daftar', 'Pending')->count() : 0,
            'mhsBimbinganCount'      => $dosen ? $dosen->bimbinganMagang()->count() : 0,
            'lulusCount'             => $dosen ? $dosen->bimbinganMagang()->where('status_magang', 'Selesai')->count() : 0,
            'mhsBimbinganList'       => $dosen ? $dosen->bimbinganMagang()
                ->with(['peserta.mahasiswa', 'laporan'])
                ->withCount(['logbooks'])
                ->take(5)->get() : collect(),
        ];
    }

    # fungsi untuk menyetujui rekomendasi mahasiswa
    public function rekomendasikan(Mahasiswa $mahasiswa): void
    {
        $mahasiswa->update(['status_daftar' => 'Approve']);
    }

    # fungsi untuk menolak rekomendasi mahasiswa
    public function tolakRekomendasi(Mahasiswa $mahasiswa): void
    {
        $mahasiswa->update(['status_daftar' => 'Rejected']);
    }

    # fungsi untuk menyetujui atau merevisi laporan
    public function approveLaporan(Magang $magang, string $status, ?string $feedback): void
    {
        $laporan = $magang->laporan;
        if ($laporan) {
            $laporan->update([
                'status'       => $status,
                'catatan_dosen' => $feedback ?? '',
            ]);

            if ($status === 'approved') {
                $magang->update(['status_magang' => 'Selesai']);
            }
        }
    }
}
