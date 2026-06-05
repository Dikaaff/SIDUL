# CHANGELOG - SIDUL (Sistem Informasi Management Magang)

## Database Structure & Relasi

### 1. Tabel `users`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| name | string | Nama lengkap |
| username | string (unique) | Username untuk login |
| password | string | Hash password |
| role | enum('mahasiswa','dosen','operator','admin') | Role user |
| remember_token | string, nullable | Token remember me |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relasi:**
- `hasOne(Mahasiswa)` → `mahasiswas.user_id`
- `hasOne(Dosen)` → `dosens.user_id`

---

### 2. Tabel `mahasiswas`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| user_id | bigint (FK) | → `users.id` (cascade) |
| nim | string (unique) | NIM mahasiswa |
| nama | string | Nama lengkap |
| konsentrasi | string | Konsentrasi (ex: prodi) |
| status_magang | enum('Pending','Approve','Rejected') | Status rekomendasi dosen wali |
| dosen_wali_id | bigint (FK, nullable) | → `dosens.id` (set null) |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relasi:**
- `belongsTo(User)` → `users.id`
- `belongsTo(Dosen)` sebagai wali → `dosens.id` (dosen_wali_id)
- `hasOne(PesertaMagang)` → `peserta_magangs.mahasiswa_id`

---

### 3. Tabel `dosens`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| user_id | bigint (FK) | → `users.id` (cascade) |
| nik | string (unique) | NIK dosen |
| nama | string | Nama lengkap |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relasi:**
- `belongsTo(User)` → `users.id`
- `hasMany(Mahasiswa)` sebagai wali → `mahasiswas.dosen_wali_id`
- `hasMany(Magang)` sebagai pembimbing → `magangs.dosen_pembimbing_id`

---

### 4. Tabel `magangs`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| kode_magang | string (unique) | Kode unik magang (MGN-xxx) |
| tipe_magang | enum('individu','kelompok') | Tipe magang |
| konsentrasi | string, nullable | Konsentrasi magang |
| perusahaan | string, nullable | Nama perusahaan |
| alamat | text, nullable | Alamat perusahaan |
| tanggal_mulai | date, nullable | Tanggal mulai magang |
| tanggal_selesai | date, nullable | Tanggal selesai magang |
| dosen_pembimbing_id | bigint (FK, nullable) | → `dosens.id` (set null) |
| status_magang | string | Status: Pending, Aktif, Selesai, Ditolak |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relasi:**
- `belongsTo(Dosen)` sebagai pembimbing → `dosens.id`
- `hasMany(PesertaMagang)` → `peserta_magangs.magang_id`
- `hasMany(Logbook)` → `logbooks.magang_id`
- `hasOne(Laporan)` → `laporans.magang_id`

---

### 5. Tabel `peserta_magangs`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| magang_id | bigint (FK) | → `magangs.id` (cascade) |
| mahasiswa_id | bigint (FK) | → `mahasiswas.id` (cascade) |
| is_ketua | boolean | Apakah ketua kelompok |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relasi:**
- `belongsTo(Magang)` → `magangs.id`
- `belongsTo(Mahasiswa)` → `mahasiswas.id`

---

### 6. Tabel `logbooks`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| magang_id | bigint (FK) | → `magangs.id` (cascade) |
| tanggal | date | Tanggal kegiatan |
| kegiatan | text | Deskripsi kegiatan |
| catatan_dosen | text, nullable | Catatan dari dosen pembimbing |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relasi:**
- `belongsTo(Magang)` → `magangs.id`

---

### 7. Tabel `laporans`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| magang_id | bigint (FK) | → `magangs.id` (cascade) |
| judul | string | Judul laporan |
| bab1 | longtext, nullable | Isi bab 1 |
| bab2 | longtext, nullable | Isi bab 2 |
| bab3 | longtext, nullable | Isi bab 3 |
| bab4 | longtext, nullable | Isi bab 4 |
| status | enum('review','revisi','approved') | Status laporan |
| catatan_dosen | text, nullable | Catatan dosen |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relasi:**
- `belongsTo(Magang)` → `magangs.id`
- `hasMany(KomentarLaporan)` → `komentar_laporans.laporan_id`
- `hasMany(RevisiLaporan)` → `revisi_laporans.laporan_id`

