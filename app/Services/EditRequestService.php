<?php

namespace App\Services;

use App\Models\EditRequest;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\PesertaMagang;
use App\Models\User;

class EditRequestService
{
    # fungsi untuk mengambil daftar field yang dapat diedit
    public function getEditableFields(bool $hasMagang = false, ?Magang $magang = null, ?Mahasiswa $mahasiswa = null): array
    {
        $fields = [
            'nama' => 'Nama Lengkap',
            'konsentrasi' => 'Konsentrasi',
        ];

        if ($hasMagang && $magang) {
            $fields['perusahaan'] = 'Nama Perusahaan';
            $fields['alamat'] = 'Alamat Perusahaan';
            $fields['periode_magang'] = 'Periode Magang';

            if ($magang->tipe_magang === 'kelompok' && $mahasiswa && $mahasiswa->pesertaMagang?->is_ketua) {
                $fields['anggota_kelompok'] = 'Anggota Kelompok';
            }
        }

        return $fields;
    }

    # fungsi untuk menentukan target tabel dari field yang akan diedit
    public static function getFieldTarget(string $field): string
    {
        return match($field) {
            'nama' => 'mahasiswa',
            'perusahaan', 'alamat', 'periode_magang', 'anggota_kelompok', 'konsentrasi' => 'magang',
            default => 'mahasiswa',
        };
    }

    # fungsi untuk mengambil nilai saat ini dari field yang akan diedit
    public function getCurrentValues(Mahasiswa $mahasiswa, ?Magang $magang = null): array
    {
        $values = [
            'nama' => $mahasiswa->nama,
        ];

        if ($magang) {
            $values['konsentrasi'] = $magang->konsentrasi;
            $values['perusahaan'] = $magang->perusahaan;
            $values['alamat'] = $magang->alamat;
            $values['periode_magang'] = ($magang->tanggal_mulai?->format('Y-m-d') ?? '') . ' s/d ' . ($magang->tanggal_selesai?->format('Y-m-d') ?? '');

            $anggota = $magang->peserta->filter(fn($p) => !$p->is_ketua);
            $values['anggota_kelompok'] = $anggota->map(fn($p) => $p->mahasiswa->nim . ' - ' . $p->mahasiswa->nama)->implode(', ') ?: '-';
        }

        return $values;
    }

