# SIDUL — Sistem Informasi Dual Learning

Sistem Informasi Magang untuk Mahasiswa, Dosen Pembimbing, dan Operator.

---

## 🚀 Cara Menjalankan Lokal

```bash
# 1. Install dependencies
composer install

# 2. Copy environment file
cp .env.example .env

# 3. Generate app key
php artisan key:generate

# 4. Buat tabel database SQLite
php artisan migrate:fresh --seeder=SidulSeeder

# 5. Jalankan server
php artisan serve
```

Buka browser: **http://localhost:8000**

---

## 🔑 Akun Test (Development)

> Semua akun menggunakan password yang sama: `password123`

### 👩‍🎓 Mahasiswa

| Field    | Value                    |
|----------|--------------------------|
| Username (NIM) | `20210001`           |
| Password | `password123`            |
| URL      | http://localhost:8000/login |

### 👨‍🏫 Dosen

| Field    | Value                    |
|----------|--------------------------|
| Username (NIK) | `19876001`           |
| Password | `password123`            |
| URL      | http://localhost:8000/login |
| Dashboard | http://localhost:8000/dashboard/dosen |

### 🧑‍💼 Operator

| Field    | Value                    |
|----------|--------------------------|
| Username | `operator`               |
| Password | `password123`            |
| URL      | http://localhost:8000/login |
| Dashboard | http://localhost:8000/dashboard/operator |

### 🛡️ Super Admin

| Field    | Value                    |
|----------|--------------------------|
| Username | `admin`                  |
| Password | `password123`            |
| URL      | http://localhost:8000/login |
| Dashboard | http://localhost:8000/dashboard/admin |

---

## 🗺️ Navigasi URL

### Mahasiswa
| Halaman       | URL                              |
|---------------|----------------------------------|
| Dashboard     | `/dashboard`                     |
| Pendaftaran   | `/mahasiswa/pendaftaran`         |
| Progress      | `/mahasiswa/progress`            |
| Logbook       | `/mahasiswa/logbook`             |
| Bimbingan     | `/mahasiswa/bimbingan`           |
| Laporan       | `/mahasiswa/laporan`             |
| Profile       | `/mahasiswa/profile`             |
| Settings      | `/mahasiswa/settings`            |

### Dosen
| Halaman       | URL                              |
|---------------|----------------------------------|
| Dashboard     | `/dashboard/dosen`               |
| Monitoring    | `/dosen/monitoring`              |
| Bimbingan     | `/dosen/bimbingan`               |
| Logbook       | `/dosen/logbook`                 |
| Laporan       | `/dosen/laporan`                 |
| Rekomendasi   | `/dosen/rekomendasi`             |

### Operator
| Halaman       | URL                              |
|---------------|----------------------------------|
| Dashboard     | `/dashboard/operator`            |

### Super Admin
| Halaman       | URL                              |
|---------------|----------------------------------|
| Dashboard     | `/dashboard/admin`               |
| Kelola Staf   | `/admin/users`                   |

---

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.3)
- **Database**: SQLite (dev) / Supabase PostgreSQL (prod)
- **Frontend**: TailwindCSS + DaisyUI + Blade Templates

---

## ⚙️ Koneksi Database Supabase (Production)

Untuk mengaktifkan koneksi ke Supabase, edit `.env` dan uncomment baris berikut:

```env
DB_CONNECTION=pgsql
DB_HOST=aws-0-ap-southeast-1.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.wyzyybpnubnxzifeayhf
DB_PASSWORD=<password_supabase>
```





# PRODUCT REQUIREMENTS DOCUMENT (PRD)

# Sistem Informasi Management Magang (SIDUL)

---

# 1. PRODUCT OVERVIEW
## 1.1 Deskripsi Produk
Sistem Informasi Manajemen Magang Mahasiswa adalah aplikasi berbasis web yang dirancang untuk mengelola seluruh proses kegiatan magang mahasiswa mulai dari pendaftaran, penunjukan dosen pembimbing, proses bimbingan, pengumpulan laporan akhir, hingga konversi nilai.

Sistem ini bertujuan untuk:
* Mengurangi proses manual administrasi magang
* Mempermudah monitoring progres mahasiswa
* Memfasilitasi komunikasi mahasiswa dan dosen pembimbing
* Menyediakan sistem dokumentasi bimbingan yang terstruktur
* Menyediakan dashboard monitoring untuk operator akademik

---

# 2. TECHNOLOGY STACK
Framework Backend: Laravel (latest stable)
Realtime Component: Laravel Livewire
Styling Framework: Tailwind CSS
UI Component Library: DaisyUI
Database: MySQL / MariaDB
Authentication: Laravel Breeze atau Laravel Fortify
Role Management: Spatie Laravel Permission
File Storage: Laravel Storage (local / public disk)

---

# 3. USER ROLES
### 3.1 Mahasiswa
Hak akses mahasiswa: membuat pendaftaran magang, melihat dosen pembimbing, mengupload file bimbingan, melihat revisi dosen, mengupload laporan akhir, melihat status laporan, melihat nilai akhir

### 3.2 Dosen
Hak akses dosen: melihat daftar mahasiswa bimbingan, memberikan catatan revisi, memberikan approval laporan, memberikan nilai akhir

### 3.3 Operator
Hak akses operator: melihat semua pendaftaran, menentukan dosen pembimbing, memonitor progres magang, mengelola data dosen, melakukan konversi nilai

---

# 4. CORE SYSTEM WORKFLOW
Mahasiswa Register -> Pendaftaran Magang -> Verifikasi Operator -> Penentuan Dosen Pembimbing -> Bimbingan -> Revisi/Approval -> Laporan Akhir -> Penilaian -> Konversi Nilai

---

# 5. UI DESIGN SYSTEM & REQUIREMENTS
* **Framework:** Tailwind CSS + DaisyUI
* **Primary Color:** #6B21A8 (Purple)
* **Secondary Color:** #F49E0A (Amber/Orange)
* **Background Color:** #F9FAFB (Gray 50)
* **Layout:** Sidebar Navigation, Top Navbar, Content Area
* **Status Colors:** Pending (Warning), Revision (Error), Processing (Info), Approved (Success)