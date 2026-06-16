<?php

namespace App\Services;

use App\Models\Logbook;
use App\Models\Laporan;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\PesertaMagang;
use App\Models\User;

class MahasiswaService
{
    # fungsi untuk mengambil data mahasiswa dari user
    public function getCurrentMahasiswa(User $user): ?Mahasiswa
    {
        return $user->mahasiswa;
    }

    # fungsi untuk mengecek apakah pendaftaran magang diizinkan
    public function isPendaftaranAllowed(Mahasiswa $mahasiswa): ServiceResult
    {
        if (PeriodeService::isClosed()) {
            return ServiceResult::error('Mohon maaf, periode pendaftaran magang saat ini sedang ditutup.');
        }

        if ($mahasiswa->status_daftar !== 'Approve') {
            return ServiceResult::error('Anda harus mendapatkan rekomendasi dari Dosen Wali terlebih dahulu.');
        }

        if ($mahasiswa->pesertaMagang) {
            return ServiceResult::error('Anda sudah terdaftar dalam sistem magang.');
        }

        return ServiceResult::ok();
    }

    # fungsi untuk memproses pendaftaran magang
    public function daftar(User $user, array $data): ServiceResult
    {
        $mahasiswa = $this->getCurrentMahasiswa($user);
        if (!$mahasiswa) {
            return ServiceResult::error('Data profil mahasiswa tidak ditemukan.');
        }

        $check = $this->isPendaftaranAllowed($mahasiswa);
        if (!$check->success) {
            return $check;
        }

        if ($data['tipe_magang'] === 'kelompok') {
            $result = $this->validasiKelompok($data['nim_anggota'] ?? []);
            if (!$result->success) {
                return $result;
            }
        }

        $magang = Magang::create([
            'kode_magang'       => 'MGN-' . strtoupper(bin2hex(random_bytes(3))),
            'tipe_magang'       => $data['tipe_magang'],
            'konsentrasi'       => $data['konsentrasi'],
            'perusahaan'        => $data['perusahaan'],
            'alamat'            => $data['alamat'],
            'tanggal_mulai'     => $data['tanggal_mulai'],
            'tanggal_selesai'   => $data['tanggal_selesai'],
            'status_magang'     => 'Pending',
        ]);

        PesertaMagang::create([
            'mahasiswa_id' => $mahasiswa->id,
            'magang_id'    => $magang->id,
            'is_ketua'      => true,
        ]);

        if ($data['tipe_magang'] === 'kelompok') {
            $anggotaNims = array_filter($data['nim_anggota'] ?? []);
            foreach ($anggotaNims as $nim) {
                $mhsAnggota = Mahasiswa::where('nim', $nim)->first();
                PesertaMagang::create([
                    'mahasiswa_id' => $mhsAnggota->id,
                    'magang_id'    => $magang->id,
                    'is_ketua'      => false,
                ]);
            }
        }

        return ServiceResult::ok('Pendaftaran magang berhasil dikirim. Menunggu verifikasi Operator.');
    }

    # fungsi untuk mengambil data magang user
    public function getMagang(User $user): ?Magang
    {
        $mahasiswa = $this->getCurrentMahasiswa($user);
        if (!$mahasiswa || !$mahasiswa->pesertaMagang) {
            return null;
        }
        return $mahasiswa->pesertaMagang->magang;
    }

    # fungsi untuk mengecek status magang aktif
    public function isMagangAktif(Magang $magang): bool
    {
        return in_array($magang->status_magang, ['Aktif', 'berjalan', 'Approve', 'Selesai']);
    }

    # fungsi untuk menyimpan logbook harian
    public function simpanLogbook(User $user, string $kegiatan): ServiceResult
    {
        if (PeriodeService::isClosed()) {
            return ServiceResult::error('Gagal! Pengisian logbook telah ditutup.');
        }

        $mahasiswa = $this->getCurrentMahasiswa($user);
        if (!$mahasiswa || !$mahasiswa->pesertaMagang) {
            return ServiceResult::error('Data magang tidak ditemukan.');
        }

        $magang = $mahasiswa->pesertaMagang->magang;

        if (!$this->isMagangAktif($magang)) {
            return ServiceResult::error('Logbook hanya tersedia untuk magang aktif.');
        }

        Logbook::create([
            'magang_id' => $magang->id,
            'tanggal'   => now(),
            'kegiatan'  => $kegiatan,
        ]);

        return ServiceResult::ok('Logbook hari ini berhasil disimpan.');
    }

    # fungsi untuk mengambil data logbook user
    public function getLogbooks(User $user)
    {
        $magang = $this->getMagang($user);
        if (!$magang) return collect();
        return Logbook::where('magang_id', $magang->id)->latest()->get();
    }

    # fungsi untuk menyimpan draft laporan magang
    public function simpanLaporan(User $user, array $data, bool $submit = false): ServiceResult
    {
        if (!$submit && PeriodeService::isClosed()) {
            return ServiceResult::error('Gagal! Unggah laporan telah ditutup.');
        }

        if ($submit && PeriodeService::isClosed()) {
            return ServiceResult::error('Gagal! Periode pengiriman laporan telah ditutup.');
        }

        $mahasiswa = $this->getCurrentMahasiswa($user);
        if (!$mahasiswa || !$mahasiswa->pesertaMagang) {
            return ServiceResult::error('Data magang tidak ditemukan.');
        }

        $laporan = Laporan::where('magang_id', $data['magang_id'])->first();
        if ($laporan && $laporan->status === 'approved') {
            return ServiceResult::error('Laporan sudah disetujui dosen dan tidak dapat diedit lagi.');
        }

        if ($submit) {
            $status = 'review';
        } elseif ($laporan) {
            $status = $laporan->status;
        } else {
            $status = 'draft';
        }

        Laporan::updateOrCreate(
            ['magang_id' => $data['magang_id']],
            [
                'judul'  => $data['judul'],
                'bab1'   => $data['bab1'] ?? null,
                'bab2'   => $data['bab2'] ?? null,
                'bab3'   => $data['bab3'] ?? null,
                'bab4'   => $data['bab4'] ?? null,
                'status' => $status,
            ]
        );

        $message = $submit ? 'Laporan berhasil dikirim untuk direview.' : 'Draft laporan berhasil disimpan.';
        return ServiceResult::ok($message);
    }

    # fungsi untuk memvalidasi anggota kelompok magang
    private function validasiKelompok(array $nimAnggota): ServiceResult
    {
        $anggotaNims = array_filter($nimAnggota);
        if (count($anggotaNims) < 1) {
            return ServiceResult::error('Pendaftaran kelompok minimal harus memiliki 2 orang (termasuk Ketua).');
        }
        if (count($anggotaNims) > 2) {
            return ServiceResult::error('Pendaftaran kelompok maksimal 3 orang (termasuk Ketua).');
        }

        foreach ($anggotaNims as $nim) {
            $mhs = Mahasiswa::where('nim', $nim)->first();
            if ($mhs->status_daftar !== 'Approve') {
                return ServiceResult::error("Mahasiswa dengan NIM {$nim} ({$mhs->nama}) belum mendapat rekomendasi Dosen Wali.");
            }
            if ($mhs->pesertaMagang) {
                return ServiceResult::error("Mahasiswa dengan NIM {$nim} ({$mhs->nama}) sudah terdaftar di magang lain.");
            }
        }

        return ServiceResult::ok();
    }
}
