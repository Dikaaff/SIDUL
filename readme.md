# SIDUL — Sistem Informasi Diploma Unggul

**SIDUL** adalah platform manajemen magang berbasis web yang dirancang untuk mengelola seluruh siklus magang mahasiswa — mulai dari pendaftaran, rekomendasi dosen wali, plotting dosen pembimbing, pengisian logbook harian, hingga validasi laporan akhir.

Dibangun dengan **Laravel 12**, **Tailwind CSS 4**, dan **DaisyUI 5**, SIDUL menghadirkan antarmuka yang konsisten untuk empat peran: **Mahasiswa**, **Dosen**, **Operator**, dan **Admin**.

---

## Fitur Utama

### Multi-Role Dashboard
Setiap peran memiliki tampilan dan aksi yang berbeda sesuai kebutuhan.
- **Mahasiswa**: Pendaftaran magang, logbook harian, upload laporan akhir, pengajuan edit data.
- **Dosen**: Rekomendasi mahasiswa wali, monitoring progres bimbingan, review & approve laporan.
- **Operator**: Plotting dosen pembimbing, monitoring global, kontrol periode magang, validasi edit request.
- **Admin**: Manajemen akun staf (dosen/operator).

### Siklus Magang End-to-End
1. **Pendaftaran** oleh mahasiswa (individu/kelompok)
2. **Rekomendasi** oleh dosen wali
3. **Plotting** dosen pembimbing oleh operator
4. **Logbook** harian selama magang
5. **Laporan** akhir dan validasi

### Monitoring Real-Time
- Progress logbook & laporan per mahasiswa
- Status magang (Pending / Aktif / Selesai / Ditolak)
- Export data monitoring ke CSV

### Kontrol Periode
Operator dapat membuka atau menutup periode pendaftaran magang secara dinamis melalui dashboard.

---

## Tech Stack

| Lapisan | Teknologi |
|---|---|
| **Framework** | Laravel 12 (PHP ^8.2) |
| **Database** | SQLite / MySQL |
| **Frontend** | Tailwind CSS 4, DaisyUI 5, Vite 7 |
| **Template** | Blade Components + Slot System |
| **PDF** | barryvdh/laravel-dompdf |
| **Word** | phpoffice/phpword |
| **Auth** | Session-based (database driver) |
| **CSS Icons** | Heroicons (inline SVG) |

### Dependensi Frontend (package.json)
- `tailwindcss` ^4.2.1
- `daisyui` ^5.5.19
- `vite` ^7.0.7
- `laravel-vite-plugin` ^2.0.0

### Dependensi Backend (composer.json)
- `laravel/framework` ^12.0
- `barryvdh/laravel-dompdf` ^3.1
- `phpoffice/phpword` ^1.3
- `laravel/sail` ^1.41 (dev)

---

## Struktur Proyek

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── DosenController.php
│   │   ├── MahasiswaController.php
│   │   └── OperatorController.php
│   └── Controllers/
├── Models/
│   ├── User.php
│   ├── Mahasiswa.php
│   ├── Dosen.php
│   ├── Magang.php
│   ├── PesertaMagang.php
│   ├── Logbook.php
│   ├── Laporan.php
│   ├── Setting.php
│   └── EditRequest.php
├── Services/
│   ├── DosenService.php
│   ├── OperatorService.php
│   └── EditRequestService.php
└── Providers/
    └── AppServiceProvider.php

resources/views/
├── admin/                    # Dashboard & Kelola Staf
├── dosen/                    # Dashboard, Monitoring, Logbook, Laporan, Rekomendasi
├── mahasiswa/                # Dashboard, Pendaftaran, Logbook, Laporan, Edit Data
├── operator/                 # Dashboard, Plotting Dosen, Monitoring, Laporan, Edit Requests
├── components/               # Blade Components (button, card, modal, dll.)
├── layouts/                  # app.blade.php & auth.blade.php
└── vendor/pagination/        # Pagination view (sidul custom)

routes/
└── web.php                   # Seluruh route aplikasi

