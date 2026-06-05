# Backend & Database Planning — SIDUL

> Disusun oleh Developer — perspektif engineering excellence (Harvard CS / Google SWE).

---

## A. Backend Logic (Lapisan Logika Bisnis)

### 1. Routing Architecture

| # | Route Group | Middleware | Controller | Endpoints |
|---|------------|-----------|------------|-----------|
| 1.1 | Guest (Public) | guest | AuthController | GET /login, POST /login |
| 1.2 | Auth (Logged In) | auth | AuthController | POST /logout, GET /dashboard |
| 1.3 | Mahasiswa | auth + role:mahasiswa | MahasiswaController | dashboard, pendaftaran, surat-pengantar, logbook, laporan, edit-data |
| 1.4 | Dosen | auth + role:dosen | DosenController | dashboard, monitoring, logbook, laporan, rekomendasi |
| 1.5 | Operator | auth + role:operator | OperatorController | dashboard, periode, dosen-pembimbing, monitoring, laporan, edit-requests |
| 1.6 | Admin | auth + role:admin | AdminController | dashboard, users CRUD |

Total: **6 route groups**, **6 controllers**, **2 middleware layers**.

---

### 2. Controller Layer (Business Logic)

| Controller | Key Methods | Responsibilities |
|-----------|-------------|-----------------|
| **AuthController** | showLogin(), login(), logout() | Session-based auth, credential validation, role-aware redirect |
| **MahasiswaController** | dashboard(), pendaftaran(), storePendaftaran(), suratPengantar(), logbook(), storeLogbook(), cetakLogbook(), laporan(), storeLaporan(), cetakLaporan(), editData(), storeEditData() | Full mahasiswa lifecycle: daftar -> logbook -> laporan -> edit data |
| **DosenController** | dashboard(), monitoring(), logbook(), laporan(), approveLaporan(), rekomendasi(), rekomendasikan(), tolakRekomendasi() | Bimbingan workflow: review logbook/laporan, approve/reject, rekomendasi |
| **OperatorController** | dashboard(), togglePeriode(), dosenPembimbing(), assignDosen(), destroy(), monitoring(), laporan(), editRequests(), approveEdit(), rejectEdit() | Manajemen operasional: periode, plotting dosen, approval edit request |
| **AdminController** | dashboard(), users(), storeUser(), destroyUser() | Manajemen user: CRUD seluruh akun sistem |

**Design Pattern**: Separation of Concerns — Controller hanya bertugas sebagai entry point dan delegasi ke Service Layer.

---

### 3. Service Layer (Business Logic Parser)

| Service | File | Responsibilities |
|---------|------|-----------------|
| **MahasiswaService** | app/Services/MahasiswaService.php | Validasi pendaftaran, CRUD logbook, simpan/submit laporan |
| **DosenService** | app/Services/DosenService.php | Review & approve laporan, feedback (catatan_dosen) |
| **OperatorService** | app/Services/OperatorService.php | Manajemen periode, plotting dosen |
| **EditRequestService** | app/Services/EditRequestService.php | Ajukan, approve, reject edit data mahasiswa |
| **PeriodeService** | app/Services/PeriodeService.php | Cek status periode magang (open/closed) |
| **ServiceResult** | app/Services/ServiceResult.php | Value object untuk standardisasi response success/error |

**Key Pattern**: Service Layer Pattern — Controller tidak berisi logika bisnis, hanya delegasi.

---

### 4. Middleware Implementation

| Middleware | File | Logic |
|-----------|------|-------|
| **RoleMiddleware** | app/Http/Middleware/RoleMiddleware.php | Redirect user ke dashboard sesuai role jika akses tidak diizinkan |
| **MockAuthMiddleware** | app/Http/Middleware/MockAuthMiddleware.php | Bypass auth untuk development lokal |

**Alur Proteksi**:
`
Request -> auth (session) -> role:mahasiswa/dosen/operator/admin -> Controller
`
Jika role tidak cocok, user langsung di-redirect ke dashboard masing-masing (tidak return 403).

---

## B. Database Structure (Struktur Basis Data)

### 1. Migration Pipeline (Schema Definition)

| # | Migration File | Table | Key Columns |
|---|---------------|-------|-------------|
| 1 | 0001_01_01_000000_create_users_table | users | id, name, username, password, role (enum: mahasiswa/dosen/operator/admin) |
| 2 | 2026_04_09_193710_create_sidul_local_tables | mahasiswas, dosens, operators, magangs, peserta_magangs, logbooks, laporans | Semua tabel inti sistem |
| 3 | 2026_04_26_000000_create_settings | settings | key, value (konfigurasi sistem) |
| 4 | 2026_04_26_150000_create_komentar_laporans | komentar_laporans | **Dihapus** (tidak dipakai) |
| 5 | 2026_04_26_150001_create_revisi_laporans | revisi_laporans | laporan_id, user_id, revisi |
| 6 | 2026_04_26_163729_rename_prodi_to_konsentrasi | mahasiswas | Rename kolom prodi -> konsentrasi |
| 7 | 2026_04_26_164058_add_details_to_magangs | magangs | tipe_magang, konsentrasi, tanggal_mulai, tanggal_selesai |
| 8 | 2026_05_06_150648_update_status_magang | mahasiswas | Update enum status_magang |
| 9 | 2026_06_01_201657_create_edit_requests | edit_requests | mahasiswa_id, field, old_value, new_value, status |
| 10 | 2026_06_01_202513_add_target_type | edit_requests | target_type (discriminator untuk polymorphic edit) |
| 11 | 2026_06_04_104554_add_draft_status | laporans | Tambah 'draft' ke enum status |
| 12 | **2026_06_04_133300_drop_komentar_laporans** | — | Hapus tabel komentar_laporans |
| 13 | **2026_06_04_134425_drop_catatan_dosen_from_logbooks** | logbooks | Hapus kolom catatan_dosen |