---

### 8. Tabel `komentar_laporans`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| laporan_id | bigint (FK) | → `laporans.id` (cascade) |
| user_id | bigint (FK) | → `users.id` (cascade) |
| bab_ke | integer, nullable | BAB yang dikomentari |
| komentar | text | Isi komentar |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relasi:**
- `belongsTo(Laporan)` → `laporans.id`
- `belongsTo(User)` → `users.id`

---

### 9. Tabel `revisi_laporans`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| laporan_id | bigint (FK) | → `laporans.id` (cascade) |
| bab_yang_diubah | integer, nullable | BAB yang direvisi |
| konten_lama | longtext | Isi sebelum direvisi |
| konten_baru | longtext | Isi setelah direvisi |
| updated_by | bigint (FK) | → `users.id` (cascade) |
| created_at | timestamp | (useCurrent) |

⚠️ **Tidak memiliki `updated_at`** — hanya created_at dengan `useCurrent()`

**Relasi:**
- `belongsTo(Laporan)` → `laporans.id`
- `belongsTo(User)` → `users.id` (updated_by)

---

### 10. Tabel `edit_requests`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| mahasiswa_id | bigint (FK) | → `mahasiswas.id` (cascade) |
| user_id | bigint (FK) | → `users.id` (cascade) |
| field | string | Field yang diubah |
| target_type | string | Target: 'mahasiswa' atau 'magang' |
| target_id | bigint, nullable | ID dari target |
| old_value | string, nullable | Nilai lama |
| new_value | string | Nilai baru |
| alasan | text | Alasan pengajuan |
| status | enum('pending','approved','rejected') | Status permintaan |
| catatan_operator | text, nullable | Catatan dari operator |
| metadata | json, nullable | Data tambahan (untuk anggota kelompok) |
| processed_by | bigint (FK, nullable) | → `users.id` (set null) |
| processed_at | timestamp, nullable | Waktu diproses |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relasi:**
- `belongsTo(Mahasiswa)` → `mahasiswas.id`
- `belongsTo(User)` → `users.id` (pengaju)
- `belongsTo(User)` sebagai processor → `users.id` (processed_by)

---

### 11. Tabel `settings`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| key | string (unique) | Key setting |
| value | text, nullable | Value setting |
| created_at | timestamp | |
| updated_at | timestamp | |

**Default seed:**
- `is_periode_open` = `1`

---

### 12. Tabel `operators`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint (PK) | Auto increment |
| user_id | bigint (FK) | → `users.id` |
| staff_id | string | ID staf |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relasi:**
- `belongsTo(User)` → `users.id`

---

## Diagram Relasi (Summary)

```
users (1) ── (1) mahasiswas
users (1) ── (1) dosens
users (1) ── (1) operators

dosens (1) ── (N) mahasiswas   [dosen_wali_id]
dosens (1) ── (N) magangs      [dosen_pembimbing_id]

magangs (1) ── (N) peserta_magangs
magangs (1) ── (N) logbooks
magangs (1) ── (1) laporans

mahasiswas (1) ── (1) peserta_magangs
peserta_magangs (N) ── (1) mahasiswas

laporans (1) ── (N) komentar_laporans
laporans (1) ── (N) revisi_laporans

mahasiswas (1) ── (N) edit_requests
users (1) ── (N) edit_requests      [pengaju]
users (1) ── (N) edit_requests      [processor]

komentar_laporans (N) ── (1) users
revisi_laporans   (N) ── (1) users
```

## Alur Status

### Status Mahasiswa (`mahasiswas.status_magang`)
```
Pending → Approve  (dosen wali menyetujui)
Pending → Rejected (dosen wali menolak)
```

### Status Magang (`magangs.status_magang`)
```
Pending → Aktif → Selesai
Pending → Ditolak
```

### Status Laporan (`laporans.status`)
```
review → revisi → review  (revisi berulang)
review → approved         (lulus)
```

### Status Edit Request (`edit_requests.status`)
```
pending → approved (operator setuju)
pending → rejected (operator tolak)
```
