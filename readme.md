# 🎓 SIDUL — Sistem Informasi Dual Learning

**SIDUL** adalah platform manajemen magang modern yang mengintegrasikan ekosistem kerja sama antara **Mahasiswa**, **Dosen Pembimbing**, dan **Operator Akademik**. Dibangun dengan fokus pada efisiensi administrasi, monitoring progres secara real-time, dan unifikasi dokumen dalam satu pintu.

---

## 🌟 Fitur Utama

- **Dashboard Multi-Role**: Antarmuka khusus untuk Mahasiswa, Dosen (Wali & Pembimbing), serta Operator.
- **Monitoring Progres Real-Time**: Lacak status pendaftaran, logbook harian, hingga validasi laporan akhir secara instan.
- **Sistem Komponen Terpadu**: Desain premium berbasis komponen untuk konsistensi UI/UX.
- **Manajemen Dokumen**: Cetak Surat Pengantar, Logbook, dan Laporan Akhir langsung ke format PDF.
- **Kontrol Periode**: Operator dapat membuka/menutup periode magang secara dinamis.

---

## 🛠️ Tech Stack & Architecture

- **Core Framework**: [Laravel 12](https://laravel.com/) (PHP 8.3+)
- **Styling**: [Tailwind CSS](https://tailwindcss.com/) & [DaisyUI](https://daisyui.com/)
- **Frontend**: Blade Components with Unified Design System
- **PDF Engine**: Barryvdh DomPDF

---

## 🚀 Panduan Instalasi (Quick Start)

Ikuti langkah-langkah berikut untuk menjalankan SIDUL di lingkungan lokal Anda:

### 1. Persiapan Awal
Pastikan Anda sudah menginstal **PHP 8.3+**, **Composer**, dan **Node.js**.

```bash
# Clone repository
git clone <url-repository-anda>
cd SIDUL
```

### 2. Instalasi Dependency
Instal library backend (Composer) dan frontend (NPM).
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
Salin file `.env.example` menjadi `.env` dan generate kunci aplikasi.
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database & Data Uji
Inisialisasi database dan masukkan data simulasi (Seeder).
```bash
php artisan migrate:fresh --seed
```

### 5. Menjalankan Aplikasi
Buka dua terminal dan jalankan perintah berikut:
```bash
# Terminal 1: Server Backend
php artisan serve

# Terminal 2: Vite Dev Server (Frontend)
npm run dev
```
Akses aplikasi di: **[http://localhost:8000](http://localhost:8000)**

---

## 🔑 Akun Uji Coba (Development)

Gunakan akun berikut untuk mengeksplorasi fungsionalitas setiap role. Semua akun menggunakan password: **`password123`**

| Role | Username | Password | Deskripsi |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin` | `password123` | Manajemen User & Staf |
| **Operator** | `operator` | `password123` | Plotting Dosen & Kontrol Sistem |
| **Dosen** | `19876001` | `password123` | Monitoring & Approval Bimbingan |
| **Mahasiswa** | `23.01.5029` `23.01.5017` `23.01.5010` | `password123` | Pendaftaran & Update Progres |

---

## 📂 Struktur Proyek Clean Architecture

Proyek ini telah direfaktor untuk mengikuti standar kode yang bersih:
- `resources/views/components`: Berisi komponen UI reusable (Header, Sidebar, Card).
- `app/Http/Controllers`: Logika bisnis yang ramping dan modular.
- `routes/web.php`: Manajemen rute yang terstruktur berdasarkan role.

---
© 2026 SIDUL Team — Digital System Amikom Yogyakarta.