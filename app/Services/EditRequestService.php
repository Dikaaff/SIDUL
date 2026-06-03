<?php

namespace App\Services;

use App\Models\EditRequest;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\PesertaMagang;
use App\Models\User;

class EditRequestService
{
    public function getEditableFields(bool $hasMagang = false, ?Magang $magang = null): array
    {
        $fields = [
            'nama' => 'Nama Lengkap',
            'konsentrasi' => 'Konsentrasi',
        ];

        if ($hasMagang && $magang) {
            $fields['perusahaan'] = 'Nama Perusahaan';
            $fields['alamat'] = 'Alamat Perusahaan';
            $fields['tanggal_mulai'] = 'Tanggal Mulai';
            $fields['tanggal_selesai'] = 'Tanggal Selesai';

            if ($magang->tipe_magang === 'kelompok') {
                $fields['anggota_kelompok'] = 'Anggota Kelompok';
            }
        }

        return $fields;
    }

    public static function getFieldTarget(string $field): string
    {
        return match($field) {
            'nama', 'konsentrasi' => 'mahasiswa',
            'perusahaan', 'alamat', 'tanggal_mulai', 'tanggal_selesai', 'anggota_kelompok' => 'magang',
            default => 'mahasiswa',
        };
    }

    public function getCurrentValues(Mahasiswa $mahasiswa, ?Magang $magang = null): array
    {
        $values = [
            'nama' => $mahasiswa->nama,
            'konsentrasi' => $mahasiswa->konsentrasi,
        ];

        if ($magang) {
            $values['perusahaan'] = $magang->perusahaan;
            $values['alamat'] = $magang->alamat;
            $values['tanggal_mulai'] = $magang->tanggal_mulai?->format('Y-m-d') ?? '';
            $values['tanggal_selesai'] = $magang->tanggal_selesai?->format('Y-m-d') ?? '';

            $anggota = $magang->peserta->filter(fn($p) => !$p->is_ketua);
            $values['anggota_kelompok'] = $anggota->map(fn($p) => $p->mahasiswa->nim . ' - ' . $p->mahasiswa->nama)->implode(', ') ?: '-';
        }

        return $values;
    }

    public function hasPendingRequest(Mahasiswa $mahasiswa): bool
    {
        return EditRequest::where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'pending')
            ->exists();
    }

    public function getPendingRequestsForOperator()
    {
        return EditRequest::with(['mahasiswa.user', 'user', 'mahasiswa.pesertaMagang.magang'])
            ->where('status', 'pending')
            ->latest()
            ->get();
    }

    public function getHistoryForMahasiswa(Mahasiswa $mahasiswa)
    {
        return EditRequest::where('mahasiswa_id', $mahasiswa->id)
            ->with('processor')
            ->latest()
            ->get();
    }

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
            return $this->ajukanAnggotaKelompok($mahasiswa, $user, $magang, $data);
        }

        $newValue = trim($data['new_value']);
        $alasan = trim($data['alasan']);
        $currentValues = $this->getCurrentValues($mahasiswa, $magang);
        $oldValue = $currentValues[$field] ?? '';

        if ($oldValue === $newValue) {
            return ServiceResult::error('Nilai baru sama dengan nilai saat ini. Tidak ada perubahan.');
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
            \Log::info("ajukanAnggotaKelompok: {$nim} status_magang = {$mhs->status_magang}");
            if ($mhs->status_magang !== 'Approve') {
                \Log::warning("ajukanAnggotaKelompok: {$nim} NOT approved (status={$mhs->status_magang})");
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

            $allowedMagangFields = ['perusahaan', 'alamat', 'tanggal_mulai', 'tanggal_selesai'];
            if (!in_array($field, $allowedMagangFields)) {
                return ServiceResult::error('Field magang tidak valid untuk diubah.');
            }

            $updateData = [$field => $editRequest->new_value];
            if (in_array($field, ['tanggal_mulai', 'tanggal_selesai'])) {
                $updateData[$field] = $editRequest->new_value;
            }

            $magang->update($updateData);
        } else {
            $mahasiswa = $editRequest->mahasiswa;
            if (!$mahasiswa) {
                return ServiceResult::error('Data mahasiswa tidak ditemukan.');
            }

            $allowedMhsFields = ['nama', 'konsentrasi'];
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

    public function getPendingCount(): int
    {
        return EditRequest::where('status', 'pending')->count();
    }

    public static function getFieldLabel(string $field): string
    {
        return match($field) {
            'nama' => 'Nama Lengkap',
            'konsentrasi' => 'Konsentrasi',
            'perusahaan' => 'Nama Perusahaan',
            'alamat' => 'Alamat Perusahaan',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_selesai' => 'Tanggal Selesai',
            'anggota_kelompok' => 'Anggota Kelompok',
            default => $field,
        };
    }
}
