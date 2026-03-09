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
