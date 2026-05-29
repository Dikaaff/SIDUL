# BAB III — METODE PENELITIAN

## 3.1 Objek Penelitian

Objek yang saya kembangkan dalam tugas akhir ini adalah sebuah sistem informasi bernama SIDUL, kepanjangannya Sistem Informasi Dual Learning. Sistem ini saya buat untuk mengelola seluruh proses magang mahasiswa di Program Studi D3 Teknik Informatika, Universitas Amikom Yogyakarta. Mulai dari pendaftaran, rekomendasi dosen wali, penentuan pembimbing, pengisian logbook harian, sampai dengan upload dan review laporan akhir, semuanya dilakukan lewat satu sistem terpadu.

Sebelum adanya SIDUL, proses magang masih berjalan secara manual. Mahasiswa harus mengisi formulir kertas, dosen harus menandatangani lembar rekomendasi satu per satu, dan operator harus mengecek data secara manual. Ini memakan waktu dan rentan kesalahan. Dari situlah saya tertarik untuk membuat sistem yang bisa mengotomatisasi alur tersebut.

Dalam sistem ini ada lima aktor yang punya peran dan akses masing-masing. Penjelasan lengkapnya bisa dilihat di Tabel 3.1.

**Tabel 3.1 Aktor dan Perannya di Sistem SIDUL**

| No | Aktor | Peran dalam Sistem |
|----|-------|-------------------|
| 1 | Mahasiswa | Aktor utama yang menjalankan proses magang: pendaftaran, isi logbook, upload laporan |
| 2 | Dosen Wali | Memberikan atau menolak rekomendasi magang untuk mahasiswa perwaliannya |
| 3 | Dosen Pembimbing | Memantau kegiatan magang dan menyetujui laporan akhir mahasiswa bimbingan |
| 4 | Operator | Mengelola periode pendaftaran dan menugaskan dosen pembimbing ke setiap kelompok magang |
| 5 | Admin | Mengelola akun pengguna, khususnya membuat dan menghapus akun dosen serta operator |

Kelima aktor ini saling terkait satu sama lain. Alurnya kurang lebih begini: mahasiswa daftar setelah direkomendasi dosen wali, lalu operator memplottingkan dosen pembimbing, kemudian mahasiswa mengisi logbook dan laporan, dan terakhir dosen pembimbing mereview serta menyetujui laporan tersebut.

---

## 3.2 Alur Penelitian

Metode yang saya pakai dalam penelitian ini adalah Agile dengan framework Scrum. Kenapa Scrum? Karena saya mengerjakan proyek ini bersama dua teman lain — satu orang di frontend (Tailwind + Blade) dan dua orang di backend (Laravel). Dengan Scrum, kami bisa bagi tugas per sprint dan tiap akhir sprint ada evaluasi. Kalau ada yang kurang, langsung diperbaiki di sprint berikutnya. Cocok banget buat tugas akhir yang nggak bisa molor karena ada deadline sidang.

Gambar 3.1 di bawah ini menunjukkan alur penelitian secara keseluruhan:

```
Start
  ↓
Planning — Analisis kebutuhan, bikin product backlog, tentukan sprint backlog
  ↓
Design — Buat UML, ERD, dan desain UI/UX di Figma
  ↓
Development — Ngoding backend Laravel + frontend Tailwind & DaisyUI
  ↓
Testing — Black box pakai Selenium + unit test pakai PHPUnit
  ↓
[Apakah sistem bebas bug?]
  ├── Ya → Deploy ke server lokal, integrasi database, kompilasi aset Vite
  │        ↓
  │        Sprint Review & Retrospective — Evaluasi hasil sprint
  │        ↓
  │        [Masih ada backlog?]
  │          ├── Ya → Kembali ke Planning (sprint berikutnya)
  │          └── Tidak → Selesai
  └── Tidak → Kembali ke Development (perbaiki bug dulu)
```

**Gambar 3.1 Diagram Alur Penelitian SIDUL**

Penjelasan detail setiap tahapannya ada di sub-bab berikut.

---

### 3.2.1 Plan (Perencanaan)