database/
├── seeders/
│   ├── DatabaseSeeder.php
│   └── SidulSeeder.php       # Data uji: user, dosen, mahasiswa, magang, laporan
└── migrations/
```

---

## Panduan Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- Node.js 18+ & npm
- SQLite (default) atau MySQL

### Langkah Instalasi

```bash
# 1. Clone repositori
git clone <repository-url>
cd SIDUL

# 2. Install dependensi PHP
composer install

# 3. Install dependensi frontend
npm install

# 4. Konfigurasi environment
cp .env.example .env
php artisan key:generate

# 5. Konfigurasi database (default SQLite)
# Untuk SQLite: buat file database/database.sqlite
# Untuk MySQL: sesuaikan DB_* di .env, lalu jalankan:
# php artisan migrate:fresh --seed

# 6. Setup database & data uji
touch database/database.sqlite   # Windows: type nul > database/database.sqlite
php artisan migrate:fresh --seed

# 7. Jalankan dev server (butuh 2 terminal)
# Terminal 1: Backend
php artisan serve

# Terminal 2: Frontend (Vite HMR)
npm run dev
```

Akses aplikasi di **[http://localhost:8000](http://localhost:8000)**.

---

## Akun Uji Coba

Semua akun menggunakan password: **`password123`**

### Admin & Operator
| Peran | Username | Password |
|---|---|---|
| Admin | `admin` | `password123` |
| Operator | `operator` | `password123` |

### Dosen
| Nama | NIK (Username) | Password |
|---|---|---|
| Dr. Aris Sudaryanto, M.T. | `19876001` | `password123` |
| Siti Aminah, S.Kom., M.Cs. | `19876002` | `password123` |

### Mahasiswa (5 contoh dari 22 akun)
| Nama | NIM (Username) | Konsentrasi |
|---|---|---|
| Ahmad Rizki Pratama | `23.01.5003` | Web Development |
---

## Role & Hak Akses

| Role | Rute Prefix | Fitur Utama |
|---|---|---|
| **Admin** | `/dashboard/admin`, `/admin/users` | Manajemen akun staf (CRUD dosen & operator) |
| **Operator** | `/dashboard/operator`, `/operator/*` | Plotting dosen, monitoring global, kontrol periode, validasi edit request |
| **Dosen** | `/dashboard/dosen`, `/dosen/*` | Rekomendasi mahasiswa wali, monitoring bimbingan, review logbook & laporan |
| **Mahasiswa** | `/mahasiswa/*` | Pendaftaran magang, logbook harian, upload laporan, edit data profil |

---

## Route Utama

### Guest
| Method | URI | Deskripsi |
|---|---|---|
| GET | `/login` | Halaman login |
| POST | `/login` | Proses login |

### Mahasiswa
| Method | URI | Deskripsi |
|---|---|---|
| GET | `/mahasiswa/dashboard` | Dashboard mahasiswa |
| GET | `/mahasiswa/pendaftaran` | Form pendaftaran magang |
| POST | `/mahasiswa/pendaftaran/store` | Simpan pendaftaran |
| GET | `/mahasiswa/surat-pengantar` | Cetak surat pengantar PDF |
| GET | `/mahasiswa/logbook` | Logbook harian |
| POST | `/mahasiswa/logbook` | Simpan logbook |
| GET | `/mahasiswa/laporan` | Upload laporan akhir |
| POST | `/mahasiswa/laporan` | Simpan laporan (CKEditor) |
| GET | `/mahasiswa/edit-data` | Ajukan perubahan data |
| POST | `/mahasiswa/edit-data/store` | Simpan edit request |

### Dosen
| Method | URI | Deskripsi |
|---|---|---|
| GET | `/dosen/rekomendasi` | Rekomendasi mahasiswa wali |
| POST | `/dosen/rekomendasi/{mhs}/approve` | Setujui rekomendasi |
| POST | `/dosen/rekomendasi/{mhs}/reject` | Tolak rekomendasi |
| GET | `/dosen/monitoring` | Monitoring progres bimbingan |
| GET | `/dosen/logbook` | Review logbook mahasiswa |
| GET | `/dosen/laporan` | Review laporan akhir |
| POST | `/dosen/laporan/{magang}/approve` | Approve / revisi laporan |

### Operator
| Method | URI | Deskripsi |
|---|---|---|
| POST | `/operator/periode/toggle` | Buka/tutup pendaftaran |
| GET | `/operator/dosen-pembimbing` | Plotting dosen pembimbing |
| POST | `/operator/dosen-pembimbing/{magang}/assign` | Assign dosen |
| DELETE | `/operator/magang/{magang}` | Hapus data magang |
| GET | `/operator/monitoring` | Monitoring global |
| GET | `/operator/laporan` | Validasi laporan masuk |
| GET | `/operator/edit-requests` | Permintaan edit data |
| POST | `/operator/edit-requests/{id}/approve` | Setujui edit |
| POST | `/operator/edit-requests/{id}/reject` | Tolak edit |

### Admin
| Method | URI | Deskripsi |
|---|---|---|
| GET | `/admin/users` | Kelola akun staf |
| POST | `/admin/users` | Tambah staf |
| PUT | `/admin/users/{id}` | Update staf |
| DELETE | `/admin/users/{id}` | Hapus staf |

### Dev (hanya lingkungan `local`)
| Method | URI | Deskripsi |
|---|---|---|
| GET | `/dev/reset-to-pending` | Reset progress mahasiswa ke Pending |
| GET | `/dev/reset-to-approved` | Set semua status jadi lengkap |
| GET | `/dev/reset-test-data` | Reset seluruh data testing |
| GET | `/dev/reset-plotting-data` | Reset data plotting |

---

## Model & Relasi

```
User (1) ──── (1) Mahasiswa ──── (1) PesertaMagang ──── (1) Magang
  │                                                │
  │         ┌── 1 dosen_wali_id ──── Dosen (1)      ├── (1) Logbook (banyak)
  │         │                                       │
  │         └── via User.role                       └── (1) Laporan (banyak)
  │
  └── (1) Dosen ──── hasMany Mahasiswa (wali)
               ──── hasMany Magang (pembimbing)
```

- **User**: Polymorphic parent — satu user bisa memiliki data dosen atau mahasiswa (bukan keduanya) berdasarkan `role`.
- **Mahasiswa**: Memiliki `dosen_wali_id` mengacu ke `Dosen` (wali kelas). Status rekomendasi disimpan di `status_daftar`.
- **Magang**: Data magang yang diikuti oleh satu mahasiswa (individu) atau beberapa (kelompok via `PesertaMagang`).
- **PesertaMagang**: Pivot — menghubungkan mahasiswa ke magang dengan penanda `is_ketua`.
- **Logbook**: Catatan harian per magang.
- **Laporan**: Dokumen akhir per magang dengan 4 bab (CKEditor), status review/approved/revisi.
- **Setting**: Key-value store untuk konfigurasi sistem (misal: status periode).
- **EditRequest**: Permintaan perubahan data oleh mahasiswa yang perlu disetujui operator.

---

## Environment Variables

Variabel penting di `.env`:

```
APP_NAME=SIDUL
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite        # Default; ganti ke mysql untuk production
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120

CACHE_STORE=database
QUEUE_CONNECTION=database
```

Catatan: Secara default, session, cache, dan queue menggunakan driver `database` (tabel di SQLite/MySQL). Tidak memerlukan Redis atau memcached untuk development.

---

## Pengembangan

### Build Frontend
```bash
npm run build          # Production build
npm run dev            # Development dengan Vite HMR
```

### Reset Data Uji
```bash
php artisan migrate:fresh --seed
```

### Reset Cepat (Development)
Akses endpoint berikut di browser saat `APP_ENV=local`:
- `/dev/reset-to-pending` — reset semua status mahasiswa
- `/dev/reset-test-data` — reset penuh (lebih agresif)
- `/dev/reset-plotting-data` — hapus semua plotting dosen

---

## Lisensi

© 2026 SIDUL Team — Digital System, AMIKOM Yogyakarta.
