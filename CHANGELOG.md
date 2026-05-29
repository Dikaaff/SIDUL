# CHANGELOG SIDUL

Dokumentasi seluruh perubahan yang dilakukan pada proyek Sistem Informasi Dual Learning (SIDUL).

---

## [1.4.0] — Blackbox Testing Komprehensif

### 1. Fix — Mass Assignment Magang

**Masalah:** Kolom `$fillable` model `Magang` tidak sesuai dengan kolom aktual di database. Controller menggunakan `alamat`, `tanggal_mulai`, `tanggal_selesai`, `dosen_pembimbing_id`, `tipe_magang`, `konsentrasi` tapi model hanya memiliki `alamat_perusahaan`, `tgl_mulai`, `tgl_selesai`, `dosen_id`.

**Perubahan:**
- `app/Models/Magang.php` — `$fillable` diperbarui:
  ```
  Sebelum: ['kode_magang','status_magang','perusahaan','alamat_perusahaan','tgl_mulai','tgl_selesai','dosen_id']
  Sesudah: ['kode_magang','status_magang','perusahaan','alamat','tanggal_mulai','tanggal_selesai','dosen_pembimbing_id','tipe_magang','konsentrasi']
  ```

### 2. Testing — 86 Blackbox Test (35 → 86)

**Sebelum:** 35 test, 56 assertions — hanya covers halaman statis & akses role.
**Sesudah:** 86 test, 201 assertions — mencakup seluruh alur bisnis blackbox dari login sampai selesai.

#### Hasil Pengujian dari Login sampai Selesai

```
PHPUnit 11.5.55
OK (86 tests, 201 assertions)
Time: 00:04.094
```

| Modul | Skenario | Status |
|-------|----------|--------|
| **🔐 Auth** | Login admin, dosen, operator, mahasiswa | ✅ |
| | Login gagal — password salah | ✅ |
| | Login gagal — user tidak ada | ✅ |
| | Logout | ✅ |
| | User sudah login tidak bisa akses halaman login | ✅ |
| | Guest diblokir dari halaman terproteksi | ✅ |
| | Role middleware memblokir role salah | ✅ |
| | **Total: 11 test** | |
| **👨‍🎓 Mahasiswa** | Dashboard & role blocking (dosen, operator, admin) | ✅ |
| | Halaman pendaftaran — butuh status Approve | ✅ |
| | Halaman pendaftaran — load saat Approve | ✅ |
| | **Store pendaftaran individu — sukses** | ✅ |
| | **Store pendaftaran kelompok — sukses dengan 1 anggota** | ✅ |
| | **Store pendaftaran kelompok — sukses dengan 2 anggota (max boundary)** | ✅ |
| | **Store pendaftaran kelompok — 0 anggota gagal (min boundary)** | ✅ |
| | **Store pendaftaran kelompok — 3 anggota gagal (exceed max)** | ✅ |
| | **Store pendaftaran gagal — status masih Pending** | ✅ |
| | **Store pendaftaran gagal — periode ditutup** | ✅ |
| | **Store pendaftaran gagal — sudah terdaftar** | ✅ |
| | **Store pendaftaran kelompok — NIM anggota tidak terdaftar (validasi)** | ✅ |
| | **Store pendaftaran kelompok — anggota belum approve (business rule)** | ✅ |
| | **Store pendaftaran — validasi tanggal selesai > mulai** | ✅ |
| | Halaman logbook & laporan — butuh magang aktif | ✅ |
| | **Store logbook — sukses** | ✅ |
| | **Store logbook gagal — tanpa magang aktif** | ✅ |
| | **Store logbook gagal — periode ditutup** | ✅ |
| | **Store logbook — validasi kegiatan required** | ✅ |
| | **Store laporan — sukses** | ✅ |
| | **Store laporan gagal — periode ditutup** | ✅ |
| | **Store laporan — update draft yang sudah ada** | ✅ |
| | **Store laporan gagal — status sudah approved** | ✅ |
| | **Store laporan — validasi magang_id required** | ✅ |
| | **Store laporan — validasi judul required** | ✅ |
| | Halaman surat pengantar — tanpa & dengan magang | ✅ |
| | **Cetak PDF logbook — tanpa data & dengan data** | ✅ |
| | **Cetak PDF laporan — tanpa data & dengan data** | ✅ |
| | **Complete state flow: Pending → Approve → Daftar → Aktif → Logbook → Laporan → Selesai** | ✅ |
| | **Total: 34 test** | |
| **👨‍🏫 Dosen** | Dashboard, monitoring, rekomendasi page | ✅ |
| | Role blocking (admin, mahasiswa) | ✅ |
| | **Approve rekomendasi mahasiswa** | ✅ |
| | **Reject rekomendasi mahasiswa** | ✅ |
| | **Rekomendasi — update status Pending → Approve → Rejected** | ✅ |
| | **Approve laporan — status = Selesai** | ✅ |
| | **Request revisi laporan** | ✅ |
| | **Approve laporan — validasi status required** | ✅ |
| | **Approve laporan — validasi status harus approved/revisi** | ✅ |
| | **Approve laporan — validasi feedback required** | ✅ |
| | Halaman logbook bimbingan & laporan bimbingan | ✅ |
| | **Total: 16 test** | |
| **👷 Operator** | Dashboard, monitoring, dosen-pembimbing page | ✅ |
| | Role blocking (admin, mahasiswa) | ✅ |
| | **Toggle periode — buka → tutup** | ✅ |
| | **Toggle periode — tutup → buka** | ✅ |
| | **Toggle periode — multi toggles (3x)** | ✅ |
| | **Assign dosen pembimbing — status jadi Aktif** | ✅ |
| | **Assign dosen — kode SIDUL-YEAR-NNN ter-generate** | ✅ |
| | **Assign dosen — kode increment berurutan** | ✅ |
| | **Assign dosen — validasi dosen_id required** | ✅ |
| | **Assign dosen — validasi dosen_id harus exist** | ✅ |
| | **Monitoring search by perusahaan & nim** | ✅ |
| | **Monitoring filter by status (Pending/Aktif)** | ✅ |
| | **Monitoring search no results** | ✅ |
| | **Delete magang** | ✅ |
| | Halaman laporan | ✅ |
| | **Total: 19 test** | |
| **🛡️ Admin** | Dashboard, users page | ✅ |
| | Create dosen & operator account | ✅ |
| | Delete user | ✅ |
| | Role blocking (mahasiswa) | ✅ |
| | **Total: 6 test** | |