Tahap pertama ini isinya perencanaan. Saya dan tim duduk bareng untuk menentukan fitur apa aja yang harus ada di SIDUL, lalu kita urutkan prioritasnya. Hasil dari tahap ini adalah dokumen Product Backlog dan Sprint Backlog.

**Analisis Kebutuhan**

Kita kumpulin kebutuhan dari setiap aktor. Hasilnya kurang lebih seperti di Tabel 3.2.

**Tabel 3.2 Kebutuhan Pengguna per Aktor**

| No | Mahasiswa | Dosen Wali | Dosen Pembimbing | Operator | Admin |
|----|-----------|------------|------------------|----------|-------|
| 1 | Login pakai NIM | Login pakai NIK | Login pakai NIK | Login sebagai operator | Kelola akun pengguna |
| 2 | Daftar magang online | Lihat pengajuan mahasiswa wali | Lihat daftar bimbingan | Verifikasi pendaftaran | Buat/hapus akun dosen & operator |
| 3 | Cek status pendaftaran | Approve/reject rekomendasi | Pantau logbook | Tentukan dosen pembimbing | — |
| 4 | Isi logbook harian | — | Review & setujui laporan | Buka/tutup periode | — |
| 5 | Upload laporan akhir | — | Beri catatan revisi | Monitoring semua data | — |
| 6 | Download surat pengantar | — | — | Lihat laporan mahasiswa | — |
| 7 | Cetak logbook & laporan PDF | — | — | — | — |

**Skala Prioritas Fitur**

Dari daftar kebutuhan tadi, kita urutkan mana yang paling penting. Yang prioritas tinggi dikerjakan di sprint awal. Tabel 3.3 menunjukkan daftar prioritas fitur SIDUL.

**Tabel 3.3 Prioritas Fitur SIDUL**

| No | Fitur | Pengguna | Prioritas | Status |
|----|-------|----------|-----------|--------|
| 1 | Login multi-role | Semua | Tinggi | Selesai |
| 2 | Role middleware (RBAC) | Semua | Tinggi | Selesai |
| 3 | Dashboard per role | Semua | Tinggi | Selesai |
| 4 | Pendaftaran magang | Mahasiswa | Tinggi | Selesai |
| 5 | Rekomendasi dosen wali | Dosen Wali | Tinggi | Selesai |
| 6 | Plotting dosen pembimbing | Operator | Tinggi | Selesai |
| 7 | Logbook harian | Mahasiswa | Tinggi | Selesai |
| 8 | Review logbook | Dosen Pembimbing | Tinggi | Selesai |
| 9 | Upload laporan | Mahasiswa | Sedang | Selesai |
| 10 | Review & approve laporan | Dosen Pembimbing | Sedang | Selesai |
| 11 | Cetak PDF (surat, logbook, laporan) | Mahasiswa | Sedang | Selesai |
| 12 | Monitoring operator | Operator | Sedang | Selesai |
| 13 | Manajemen user admin | Admin | Sedang | Selesai |
| 14 | Toggle periode magang | Operator | Sedang | Selesai |
| 15 | Service layer & refactoring | — | Sedang | Selesai |
| 16 | PHPUnit testing | — | Sedang | Selesai |
| 17 | Responsive design | Semua | Rendah | Selesai |
| 18 | Selenium automation testing | — | Rendah | Proses |

**Sprint Backlog**

Dari prioritas tadi, kita bagi ke dalam sprint. Satu sprint durasinya 1-2 minggu. Tabel 3.4 menunjukkan pembagian sprint yang kita jalankan.

**Tabel 3.4 Sprint Backlog SIDUL**