    # fungsi untuk mengecek apakah mahasiswa memiliki permintaan edit yang pending
    public function hasPendingRequest(Mahasiswa $mahasiswa): bool
    {
        return EditRequest::where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'pending')
            ->exists();
    }

    # fungsi untuk mengambil daftar permintaan edit yang pending untuk operator
    public function getPendingRequestsForOperator()
    {
        return EditRequest::with(['mahasiswa.user', 'user', 'mahasiswa.pesertaMagang.magang'])
            ->where('status', 'pending')
            ->latest()
            ->get();
    }

    # fungsi untuk mengambil riwayat permintaan edit milik mahasiswa
    public function getHistoryForMahasiswa(Mahasiswa $mahasiswa)
    {
        return EditRequest::where('mahasiswa_id', $mahasiswa->id)
            ->with('processor')
            ->latest()
            ->get();
    }

    # fungsi untuk mengajukan permintaan edit data
    public function ajukan(User $user, array $data): ServiceResult
    {
        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return ServiceResult::error('Data mahasiswa tidak ditemukan.');
        }

        $magang = $mahasiswa->pesertaMagang?->magang;
        $hasMagang = $magang !== null;

        $editableFields = $this->getEditableFields($hasMagang, $magang);
        $field = $data['field'];

        if (!array_key_exists($field, $editableFields)) {
            return ServiceResult::error('Field yang Anda pilih tidak valid.');
        }

        $targetType = $this->getFieldTarget($field);
        $targetId = $targetType === 'magang' ? $magang?->id : $mahasiswa->id;

        if ($this->hasPendingRequest($mahasiswa)) {
            return ServiceResult::error('Anda masih memiliki permintaan edit yang menunggu diproses.');
        }

        if ($field === 'anggota_kelompok') {
            if (!$mahasiswa->pesertaMagang?->is_ketua) {
                return ServiceResult::error('Hanya ketua kelompok yang dapat mengubah anggota kelompok.');
            }
            return $this->ajukanAnggotaKelompok($mahasiswa, $user, $magang, $data);
        }

        $alasan = trim($data['alasan']);
        $currentValues = $this->getCurrentValues($mahasiswa, $magang);

        if ($field === 'periode_magang') {
            $newMulai = trim($data['new_value_start'] ?? '');
            $newSelesai = trim($data['new_value_end'] ?? '');
            if (!$newMulai || !$newSelesai) {
                return ServiceResult::error('Periode mulai dan selesai harus diisi.');
            }
            $oldMulai = $magang->tanggal_mulai?->format('Y-m-d') ?? '';
            $oldSelesai = $magang->tanggal_selesai?->format('Y-m-d') ?? '';
            if ($oldMulai === $newMulai && $oldSelesai === $newSelesai) {
                return ServiceResult::error('Periode magang sama dengan saat ini. Tidak ada perubahan.');
            }
            $newValue = $newMulai . '|' . $newSelesai;
            $oldValue = $oldMulai . ' s/d ' . $oldSelesai;
        } else {
            $newValue = trim($data['new_value']);
            $oldValue = $currentValues[$field] ?? '';
            if ($oldValue === $newValue) {
                return ServiceResult::error('Nilai baru sama dengan nilai saat ini. Tidak ada perubahan.');
            }
        }

        EditRequest::create([
            'mahasiswa_id' => $mahasiswa->id,
            'user_id' => $user->id,
            'target_type' => $targetType,
            'target_id' => $targetId,
            'field' => $field,
            'old_value' => $oldValue,
            'new_value' => $newValue,
            'alasan' => $alasan,
            'status' => 'pending',
        ]);

        $label = $editableFields[$field];
        return ServiceResult::ok("Permintaan edit {$label} berhasil dikirim. Silakan tunggu konfirmasi dari Operator.");
    }

    # fungsi untuk mengajukan perubahan anggota kelompok
    private function ajukanAnggotaKelompok(Mahasiswa $mahasiswa, User $user, Magang $magang, array $data): ServiceResult
    {
        \Log::info('ajukanAnggotaKelompok called', ['data' => $data, 'mahasiswa_id' => $mahasiswa->id]);

        $nimAnggota = array_filter($data['nim_anggota'] ?? []);
        $alasan = trim($data['alasan']);

        if (count($nimAnggota) < 1) {
            return ServiceResult::error('Minimal harus memiliki 1 anggota kelompok (selain ketua).');
        }
        if (count($nimAnggota) > 2) {
            return ServiceResult::error('Maksimal 2 anggota kelompok (total 3 orang termasuk ketua).');
        }

        $currentAnggota = $magang->peserta->filter(fn($p) => !$p->is_ketua);
        $oldAnggotaNims = $currentAnggota->map(fn($p) => $p->mahasiswa->nim)->toArray();
        sort($oldAnggotaNims);
        $newAnggotaNims = $nimAnggota;
        sort($newAnggotaNims);

        if ($oldAnggotaNims === $newAnggotaNims) {
            return ServiceResult::error('Komposisi anggota kelompok sama dengan saat ini. Tidak ada perubahan.');
        }

        foreach ($nimAnggota as $nim) {
            \Log::info("ajukanAnggotaKelompok: checking NIM {$nim}");
            $mhs = Mahasiswa::where('nim', $nim)->first();
            if (!$mhs) {
                \Log::warning("ajukanAnggotaKelompok: NIM {$nim} not found");
                return ServiceResult::error("NIM {$nim} tidak terdaftar di sistem.");
            }
            if ($mhs->id === $mahasiswa->id) {
                \Log::warning("ajukanAnggotaKelompok: cannot add self");
                return ServiceResult::error("Anda tidak bisa menambahkan diri sendiri sebagai anggota.");
            }
            \Log::info("ajukanAnggotaKelompok: {$nim} status_daftar = {$mhs->status_daftar}");
            if ($mhs->status_daftar !== 'Approve') {
                \Log::warning("ajukanAnggotaKelompok: {$nim} NOT approved (status={$mhs->status_daftar})");
                return ServiceResult::error("Mahasiswa NIM {$nim} ({$mhs->nama}) belum mendapat rekomendasi dari Dosen Wali.");
            }
            if ($mhs->pesertaMagang && $mhs->pesertaMagang->magang_id !== $magang->id) {
                return ServiceResult::error("Mahasiswa NIM {$nim} ({$mhs->nama}) sudah terdaftar di magang lain.");
            }
        }

        $oldAnggotaData = $currentAnggota->map(fn($p) => [
            'nim' => $p->mahasiswa->nim,
            'nama' => $p->mahasiswa->nama,
        ])->values()->toArray();

        EditRequest::create([
            'mahasiswa_id' => $mahasiswa->id,
            'user_id' => $user->id,
            'target_type' => 'magang',
            'target_id' => $magang->id,
            'field' => 'anggota_kelompok',
            'old_value' => json_encode($oldAnggotaNims),
            'new_value' => json_encode($newAnggotaNims),
            'alasan' => $alasan,
            'status' => 'pending',
            'metadata' => json_encode([
                'old_anggota' => $oldAnggotaData,
                'new_nims' => $nimAnggota,
            ]),
        ]);

        return ServiceResult::ok('Permintaan perubahan anggota kelompok berhasil dikirim. Silakan tunggu konfirmasi dari Operator.');
    }

    # fungsi untuk menyetujui permintaan edit data
    public function approve(EditRequest $editRequest, User $operator, ?string $catatan = null): ServiceResult
    {
        if ($editRequest->status !== 'pending') {
            return ServiceResult::error('Permintaan ini sudah diproses sebelumnya.');
        }

        $field = $editRequest->field;

        if ($field === 'anggota_kelompok') {
            return $this->approveAnggotaKelompok($editRequest, $operator, $catatan);
        }

        if ($editRequest->target_type === 'magang') {
            $magang = Magang::find($editRequest->target_id);
            if (!$magang) {
                return ServiceResult::error('Data magang tidak ditemukan.');
            }

            $allowedMagangFields = ['perusahaan', 'alamat', 'periode_magang', 'konsentrasi'];
            if (!in_array($field, $allowedMagangFields)) {
                return ServiceResult::error('Field magang tidak valid untuk diubah.');
            }

            if ($field === 'periode_magang') {
                $dates = explode('|', $editRequest->new_value);
                $magang->update([
                    'tanggal_mulai' => $dates[0] ?? null,
                    'tanggal_selesai' => $dates[1] ?? null,
                ]);
            } else {
                $magang->update([$field => $editRequest->new_value]);
            }
        } else {
            $mahasiswa = $editRequest->mahasiswa;
            if (!$mahasiswa) {
                return ServiceResult::error('Data mahasiswa tidak ditemukan.');
            }

            $allowedMhsFields = ['nama'];
            if (!in_array($field, $allowedMhsFields)) {
                return ServiceResult::error('Field mahasiswa tidak valid untuk diubah.');
            }

            $mahasiswa->update([$field => $editRequest->new_value]);
        }

        $label = $this->getFieldLabel($field);
        $nama = $editRequest->mahasiswa->nama ?? '-';

        $editRequest->update([
            'status' => 'approved',
            'catatan_operator' => $catatan,
            'processed_by' => $operator->id,
            'processed_at' => now(),
        ]);

        return ServiceResult::ok("Data {$label} mahasiswa {$nama} berhasil diperbarui.");
    }

    # fungsi untuk menyetujui perubahan anggota kelompok
    private function approveAnggotaKelompok(EditRequest $editRequest, User $operator, ?string $catatan = null): ServiceResult
    {
        $magang = Magang::find($editRequest->target_id);
        if (!$magang) {
            return ServiceResult::error('Data magang tidak ditemukan.');
        }

        $metadata = json_decode($editRequest->metadata, true);
        $newNims = $metadata['new_nims'] ?? [];

        $existingAnggota = $magang->peserta->filter(fn($p) => !$p->is_ketua);
        foreach ($existingAnggota as $p) {
            $p->delete();
        }

        foreach ($newNims as $nim) {
            $mhs = Mahasiswa::where('nim', $nim)->first();
            if ($mhs) {
                PesertaMagang::create([
                    'mahasiswa_id' => $mhs->id,
                    'magang_id' => $magang->id,
                    'is_ketua' => false,
                ]);
            }
        }

        $editRequest->update([
            'status' => 'approved',
            'catatan_operator' => $catatan,
            'processed_by' => $operator->id,
            'processed_at' => now(),
        ]);

        $nama = $editRequest->mahasiswa->nama ?? '-';
        return ServiceResult::ok("Anggota kelompok magang {$nama} berhasil diperbarui.");
    }

    # fungsi untuk menolak permintaan edit data
    public function reject(EditRequest $editRequest, User $operator, ?string $catatan = null): ServiceResult
    {
        if ($editRequest->status !== 'pending') {
            return ServiceResult::error('Permintaan ini sudah diproses sebelumnya.');
        }

        $editRequest->update([
            'status' => 'rejected',
            'catatan_operator' => $catatan,
            'processed_by' => $operator->id,
            'processed_at' => now(),
        ]);

        return ServiceResult::ok('Permintaan edit data berhasil ditolak.');
    }

    # fungsi untuk mengambil jumlah permintaan edit yang pending
    public function getPendingCount(): int
    {
        return EditRequest::where('status', 'pending')->count();
    }

    # fungsi untuk mengambil label dari nama field
    public static function getFieldLabel(string $field): string
    {
        return match($field) {
            'nama' => 'Nama Lengkap',
            'konsentrasi' => 'Konsentrasi',
            'perusahaan' => 'Nama Perusahaan',
            'alamat' => 'Alamat Perusahaan',
            'periode_magang' => 'Periode Magang',
            'anggota_kelompok' => 'Anggota Kelompok',
            default => $field,
        };
    }
}