**Cara menjalankan:**
```bash
npm run build
php vendor/bin/phpunit
```

---

## [1.3.0] — Lock Laporan Setelah Disetujui Dosen

### 1. Backend — Validasi Edit Laporan
- **`app/Services/MahasiswaService.php`** — method `simpanLaporan()`: tambah pengecekan status laporan; jika status `approved`, penyimpanan ditolak dengan pesan error "Laporan sudah disetujui dosen dan tidak dapat diedit lagi."

### 2. Frontend — Notifikasi & Proteksi Form
- **`resources/views/mahasiswa/laporan.blade.php`**:
  - Tambah banner hijau "Laporan Disetujui ✓" dengan ikon gembok saat status `approved`
  - Form `action` diubah ke `#` saat approved, `onsubmit="return false"` untuk cegah submit via JS/Enter
  - Textarea judul, tombol submit, dan CKEditor sudah dalam mode read-only (sejak v1.0)

### 3. Bugfix — Status Laporan Operator Selalu "Review"
- **`resources/views/operator/laporan.blade.php`**:
  - **Salah nama kolom:** `$magang->laporan->status_laporan` diubah jadi `$magang->laporan->status` (kolom aslinya `status`, bukan `status_laporan`)
  - **Salah case:** Perbandingan `'Approve'` (kelebihan 'd') dan `'Revisi'` (capital) diubah ke `'approved'` dan `'revisi'` sesuai ENUM database (lowercase)

### 4. Cleanup — Hapus `catatan_operator` dari Model
- **`app/Models/Magang.php`** — `catatan_operator` dihapus dari `$fillable` karena sudah tidak ada method/controller yang memakainya

---

## [1.2.0] — Service Layer & Testing

### 1. Service Layer — Ekstraksi Logic Bisnis

**Masalah:** Controller terlalu gemuk (`MahasiswaController` 305 baris) dengan logic bisnis campur aduk dan duplikasi kode (cek periode diulang 7x, guard pattern diulang 10x).

**Perubahan — File baru:**
- `app/Services/ServiceResult.php` — DTO untuk hasil operasi service (success + message + data)
- `app/Services/PeriodeService.php` — Cek periode buka/tutup (menghilangkan 7x duplikasi `Setting::get`)
- `app/Services/MahasiswaService.php` — Pendaftaran, logbook, laporan, validasi kelompok
- `app/Services/DosenService.php` — Rekomendasi, approve laporan, query bimbingan
- `app/Services/OperatorService.php` — Dashboard stats, assign dosen, monitoring, filter

**Perubahan — Controller direfactor:**
- `app/Http/Controllers/MahasiswaController.php` — 305 → 173 baris (tipis 43%)
- `app/Http/Controllers/DosenController.php` — 116 → 67 baris (tipis 42%)
- `app/Http/Controllers/OperatorController.php` — 227 → 73 baris (tipis 68%)

### 2. Testing — 35 Unit Test

**Sebelum:** Tidak ada satu pun test.
**Sesudah:** 35 test dengan 56 assertions, mencakup:

| File | Test | Assertions |
|------|------|-----------|
| `tests/Feature/AuthTest.php` | Login 4 role, wrong password, logout, middleware block | 11 |
| `tests/Feature/MahasiswaTest.php` | Dashboard, role blocking, pendaftaran, logbook, laporan | 8 |
| `tests/Feature/DosenTest.php` | Dashboard, monitoring, rekomendasi, role blocking | 5 |
| `tests/Feature/OperatorTest.php` | Dashboard, monitoring, dosen-pembimbing, role blocking | 5 |
| `tests/Feature/AdminTest.php` | Dashboard, users page, create/delete user, role blocking | 6 |