| Sprint | Fitur | Deskripsi | Prioritas | Status |
|--------|-------|-----------|-----------|--------|
| Sprint 1 | Login multi-role | Auth system buat admin, operator, dosen, mahasiswa | Tinggi | Selesai |
| Sprint 1 | Role middleware | Proteksi route berdasarkan role | Tinggi | Selesai |
| Sprint 1 | Dashboard per role | Tampilan dashboard masing-masing aktor | Tinggi | Selesai |
| Sprint 2 | Pendaftaran magang + validasi kelompok | Form pendaftaran individu/kelompok | Tinggi | Selesai |
| Sprint 2 | Rekomendasi dosen wali | Approve/reject mahasiswa | Tinggi | Selesai |
| Sprint 3 | Plotting dosen pembimbing | Assign pembimbing + generate kode magang | Tinggi | Selesai |
| Sprint 3 | Logbook harian + review | CRUD logbook, pantau dari dosen | Tinggi | Selesai |
| Sprint 4 | Upload laporan + review | Upload bab 1-4, dosen approve/revisi | Sedang | Selesai |
| Sprint 4 | Cetak PDF (surat, logbook, laporan) | Generate PDF pake DomPDF | Sedang | Selesai |
| Sprint 5 | Monitoring operator + toggle periode | Pantau semua data + buka/tutup periode | Sedang | Selesai |
| Sprint 5 | Manajemen user admin | CRUD akun dosen & operator | Sedang | Selesai |
| Sprint 6 | Service layer refactoring | Pisah logic bisnis ke Services | Sedang | Selesai |
| Sprint 6 | PHPUnit testing | 35 unit test untuk fitur utama | Sedang | Selesai |
| Sprint 6 | Responsive design benerin | Perbaiki tampilan biar rapi di HP | Rendah | Selesai |

**Timeline Pengerjaan**

Kita kerja selama kurang lebih 3 bulan, dari awal Januari sampai akhir Maret 2026. Setiap sprint 2 mingguan. Tabel 3.5 menunjukkan timeline-nya.

**Tabel 3.5 Timeline Pengerjaan**

| Sprint | Periode | Fokus | Output |
|--------|---------|-------|--------|
| Sprint 1 | Minggu 1-2 Jan | Fondasi sistem | Auth, role middleware, dashboard |
| Sprint 2 | Minggu 3-4 Jan | Pendaftaran & rekomendasi | Form daftar + approve/reject dosen wali |
| Sprint 3 | Minggu 1-2 Feb | Plotting & logbook | Assign pembimbing + CRUD logbook |
| Sprint 4 | Minggu 3-4 Feb | Laporan & PDF | Upload laporan, review, cetak PDF |
| Sprint 5 | Minggu 1-2 Mar | Monitoring & admin | Pantau data operator + manage user admin |
| Sprint 6 | Minggu 3-4 Mar | Refactor & testing | Service layer + 35 PHPUnit test + responsive |

---

### 3.2.2 Design (Perancangan)

Tahap kedua ini kita bikin blueprint-nya dulu. Ada tiga hal yang dirancang: UML, database, dan UI.

**a. Pemodelan UML**

**Use Case Diagram**

Use case diagram ini gambarin interaksi antara aktor dengan sistem. Ada lima aktor yang masing-masing punya hak akses beda. Misalnya mahasiswa bisa daftar magang dan isi logbook, tapi nggak bisa ngakses halaman admin. Sebaliknya, admin cuma bisa kelola user, nggak bisa isi logbook. Gambar 3.2 menunjukkan use case diagram SIDUL.

*(Gambar 3.2 Use Case Diagram SIDUL)*

**Activity Diagram**

Activity diagram ini menjelaskan alur proses dari tiap fitur. Berikut beberapa diagram yang saya buat:

1. **Login** — User masukkan username dan password, sistem cek kredensial, kalau cocok redirect ke dashboard sesuai role. Kalau salah, muncul pesan error.

2. **Pendaftaran Magang** — Mahasiswa akses halaman pendaftaran, sistem cek apakah sudah dapat rekomendasi dari dosen wali. Kalau belum, dikembalikan ke dashboard. Kalau sudah, muncul form pendaftaran. Mahasiswa isi data perusahaan, pilih tipe (individu/kelompok), submit. Kalau kelompok, validasi anggota dulu.

3. **Logbook** — Mahasiswa buka halaman logbook, bisa nulis kegiatan harian atau cetak PDF. Kalau belum ada logbook, tombol cetak disable. Kalau sudah diisi, bisa submit dan muncul di daftar.