**Total**: 13 migration files, 12 tabel aktif.

---

### 2. Entity Relationship Mapping (Eloquent ORM)

| Model | Table | Relationships |
|-------|-------|-------------|
| **User** | users | morphTo role? — single table inheritance via 'role' column |
| **Mahasiswa** | mahasiswas | belongsTo(User), hasMany(Magang via PesertaMagang) |
| **Dosen** | dosens | belongsTo(User), hasMany(Magang as pembimbing) |
| **Operator** | operators | belongsTo(User) |
| **Magang** | magangs | belongsTo(Dosen), belongsToMany(Mahasiswa via PesertaMagang) |
| **PesertaMagang** | peserta_magangs | belongsTo(Magang), belongsTo(Mahasiswa) |
| **Logbook** | logbooks | belongsTo(Magang) |
| **Laporan** | laporans | belongsTo(Magang), hasMany(RevisiLaporan) |
| **RevisiLaporan** | revisi_laporans | belongsTo(Laporan), belongsTo(User) |
| **EditRequest** | edit_requests | belongsTo(Mahasiswa), morphs to target |
| **Setting** | settings | key-value store |
| **Bimbingan** | bimbingans | — (relasi pendukung) |

**Design Decision**: Single-table inheritance untuk User dengan kolom role discriminator, dilengkapi model spesifik (Mahasiswa, Dosen, Operator) untuk atribut khusus.

---

### 3. Key Database Design Decisions

1. **status_magang pada Mahasiswa** — Enum: Pending, Approve, Ditolak. Mengontrol lifecycle pendaftaran.
2. **status pada Laporan** — Enum: draft, review, revisi, approved. Memungkinkan workflow submit-review-revisi.
3. **catatan_dosen pada Laporan** — Feedback langsung dari dosen pembimbing, bukan tabel terpisah.
4. **EditRequest System** — Request perubahan data di-approve operator, bukan edit langsung, untuk audit trail.
5. **Periode System via Settings** — Buka/tutup pendaftaran menggunakan key-value di tabel settings, bukan tabel terpisah.
6. **PesertaMagang pivot** — Many-to-many Mahasiswa ke Magang, mendukung magang kelompok.

---

## C. Data Flow Summary

### Flow Pendaftaran Magang
`
Mahasiswa -> POST /pendaftaran/store -> MahasiswaController::storePendaftaran()
  -> MahasiswaService::daftar()
    -> Validasi periode buka
    -> Validasi NIM / kuota
    -> Create Magang + PesertaMagang
    -> Update status_magang = 'Pending'
`

### Flow Logbook
`
Mahasiswa -> POST /logbook -> MahasiswaController::storeLogbook()
  -> Validasi periode
  -> Simpan kegiatan harian
  -> Logbook tersimpan dengan magang_id
`

### Flow Laporan
`
Mahasiswa -> POST /laporan (action: save/submit) -> MahasiswaController::storeLaporan()
  -> MahasiswaService::simpanLaporan()
    -> Save draft (status = 'draft')
    -> Submit (status = 'review')

Dosen -> POST /laporan/{id}/approve -> DosenController::approveLaporan()
  -> DosenService::reviewLaporan()
    -> Simpan catatan_dosen + ubah status (approved/revisi)
`

### Flow Edit Data
`
Mahasiswa -> POST /edit-data/store -> MahasiswaController::storeEditData()
  -> EditRequestService::ajukan()
    -> Simpan old_value + new_value
    -> Status = 'pending'

Operator -> POST /edit-requests/{id}/approve -> OperatorController::approveEdit()
  -> EditRequestService::approve()
    -> Update kolom target
    -> Status = 'approved'
`

---

## D. Security & Access Control

1. **Authentication**: Session-based (Laravel default), via AuthController
2. **Authorization**: RoleMiddleware memeriksa role user sebelum akses controller
3. **CSRF Protection**: Seluruh POST request dilindungi @csrf
4. **SQL Injection Prevention**: Eloquent ORM — query parameter binding
5. **XSS Prevention**: Blade {{ }} auto-escape, tambahan {!! !!} hanya pada konten trusted

---

*Dokumen ini merepresentasikan hasil rekayasa backend dan perencanaan database sistem SIDUL, ditinjau dari standar Software Engineering industri.*