**Cara menjalankan:**
```bash
php artisan test
# atau dengan coverage:
php artisan test --coverage
```

---

## [1.1.0] — Refactoring & Security

### 1. Role Middleware Diaktifkan

**Masalah:** Middleware `RoleMiddleware.php` sudah ada tapi tidak didaftarkan, sehingga user role mana pun bisa mengakses halaman role mana pun (security issue).

**Perubahan:**
- `bootstrap/app.php` — Mendaftarkan middleware alias `'role'`:
  ```php
  $middleware->alias([
      'role' => \App\Http\Middleware\RoleMiddleware::class,
  ]);
  ```
- `routes/web.php` — Setiap grup route sekarang dilindungi middleware `role:{role}`:
  - `role:mahasiswa` untuk route mahasiswa
  - `role:dosen` untuk route dosen
  - `role:operator` untuk route operator
  - `role:admin` untuk route admin
- `app/Http/Middleware/RoleMiddleware.php` — Menambahkan `admin` ke match redirect, memperbaiki default route menjadi `mahasiswa.dashboard`

### 2. Standarisasi Route Names

**Masalah:** Nama route tidak konsisten. `mahasiswa.home` vs `dosen.dashboard` vs `operator.dashboard` vs `admin.dashboard`.

**Perubahan:**
- `routes/web.php` — `mahasiswa.home` → `mahasiswa.dashboard`
- `app/Http/Controllers/MahasiswaController.php` — Semua 11 referensi `route('mahasiswa.home')` → `route('mahasiswa.dashboard')`

### 3. Perbaikan AuthController

**Masalah:** `redirectBasedOnRole()` menggunakan hardcoded path (`/dashboard/admin`, dll). Jika URL berubah, perlu diubah manual.

**Perubahan:**
- `app/Http/Controllers/AuthController.php` — Sekarang menggunakan `route('admin.dashboard')` (named route) agar otomatis mengikuti perubahan URL.

### 4. Fix Mass Assignment Bug

**Masalah:** `OperatorController::verifikasiTolak()` mengupdate kolom `catatan_operator` yang tidak ada di `$fillable` model Magang, menyebabkan mass assignment exception.

**Perubahan:**
- `app/Models/Magang.php` — Menambahkan `'catatan_operator'` ke array `$fillable`.

### 5. Sidebar Logout Form

**Perubahan:**
- `resources/views/components/sidebar.blade.php` — Form action dari hardcoded `/logout` → `{{ route('logout') }}`

---

## [1.0.1] — Responsive Improvements

### 6. Login Page — Min-height

**Masalah:** `min-h-[650px]` memaksa container setinggi 650px di semua ukuran layar, terlalu besar di HP.

**File:** `resources/views/auth/login.blade.php:6`
**Sebelum:** `min-h-[650px]`
**Sesudah:** `min-h-[500px] md:min-h-[650px]`

### 7. Login Page — Padding Berlebihan

**Masalah:** `p-16` memberikan padding 4rem di semua ukuran layar, boros space di mobile.

**File:** `resources/views/auth/login.blade.php:9`
**Sebelum:** `p-16`
**Sesudah:** `p-8 lg:p-16`

### 8. Toast Notification — Overflow

**Masalah:** `min-w-[340px]` menyebabkan notifikasi overflow di layar < 340px (iPhone SE, dll).

**File:** `resources/views/layouts/app.blade.php:124,137`
**Sebelum:** `min-w-[340px]`
**Sesudah:** `min-w-[340px] max-w-[calc(100vw-2rem)]`

### 9. Sidebar Overlay — Class Redundan

**Masalah:** `hidden lg:hidden` — `lg:hidden` tidak berefek karena `hidden` sudah menyembunyikan elemen.

**File:** `resources/views/layouts/app.blade.php:47`
**Sebelum:** `class="fixed ... hidden lg:hidden ..."`
**Sesudah:** `class="fixed ... hidden ..."`

### 10. Modal Detail Dosen — Grid Responsive

**Masalah:** `grid-cols-2` di modal detail dosen terlalu sempit di HP.

**File:** `resources/views/dosen/dashboard.blade.php:195`
**Sebelum:** `grid-cols-2`
**Sesudah:** `grid-cols-1 md:grid-cols-2`

### 11. Route Imports — Konsistensi

**Masalah:** Campuran `use` imports di atas file dan inline `[App\Http\Controllers\...]`.

**Perubahan:**
- `routes/web.php` — Semua controller menggunakan `use` imports (MahasiswaController, DosenController, OperatorController, AdminController).

---

## Cara Menjalankan

```bash
# Bersihkan cache setelah perubahan
php artisan view:clear
php artisan route:clear

# Reset database jika perlu
php artisan migrate:fresh --seed

# Jalankan server
php artisan serve
```