4. **Laporan** — Mahasiswa upload laporan bab 1-4. Bisa edit kapan aja sebelum direview dosen. Dosen bisa kasih catatan revisi atau langsung approve. Kalau sudah di-approve, status magang jadi "Selesai".

5. **Rekomendasi Dosen Wali** — Dosen wali lihat daftar mahasiswa bimbingan yang statusnya pending. Bisa approve atau reject satu per satu.

6. **Plotting Pembimbing** — Operator lihat daftar magang yang belum punya dosen pembimbing. Pilih dosen dari dropdown, submit, otomatis kode magang ke-generate dan status jadi "Aktif".

7. **Review Laporan** — Dosen pembimbing lihat laporan mahasiswa bimbingan, baca isinya, kasih feedback, dan pilih approve atau revisi.

8. **Monitoring Operator** — Operator bisa lihat semua data magang, filter berdasarkan status atau keyword, pantau progres setiap kelompok.

9. **Manajemen User** — Admin bisa lihat daftar dosen dan operator, tambah akun baru, atau hapus akun yang sudah ada.

**b. Arsitektur Database**

Relasi antar tabel di SIDUL bisa dilihat di Entity-Relationship Diagram (ERD) pada Gambar 3.3. Saya buat 9 tabel utama:

- **users** — nyimpen data login semua pengguna (username, password, role)
- **dosens** — profil dosen (nik, nama, hubungan ke users)
- **mahasiswas** — profil mahasiswa (nim, nama, konsentrasi, status_magang, dosen_wali_id)
- **magangs** — data pendaftaran magang (kode, perusahaan, tanggal, status, pembimbing)
- **peserta_magangs** — hubungan mahasiswa ke magang, termasuk status ketua kelompok
- **logbooks** — catatan kegiatan harian (magang_id, tanggal, kegiatan, catatan_dosen)
- **laporans** — data laporan akhir (judul, bab 1-4, status, catatan_dosen)
- **komentar_laporans** — komentar dari dosen
- **revisi_laporans** — riwayat revisi laporan
- **settings** — konfigurasi sistem (kayak status periode buka/tutup)

Relasinya kurang lebih gini: satu user bisa punya satu mahasiswa atau satu dosen. Satu mahasiswa bisa ikut satu magang (lewat peserta_magang). Satu magang bisa punya banyak peserta (kelompok) dan satu pembimbing. Satu magang punya banyak logbook dan satu laporan.

*(Gambar 3.3 ERD SIDUL)*

**c. Desain Antarmuka (UI/UX)**

