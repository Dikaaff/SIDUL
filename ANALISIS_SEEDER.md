# Analisis Perbaikan Seeder, Database, dan Model

## 1. Database — Migration

| Temuan | Saran | Prioritas |
|--------|-------|-----------|
| `magangs.konsentrasi` pakai `string()->nullable()` — tidak ada constraint | Ubah ke `enum('Web Development','Networking','2D Animation')` atau buat table `konsentrasis` | Sedang |
| `status_magang` di UI ada opsi `'Ditolak'` tapi tidak ada di enum DB | Tambah `'Ditolak'` ke enum migration | Rendah (tapi UI sudah pakai) |
| `'berjalan'` & `'Approve'` di `MahasiswaService::isMagangAktif()` line 103 — tidak valid | Hapus `'berjalan'`, ganti `'Approve'` → `'Aktif'` | Tinggi (bug) |

## 2. Seeder

| Item | Before | After |
|------|--------|-------|
| `konsentrasi` di MagangSeeder | `Teknologi Web`, `Multimedia`, `Sistem Informasi`, `Data Science`, `Cyber Security` | `Web Development`, `2D Animation`, `Networking` (×2, ×2, ×1) |
| `konsentrasi` di MagangFactory | 6 opsi (tidak ada yang cocok frontend) | 3 opsi: `Web Development`, `Networking`, `2D Animation` |
| `status_magang` default factory | `'Aktif'` | `'Pending'` (sesuai DB default) |

## 3. Model — `$fillable`

| Model | Fillable Saat Ini | Analisis | Saran |
|-------|-------------------|----------|-------|
| **User** | `['username','password','role']` | Tidak ada form edit user, tapi OK untuk factory/seed | Pertahankan |
| **Dosen** | `['user_id','nik','nama']` | Tidak ada form edit dosen, murni untuk seed | Pertahankan |
| **Mahasiswa** | `['user_id','nim','nama','status_daftar','dosen_wali_id']` | Hanya `nama` yang bisa diedit via edit request. Sisanya diisi sistem | Bisa dipersempit ke `['nama']` jika ingin strict mass-assignment protection |
| **Magang** | `['kode_magang','status_magang','perusahaan','alamat','tanggal_mulai','tanggal_selesai','dosen_pembimbing_id','tipe_magang','konsentrasi']` | Bisa diinput user: `tipe_magang`, `perusahaan`, `alamat`, `tanggal_mulai`, `tanggal_selesai`, `konsentrasi`. Sisanya diisi sistem | Bisa dipersempit |
| **PesertaMagang** | `['mahasiswa_id','magang_id','is_ketua']` | Semua diisi sistem | Bisa dihapus semua (guard all) |
| **Laporan** | `['magang_id','judul','bab1','bab2','bab3','bab4','status','catatan_dosen']` | Bisa diinput: `judul`, `bab1-4`. Sisanya diisi sistem | Bisa dipersempit |
| **Logbook** | `['magang_id','tanggal','kegiatan']` | Bisa diinput: `kegiatan`. Sisanya diisi sistem | Bisa dipersempit ke `['kegiatan']` |

## 4. Anomali Bisnis Logic (Bug)

**File:** `app/Services/MahasiswaService.php:103`

```php
$statusAktif = ['Aktif', 'berjalan', 'Approve', 'Selesai'];
```

| Nilai | Status | Keterangan |
|-------|--------|------------|
| `'Aktif'` | ✅ Valid | Ada di enum DB `status_magang` |
| `'berjalan'` | ❌ Invalid | Typo / tidak ada di DB manapun |
| `'Approve'` | ❌ Invalid | Ini format `status_daftar`, bukan `status_magang`. Seharusnya `'Aktif'` |
| `'Selesai'` | ✅ Valid | Ada di enum DB `status_magang` |

**Dampak:** Magang dengan `status_magang = 'Aktif'` tetap lolos karena `'Aktif'` ada di array, tapi bisa menyebabkan bug jika validasi diperketat di masa depan.

## Prioritas Perbaikan

| Prioritas | Item |
|-----------|------|
| 🔴 **Segera** | Perbaiki `MahasiswaService::isMagangAktif()` (bug `'berjalan'` & `'Approve'`) |
| 🟡 **Seeder** | ✅ Sudah selesai diperbaiki |
| 🟢 **Model `$fillable`** | Bisa dibahas lebih lanjut |