Desain UI SIDUL saya bikin pake Figma. Konsepnya clean UI dengan warna utama ungu (#6B21A8) sebagai identitas sistem. Kenapa ungu? Biar keliatan khas dan nggak pasaran kayak biru atau hijau yang udah dipakai banyak sistem kampus.

**Palet Warna:**

| Elemen | Kode Warna | Dipakai buat |
|--------|-----------|--------------|
| Primary | #6B21A8 | Tombol utama, header, brand |
| Secondary | #F49E0A | Kartu info penting, aksen |
| Background | #F9FAFB | Latar halaman |
| Success | #16A34A | Status berhasil, approve |
| Warning | #F59E0B | Status pending, review |
| Danger | #EF4444 | Error, reject, hapus |

**Tipografi:**

Saya pake font Instrument Sans dari Google Fonts. Font ini bersih, modern, dan enak dibaca di layar. Ukuran hurufnya dibedakan berdasarkan hirarki:

- Judul halaman: 24-36px, bold
- Judul section: 18-24px, bold
- Label form: 10-12px, uppercase bold — khas SIDUL
- Isi konten: 14-16px, medium
- Badge status: 8-10px, uppercase bold

**Komponen UI:**

Semua komponen UI saya bikin pake Tailwind CSS v4 + DaisyUI v5. Ada 14 komponen reusable yang bisa dipake di banyak halaman: button, card, input, select, modal, navbar, sidebar, stat-card, status-badge, page-header, search-input, section-title, empty-state, dan sidebar-link.

Setiap komponen punya efek interaktif:
- **Hover** — warna berubah lebih gelap
- **Active (klik)** — sedikit mengecil (scale-95)
- **Focus** — muncul ring ungu
- **Disabled** — transparan dan nggak bisa diklik

Link Figma: https://www.figma.com/design/LJFCJcmL4QNkvkOFDv4kep/Wireframe-SIDUL-

---

### 3.2.3 Development (Pengembangan)

Ini tahap yang paling seru: ngoding. Kami bertiga bagi tugas — satu orang fokus frontend (Blade + Tailwind + DaisyUI), dua orang di backend (Laravel + database). Kami pake Laravel 12 sebagai framework utama karena menurut saya ARMYnya gede, dokumentasi lengkap, dan fitur-fitur kayak Eloquent ORM, middleware, sama routing-nya udah siap pakai.

**a. Backend (Laravel)**

Struktur backend SIDUL kurang lebih gini:

- **Routes** — Semua endpoint URL didefinisikan di `routes/web.php`. Ada route publik (login), route yang butuh auth, dan route khusus per role yang udah dilindungi middleware.
- **Controllers** — Ada 6 controller: AuthController, MahasiswaController, DosenController, OperatorController, AdminController, dan Controller (base class).
- **Middleware** — Dua middleware: `MockAuthMiddleware` (nggak dipake) dan `RoleMiddleware` yang udah diaktifkan buat proteksi route. Setiap route cuma bisa diakses oleh role yang sesuai.
- **Models** — 12 model Eloquent. Relasi udah didefinisikan biar query lebih gampang. Misalnya `$magang->pembimbing()` buat dapetin dosen pembimbing dari satu magang.
- **Service Layer** — Ini yang kita tambahin di sprint terakhir. Logic bisnis dipisah ke `app/Services/`: MahasiswaService, DosenService, OperatorService, PeriodeService. Biar controller nggak gemuk. Hasilnya, `MahasiswaController` turun dari 305 baris jadi 173 baris.

Contoh kode service — pas mahasiswa daftar magang, controller tinggal panggil:

```php
$result = $this->mahasiswaService->daftar(Auth::user(), $request->all());

if (!$result->success) {
    return back()->with('error', $result->message);
}
```

Gampang kan bacanya? Nggak ada lagi logic validasi bertumpuk di controller.

**b. Database (MySQL)**

Kita pake MySQL sebagai database utama. Struktur tabel dibuat pake Laravel migration, jadi histori perubahannya tercatat. Fitur kayak foreign key constraints dipake biar data konsisten — misalnya kalau magang dihapus, peserta_magangs ikut kehapus otomatis.

Eloquent ORM bikin kita nggak perlu nulis SQL manual. Contoh:

```php
$magangAktif = Magang::with(['peserta.mahasiswa', 'pembimbing'])
    ->where('status_magang', 'Aktif')
    ->latest()
    ->get();
```

Satu baris udah dapet data magang aktif lengkap dengan peserta dan pembimbingnya.

**c. Frontend (Tailwind + DaisyUI + Blade)**

Tampilan SIDUL dibangun pake Blade template (laravel punya). Strukturnya pake layout utama (`layouts/app.blade.php`) yang isinya sidebar + navbar + konten. Tiap halaman tinggal extend layout itu, nggak perlu ulang-ulang HTML.

Komponen UI dibikin reusable. Misalnya komponen `card`:

```blade
<x-card padding="large" border>
    Isi card di sini
</x-card>
 />

Komponen kayak gini bisa dipake di banyak halaman tanpa harus nulis ulang styling-nya.

Responsive design juga kita perhatiin. Pake utility Tailwind kayak `lg:`, `md:`, `sm:` biar tampilan menyesuaikan ukuran layar. Sidebar di desktop muncul di samping, di HP disembelin terus bisa dimunculin pake tombol hamburger.

---

### 3.2.4 Testing (Pengujian)

Tahap testing ini penting banget buat mastiin sistem jalan sesuai harapan. Kita pake dua metode: **PHPUnit** buat unit test backend (logic) dan **Selenium** buat black box testing (tampilan).

**a. PHPUnit (Automated Testing)**

Saya bikin 35 test yang mencakup 56 assertions. Test ini jalan otomatis tinggal ketik `php artisan test`. Berikut detailnya:

| File Test | Jumlah Test | Yang Diuji |
|-----------|------------|------------|
| AuthTest.php | 11 | Login semua role, password salah, logout, middleware blocking |
| MahasiswaTest.php | 8 | Dashboard, akses halaman terlarang, pendaftaran dll |
| DosenTest.php | 5 | Dashboard, monitoring, rekomendasi, blokir akses |
| OperatorTest.php | 5 | Dashboard, monitoring, plotting, blokir akses |
| AdminTest.php | 6 | Dashboard, CRUD user, blokir akses |

Contoh test sederhana:

```php
public function test_admin_can_login()
{
    $response = $this->post('/login', [
        'username' => 'admin',
        'password' => 'password123',
    ]);

    $response->assertRedirect('/dashboard/admin');
    $this->assertAuthenticated();
}
```

Dengan test kayak gini, kalau tiba-tiba ada perubahan kode yang bikin login rusak, kita langsung tahu karena test-nya gagal.

**b. Selenium (Black Box Testing)**

Selain PHPUnit, kita juga pake Selenium buat ngetes dari sisi pengguna. Selenium bakal otomatis buka browser, klik-klik tombol, isi form, dan ngecek apakah yang muncul di layar sesuai yang diharapkan. Bedanya sama PHPUnit: PHPUnit ngetes logika backend (misalnya apakah data masuk ke database), sedangkan Selenium ngetes tampilan (misalnya apakah tombol muncul, apakah pesan error tampil).

Skenario yang diuji pake Selenium meliputi:
- Login sukses dan gagal buat setiap role
- Pendaftaran magang valid dan invalid
- Isi logbook dan cetak PDF
- Approve dan reject rekomendasi
- Plotting dosen pembimbing
- CRUD user admin

Kalau ada bug, Selenium bakal nyatet dan kita balik lagi ke tahap Development buat benerin. Ini sesuai sama prinsip Scrum yang iteratif.

**c. Hasil Pengujian**

Dari 35 test PHPUnit yang dijalankan, **semua lulus (35 passed, 56 assertions)**. Waktu eksekusi sekitar 27 detik. Ini menunjukkan bahwa fitur-fitur utama SIDUL udah berjalan dengan benar dan nggak ada error di logika backend.

---

### 3.2.5 Deploy (Penyebaran)

Tahap deploy ini intinya mastiin kode yang udah jadi bisa jalan di lingkungan server. Kita pake server lokal buat development. Langkah-langkahnya:

1. **Integrasi kode** — Semua perubahan dari branch masing-masing digabung. Konflik resolusi pake Git.
2. **Compile aset Vite** — Saya jalankan `npm run build` buat nge-minify CSS dan JavaScript. Vite otomatis ngubah file Tailwind yang besarnya megabita jadi kilobyte-an.
3. **Migrasi database** — `php artisan migrate` buat nyocokin struktur tabel. Data yang udah ada sebelumnya nggak ilang karena kita pake migration, bukan drop table.
4. **Cache clearing** — `php artisan optimize:clear` biar konfigurasi terbaru kepake.

Hasil deploy bisa dicek langsung lewat browser di `http://localhost:8000`.

---

### 3.2.6 Review (Peninjauan)

Tahap terakhir tiap sprint adalah review. Kita lihat lagi apa aja yang udah dikerjain, apa yang masih kurang, dan rencanain sprint berikutnya.

**Sprint Review:**

Di akhir sprint, kita demo-in fitur yang baru selesai. Misalnya selesai sprint 2, kita tunjukkin ke dosen pembimbing bahwa fitur daftar magang udah jalan — mahasiswa bisa daftar, data masuk ke database, dan statusnya berubah. Kalau ada yang kurang, kita catat sebagai perbaikan di sprint depan.

**Sprint Retrospective:**

Kita juga evaluasi proses kerjanya. Misalnya di sprint awal, kita sadar bahwa kode di controller terlalu gemuk dan susah di-test. Akhirnya di sprint 6 kita refactor pake service layer. Atau waktu kita sadar role middleware belum diaktifkan (jadi mahasiswa bisa akses halaman admin), kita langsung benerin di sprint berikutnya.

**Keputusan Siklus:**

Kalau setelah review ternyata masih ada fitur di product backlog yang belum dikerjain, kita lanjut ke sprint berikutnya mulai dari tahap Planning lagi. Tapi kalau semua fitur prioritas udah selesai dan sistem udah cukup stabil, kita nyatakan SIDUL siap.

---

## 3.3 Alat dan Bahan

Bagian ini jelasin alat dan bahan yang dipake selama penelitian.

### 3.3.1 Data Penelitian

Data yang dipake ada dua jenis:

**a. Data Primer**

Data primer saya dapet langsung dari narasumber dan pengamatan:

| Metode | Sumber | Keterangan |
|--------|--------|-----------|
| Wawancara | Koordinator Prodi | Tanya tentang prosedur magang yang selama ini jalan |
| Observasi | Proses administrasi magang | Lihat langsung alur dokumen dan hambatannya |

**b. Data Sekunder**

Data sekunder sebagai referensi:

| Sumber | Gunanya |
|--------|---------|
| Dokumentasi Laravel | Acuan utama implementasi |
| Dokumentasi Tailwind CSS | Panduan styling |
| Jurnal & skripsi terdahulu | Pembanding dan referensi akademik |
| Panduan magang prodi | Acuan alur bisnis |

### 3.3.2 Alat dan Instrumen

**a. Perangkat Keras (Hardware)**

| Komponen | Spesifikasi |
|----------|------------|
| Laptop | Prosesor Intel i5, RAM 8GB, SSD 256GB |
| Media Penyimpanan | Hardisk eksternal 1TB buat backup |
| Koneksi Internet | WiFi kampus dan paket data cadangan |

**b. Perangkat Lunak (Software)**

| Nama | Kategori | Fungsinya |
|------|----------|-----------|
| PHP 8.2 | Bahasa Pemrograman | Backend logic |
| Laravel 12 | Framework PHP | Struktur aplikasi MVC |
| MySQL | Database | Nyimpen data |
| Tailwind CSS v4 | Framework CSS | Styling utility-first |
| DaisyUI v5 | Library UI | Komponen siap pakai |
| Vite 7 | Build Tool | Compile aset frontend |
| Node.js | Runtime JS | Jalanin Vite & npm |
| Composer | Package Manager PHP | Manajemen dependensi backend |
| Visual Studio Code | Code Editor | Nulis kode |
| Git | Version Control | Nyimpen histori kode |
| Google Chrome | Browser | Testing & debugging |
| Barryvdh DomPDF | Library PDF | Generate surat & laporan |
| Figma | Design Tool | Bikin mockup UI |
| XAMPP | Local Server | Lingkungan server lokal |
| PHPUnit | Testing Framework | Unit test backend |
| Selenium | Automation Testing | Black box testing UI |
| Instrument Sans | Google Font | Tipografi sistem |

**c. Brainware (Tim Pengembang)**

| Nama | Peran | Tanggung Jawab |
|------|-------|---------------|
| Saya sendiri | Backend Developer | Controller, Service Layer, Model, Route, Testing |
| Teman 1 | Frontend Developer | Blade components, Tailwind/DaisyUI, responsive views |
| Teman 2 | Backend Developer | Database, fitur spesifik, bug fixing |
| Dosen Pembimbing | Pembimbing | Arahan akademik dan teknis |

---

## Kesimpulan Bab 3

Jadi gitu lah metode penelitian yang saya pake buat ngembangin SIDUL. Intinya saya pake Scrum — mulai dari planning, design, coding, testing, deploy, sampe review. Tiap sprint ada target fitur yang jelas. Tim saya isinya 3 orang (1 frontend, 2 backend) dan kita kerja bareng pake Git.

Dari segi teknis, SIDUL dibangun pake Laravel 12 di backend, Tailwind + DaisyUI di frontend, dan MySQL buat database. Setelah semua fitur kelar, kita test pake PHPUnit (35 test, semua lulus) dan Selenium (black box automation). Hasilnya, sistem SIDUL udah siap dipake buat ngelola magang di Prodi D3 Teknik Informatika Amikom Yogyakarta.
