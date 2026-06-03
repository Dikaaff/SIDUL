# Jawaban Sidang — SIDUL (Sistem Informasi Dual Learning)

---

## A. Pertanyaan Terkait Sistem / Aplikasi (SIDUL)

---

### A1. Mengapa Anda memilih teknologi yang digunakan (misalnya Laravel/MySQL)? Apa keunggulannya dibandingkan teknologi lain?

**Jawaban:**
Saya memilih **Laravel 12** (PHP) sebagai backend dan **MySQL** sebagai database dengan alasan:

- **Laravel** menyediakan fitur bawaan lengkap yang sesuai dengan kebutuhan sistem ini: autentikasi, session management, CSRF protection, Eloquent ORM, migrasi database, validasi input, dan middleware RBAC. Semua terintegrasi tanpa perlu library pihak ketiga.
- **MySQL** dipilih karena sistem ini memiliki banyak relasi antar data (user → mahasiswa → peserta_magang → magang → logbook/laporan). Database relasional dengan foreign key constraints menjaga integritas data.
- **Blade + Tailwind CSS + DaisyUI** untuk frontend karena aplikasi bersifat internal kampus dengan routing server-side. Tidak perlu SPA/React yang menambah kompleksitas.

Perbandingan:
| Aspek | Laravel (dipilih) | Node.js/Express | React + REST API |
|-------|------------------|-----------------|------------------|
| Auth bawaan | ✅ Siap pakai | ❌ Perlu setup | ❌ Perlu JWT |
| ORM | ✅ Eloquent | ❌ Sequelize/Knex | ❌但 tidak langsung |
| Keamanan CSRF | ✅ Otomatis | ❌ Manual | ❌ Manual |
| Deployment | ✅ Mudah (shared hosting) | ❌ Butuh VPS | ❌ Butuh VPS |
| Learning curve | ✅ Dokumentasi lengkap | ⚠️ Sedang | ⚠️ Tinggi |

---

### A2. Bagaimana mekanisme pengamanan data mahasiswa, logbook, dan laporan magang dalam sistem ini?

**Jawaban:**
Terdapat beberapa lapis pengamanan:

1. **Autentikasi**: Session-based menggunakan Laravel Auth. Password di-hash bcrypt cost 12.
2. **Otorisasi (RBAC)**: Custom `RoleMiddleware` membagi akses menjadi 4 role — mahasiswa, dosen, operator, admin. Masing-masing hanya bisa mengakses data sesuai wewenangnya.
3. **CSRF Protection**: Semua form POST menyertakan `@csrf`. Token diperbarui setiap login/logout.
4. **Input Validation**: Semua input dari pengguna divalidasi menggunakan `$request->validate()` sebelum diproses.
5. **XSS Prevention**: Blade `{{ }}` secara otomatis melakukan HTML escaping. Pengecualian pada konten CKEditor (laporan) yang menggunakan `{!! !!}` — ini sudah diantisipasi karena hanya penulis laporan dan dosen pembimbing yang bisa mengakses.
6. **Mass Assignment Protection**: Semua model menggunakan properti `$fillable`.
7. **SQL Injection Prevention**: Eloquent ORM menggunakan parameterized queries.
8. **Route Protection**: Semua route sensitif dilindungi middleware `auth` + `role`.

---

### A3. Bagaimana sistem menangani kesalahan input atau jika pengguna menghapus data logbook secara tidak sengaja?

**Jawaban:**
**Untuk kesalahan input:**
- Dilakukan validasi di sisi server menggunakan `$request->validate()` dengan aturan spesifik seperti `required`, `string`, `max:255`, `date`, `in:individu,kelompok`, dll.
- Jika validasi gagal, Laravel otomatis mengembalikan redirect ke halaman sebelumnya dengan pesan error.
- Di sisi frontend, pesan error dari session flash (`with('error', ...)`) ditampilkan melalui komponen toast.

**Untuk penghapusan data:**
- **Logbook**: Saat ini tidak ada fitur hapus logbook untuk mahasiswa. Logbook hanya bisa ditambahkan, bukan dihapus atau diedit. Ini adalah design choice untuk menjaga integritas data harian.
- **Magang**: Hanya operator yang bisa menghapus data magang (via `DELETE /operator/magang/{magang}`). Ini dilindungi oleh middleware `auth` + `role:operator`.
- **Revisi Laporan**: Sistem menyimpan riwayat perubahan laporan di tabel `revisi_laporans` (konten_lama, konten_baru), sehingga perubahan tidak benar-benar hilang.

**Rekomendasi ke depan**: Implementasi **soft delete** (Laravel SoftDeletes trait) untuk memungkinkan restore data yang terhapus.

---

### A4. Mengapa data pengajuan magang, logbook, dan laporan dipisahkan dalam tabel yang berbeda?

**Jawaban:**
Pemisahan ini merupakan hasil **normalisasi database** yang bertujuan:

1. **Menghindari redundansi data**: Satu magang bisa memiliki banyak logbook (one-to-many). Jika disatukan dalam satu tabel, data magang akan terulang di setiap baris logbook.
2. **Integritas relasional**: Setiap entitas memiliki siklus hidup sendiri. Logbook bisa ditambahkan setiap hari tanpa mengubah data magang. Laporan memiliki status tersendiri (`review`, `revisi`, `approved`).
3. **Kemudahan query**: Memudahkan pencarian "semua logbook dari magang tertentu" atau "semua mahasiswa yang magangnya sudah selesai".
4. **Skalabilitas**: Jika suatu saat ada perubahan struktur logbook (misalnya tambah kolom lampiran), cukup ubah satu tabel tanpa menyentuh tabel magang atau laporan.

Struktur:
```
magangs (1) ──hasMany──> logbooks (*)
magangs (1) ──hasOne──> laporans (1)
```

---

### A5. Apa yang terjadi jika dua pengguna (misalnya mahasiswa dan dosen) mengakses data yang sama secara bersamaan?

**Jawaban:**
Saat ini sistem **tidak memiliki mekanisme locking** untuk akses bersamaan. Konsekuensinya:

- **Last-write-wins**: Data yang disimpan terakhir akan menimpa data sebelumnya.
- **Skenario mahasiswa edit laporan + dosen review bersamaan**: Dosen membaca konten lama, lalu mahasiswa menyimpan perubahan. Dosen kemudian memberikan review berdasarkan konten yang sudah usang — terjadi inkonsistensi.
- **Namun, umumnya tidak masalah karena**: Mahasiswa dan dosen memiliki field akses yang berbeda. Mahasiswa mengedit bab1–4, dosen hanya mengisi `catatan_dosen` dan `status`. Tidak ada konflik tulis di field yang sama.

**Rekomendasi ke depan**: Implementasi **optimistic locking** (version column) atau **Laravel cache lock** untuk mencegah konflik.

---

### A6. Mengapa Anda memilih framework yang digunakan untuk frontend?

**Jawaban:**
Frontend menggunakan **Laravel Blade + Tailwind CSS + DaisyUI**. Alasan:

- **Blade** adalah template engine bawaan Laravel — tidak perlu setup terpisah. Server-side rendering cocok untuk aplikasi CRUD seperti ini.
- **Tailwind CSS** memberikan fleksibilitas desain tanpa menulis CSS kustom. Dengan utility classes, tampilan bisa diubah cepat tanpa bolak-balik file CSS.
- **DaisyUI** menyediakan komponen siap pakai (button, card, modal, badge) berbasis Tailwind — mempercepat pengembangan 2–3x lipat.
- **Tidak menggunakan React/Vue** karena aplikasi tidak memerlukan real-time rendering, client-side routing, atau state management kompleks. Menambah React hanya akan menambah kompleksitas (bundling, API layer, CORS) tanpa manfaat signifikan.

---

### A7. Bagaimana arsitektur komunikasi antara frontend dan backend pada sistem Anda?

**Jawaban:**
Arsitektur komunikasi adalah **monolithic server-rendered** — bukan REST API SPA:

```
Browser ──HTTP Request──→ Laravel Router ──→ Controller
    ↑                          ↓
    │                    Service Layer (optional)
    ↑                          ↓
    │                    Model / Eloquent ORM
    ↑                          ↓
    └──HTML + CSS + JS──← Blade View ←── Database
```

**Ciri utama:**
- Semua route di `routes/web.php` (tidak ada `api.php`).
- Data dikirim via form submission (`POST`/`GET`) dengan `@csrf`.
- Session disimpan di file server, dikelola via cookie HttpOnly.
- JavaScript hanya vanilla JS untuk interaktivitas ringan: toggle sidebar, toast notification, filter client-side.
- Tidak ada AJAX, fetch API, atau koneksi real-time.

---

### A8. Bagaimana Anda menangani error pada sistem, baik dari sisi pengguna maupun sistem?

**Jawaban:**

**Frontend (pengguna):**
- **Toast notification global**: `showToast(type, message)` menampilkan notifikasi sukses/error/info dengan auto-dismiss 2 detik.
- **Pesan error dari Laravel**: `->with('error', $message)` dari controller ditampilkan sebagai toast.
- **Validasi form**: Laravel `$errors` langsung muncul di bawah input field.

**Backend (sistem):**
- **Service Layer + ServiceResult DTO**: Controller memanggil service, service mengembalikan `ServiceResult { success, message, data }`. Jika gagal, controller redirect dengan pesan error.
- **Exception handling**: Try-catch pada operasi yang berpotensi error (toggle periode, Setting get/set).
- **Route model binding**: 404 otomatis jika data tidak ditemukan.
- **ValidationException**: Otomatis redirect back dengan error oleh Laravel.

---

### A9. Apakah sistem dapat digunakan secara offline? Jika tidak, bagaimana solusinya jika jaringan tidak stabil?

**Jawaban:**
**Tidak bisa digunakan secara offline.** SIDUL adalah web application client-server — semua data tersimpan di database server.

**Solusi untuk jaringan tidak stabil:**
1. **Hosting lokal (intranet)**: Aplikasi bisa dideploy di server internal kampus/LAN PCA. Tidak membutuhkan koneksi internet.
2. **Minimasi data per halaman**: Halaman dirancang ringan (Blade server-rendered, CSS via Vite build) sehingga load cepat bahkan di koneksi lambat.
3. **Session persistence**: File-based session tidak memerlukan koneksi eksternal.
4. **Rekomendasi ke depan**: Implementasi **Service Worker** untuk cache halaman statis dan **IndexedDB** untuk penyimpanan sementara data input jika offline.

---

### A10. Jelaskan proses autentikasi dan otorisasi dalam sistem ini.

**Jawaban:**

**Autentikasi** (proses verifikasi identitas):
1. User input username (NIM/NIK) dan password di halaman login.
2. `AuthController::login()` memvalidasi input → `Auth::attempt($credentials, $remember)`.
3. Laravel membandingkan password input dengan hash bcrypt di tabel `users`.
4. Jika cocok: session di-regenerate (`session()->regenerate()`) → redirect ke dashboard sesuai role.
5. Jika salah: redirect back dengan error "NIM/NIK atau Password salah".

**Otorisasi** (proses pembatasan akses):
1. Setiap route group dilindungi `middleware(['auth', 'role:xxx'])`.
2. `RoleMiddleware::handle()` mengecek `Auth::user()->role === $role`.
3. Jika role cocok: request dilanjutkan ke controller.
4. Jika tidak cocok: user diarahkan ke dashboard role-nya sendiri (bukan error 403).

**Empat role:**
| Role | Rute | Kemampuan |
|------|------|-----------|
| `mahasiswa` | `/mahasiswa/*` | Daftar magang, isi logbook, tulis laporan |
| `dosen` | `/dosen/*` | Rekomendasi, monitor, review laporan |
| `operator` | `/operator/*` | Atur periode, plot dosen, monitor semua |
| `admin` | `/admin/*` | Kelola user (create/delete) |

---

### A11. Mengapa Anda memilih MySQL sebagai database?

**Jawaban:**
Alasan pemilihan MySQL:

1. **Relasi data kompleks**: SIDUL memiliki 10 tabel dengan foreign key relationships. MySQL (InnoDB) mendukung referential integrity dengan `ON DELETE CASCADE` dan `ON DELETE SET NULL`.
2. **Transaksi ACID**: Diperlukan untuk operasi yang melibatkan multi-tabel seperti pendaftaran kelompok (insert magang + insert peserta).
3. **Kesesuaian dengan Laravel**: Eloquent ORM dioptimalkan untuk database relasional. Fitur seperti `with()`, `withCount()`, `has()`, `whereHas()` bekerja optimal di MySQL.
4. **Deployment**: Lingkungan kampus umumnya menyediakan MySQL/MariaDB. Hosting PHP juga hampir selalu mendukung MySQL.
5. **Performa cukup**: Untuk skala kampus (ratusan mahasiswa per angkatan), MySQL sudah lebih dari cukup.

---

### A12. Bagaimana hubungan antar tabel dalam database Anda?

**Jawaban:**
Berikut diagram relasi antar tabel SIDUL:

```
users (1) ──hasOne──> mahasiswas (1) ──hasOne──> peserta_magangs (1) ──belongsTo──> magangs (1)
users (1) ──hasOne──> dosens (1)
users (1) ──hasOne──> operators (1)

dosens (1) ──hasMany──> mahasiswas (sebagai dosen_wali_id)
dosens (1) ──hasMany──> magangs (sebagai dosen_pembimbing_id)

magangs (1) ──hasMany──> peserta_magangs (*)
magangs (1) ──hasMany──> logbooks (*)
magangs (1) ──hasOne──> laporans (1)

laporans (1) ──hasMany──> komentar_laporans (*)
laporans (1) ──hasMany──> revisi_laporans (*)
```

**Penjelasan alur:**
1. `users` → login credentials dan role.
2. `mahasiswas`/`dosens`/`operators` → profil spesifik per role.
3. `magangs` → program magang (inti dari sistem).
4. `peserta_magangs` → jembatan many-to-many mahasiswa ke magang.
5. `logbooks` → aktivitas harian per magang.
6. `laporans` → laporan akhir per magang (1 magang = 1 laporan).
7. `komentar_laporans` + `revisi_laporans` → review trail dari dosen.

---

### A13. Apakah Anda menggunakan indexing pada database? Jika iya, pada bagian apa?

**Jawaban:**
Index secara otomatis dibuat oleh Laravel dan MySQL pada:

| Kolom | Tipe Index | Dibuat Oleh |
|-------|-----------|-------------|
| `id` (semua tabel) | Primary Key (clustered) | InnoDB otomatis |
| `user_id` (foreign keys) | Index | `foreignId()` Laravel |
| `mahasiswa_id` (peserta_magangs) | Index | `foreignId()` Laravel |
| `magang_id` (logbooks, laporans) | Index | `foreignId()` Laravel |
| `username` (users) | Unique Index | Migrasi `->unique()` |
| `nim` (mahasiswas) | Unique Index | Migrasi `->unique()` |
| `nik` (dosens) | Unique Index | Migrasi `->unique()` |
| `kode_magang` (magangs) | Unique Index | Migrasi `->unique()` |
| `key` (settings) | Unique Index | Migrasi `->unique()` |

Saat ini belum ada **index komposit** atau **fulltext index** yang ditambahkan secara manual. Untuk skala data kecil (ratusan baris) di lingkungan kampus, performa query masih sangat memadai tanpa index tambahan.

---

### A14. Apakah password pengguna sudah diamankan? Bagaimana caranya?

**Jawaban:**
**Ya, sudah diamankan** dengan:

1. **Algoritma bcrypt** dengan cost factor **12 rounds** (dikonfigurasi via `BCRYPT_ROUNDS=12` di `.env`).
2. **Automatic hashing**: Model `User` memiliki casting `'password' => 'hashed'` — setiap assignment ke atribut `password` otomatis di-hash.
3. **Verifikasi**: Laravel `Auth::attempt()` menggunakan `Hash::check()` untuk membandingkan input dengan hash.
4. **Seeder**: Password di seeder dibuat dengan `Hash::make('password')` — juga menggunakan bcrypt.
5. **Tidak ada plain text**: Password tidak pernah disimpan dalam bentuk plain text di database.

Perbandingan keamanan:
| Algoritma | Cost | Waktu estimasi brute-force (8 karakter) |
|-----------|------|-----------------------------------------|
| bcrypt cost 12 | ~250ms per hash | Puluhan tahun |
| MD5 | <1µs per hash | Beberapa jam |
| SHA-256 | <1µs per hash | Beberapa jam |

---

### A15. Bagaimana sistem membatasi akses sesuai role (mahasiswa, dosen, admin)?

**Jawaban:**
Pembatasan akses dilakukan melalui **Route Middleware** + **RoleMiddleware custom**:

**Di route (`web.php`):**
```php
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', ...);
    Route::post('/mahasiswa/logbook', ...);
    // ...
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dashboard/dosen', ...);
    Route::post('/dosen/rekomendasi/{mahasiswa}/approve', ...);
    // ...
});
```

**Di middleware (`RoleMiddleware.php`):**
1. Cek `Auth::check()` — jika belum login, redirect ke login.
2. Cek `$user->role !== $role` — jika tidak sesuai, redirect ke dashboard masing-masing.
3. Jika sesuai, `return $next($request)` — lanjut ke controller.

**Contoh**: Mahasiswa yang mengakses `/dashboard/admin` akan diarahkan ke `/mahasiswa/dashboard`, bukan melihat error 403.

---

### A16. Apakah sistem Anda memiliki potensi celah keamanan? Bagaimana mitigasinya?

**Jawaban:**

**Potensi celah dan mitigasinya:**

| Celah | Status | Mitigasi |
|-------|--------|----------|
| **SQL Injection** | ✅ Aman | Eloquent ORM (parameterized queries), tidak ada raw SQL |
| **XSS (Cross-Site)** | ⚠️ Sebagian | Blade `{{ }}` aman. CKEditor output `{!! !!}` berpotensi risiko — mitigasi: hanya user terautentikasi yang bisa mengakses |
| **CSRF** | ✅ Aman | Semua form ada `@csrf`, token diperbarui tiap login |
| **Brute Force Login** | ⚠️ Belum ada | Tidak ada rate limiting di route login. Rekomendasi: Laravel `RateLimiter` |
| **Mass Assignment** | ✅ Aman | Semua model punya `$fillable` |
| **Session Fixation** | ✅ Aman | `session()->regenerate()` setelah login |
| **Debug Mode** | ⚠️ Produksi | `APP_DEBUG=true` di .env — harus `false` di production |
| **CORS** | ✅ Tidak relevan | Monolithic app, tidak ada API endpoint |

**Rekomendasi tambahan:**
- Implementasi **HTMLPurifier** untuk sanitasi input CKEditor.
- Aktifkan **rate limiting** di route login.
- Gunakan **HTTPS** di production.
- Set `APP_DEBUG=false` di production.

---

## B. Pertanyaan Terkait Laporan / Konteks

---

### B1. Apa perbedaan sistem SIDUL Anda dengan penelitian sebelumnya?

**Jawaban:**
Berdasarkan studi literatur yang dilakukan, perbedaan SIDUL dengan penelitian sejenis:

1. **Workflow end-to-end**: Sistem mencakup seluruh siklus magang — dari rekomendasi dosen wali, pendaftaran, plotting dosen pembimbing, logbook harian, hingga laporan akhir dan approval. Penelitian sebelumnya biasanya hanya fokus pada satu aspek (misalnya hanya pendaftaran atau hanya logbook).

2. **Multi-role terintegrasi**: Empat role (mahasiswa, dosen, operator, admin) dalam satu sistem dengan alur kerja yang saling terhubung. Status mahasiswa mengalir: `Pending → Approve → (daftar) → Pending → (plotting) → Aktif → (logbook & laporan) → Selesai`.

3. **Output dokumen**: Fitur cetak surat pengantar, logbook PDF, dan laporan PDF menggunakan DomPDF — penelitian sebelumnya jarang menyediakan output dokumen siap cetak.

4. **RBAC dengan middleware**: Bukan hanya filter di view, tapi akses benar-benar dibatasi di level route.

5. **Arsitektur Service Layer + DTO**: Kode terstruktur dengan Service Layer pattern dan ServiceResult DTO — memudahkan testing dan maintenance.

---

### B2. Mengapa Anda memilih metode Waterfall dalam pengembangan sistem ini?

**Jawaban:**
Pemilihan Waterfall didasarkan pada:

1. **Kebutuhan sudah jelas**: Workflow magang (daftar → logbook → laporan) sudah baku dan dapat diidentifikasi dari awal melalui wawancara dan studi literatur.
2. **Timeline fixed**: Tugas akhir memiliki jadwal yang ditetapkan. Waterfall memberikan struktur fase yang jelas (analisis → desain → implementasi → pengujian → pemeliharaan).
3. **Dokumentasi formal**: Setiap fase menghasilkan dokumen (laporan) — penting untuk penilaian akademik.
4. **Pengembang tunggal**: Metode Agile (daily standup, sprint planning) kurang relevan untuk tim satu orang.

Meskipun Waterfall, dalam praktiknya tetap ada **iterasi** — terutama saat revisi dari dosen pembimbing dan perbaikan bug berdasarkan pengujian.

---

### B3. Bagaimana proses pengumpulan kebutuhan sistem dilakukan?

**Jawaban:**
Proses pengumpulan kebutuhan dilakukan melalui:

1. **Wawancara**: Dengan pihak terkait di PCA Mojotengah — operator/pengelola magang, dosen wali, dan mahasiswa untuk memahami alur kerja yang sedang berjalan.
2. **Studi literatur**: Menganalisis sistem informasi magang dari penelitian sebelumnya untuk mengidentifikasi fitur standar dan celah yang bisa ditingkatkan.
3. **Observasi**: Mengamati proses manual yang berjalan (pengajuan kertas, logbook tulisan tangan) untuk memastikan sistem digital mencakup semua kebutuhan.
4. **Dokumentasi persyaratan**: Hasilnya dirangkum dalam bentuk daftar fitur per role (mahasiswa, dosen, operator, admin) yang kemudian menjadi acuan pembangunan sistem.

---

### B4. Apakah pengguna (mahasiswa/dosen) siap menggunakan sistem ini?

**Jawaban:**
Kesiapan pengguna perlu dilihat dari dua sisi:

**Infrastruktur:**
- Server: PHP 8.2 + MySQL — bisa di shared hosting atau server kampus.
- Client: Browser modern (Chrome, Firefox, Edge) — semua perangkat sudah punya.
- Jaringan: Koneksi internet/intranet yang stabil.

**SDM:**
- UI menggunakan Tailwind + DaisyUI dengan layout yang familiar (sidebar, navbar, card, modal) — mirip dashboard pada umumnya.
- Form-form dilengkapi validasi dan pesan error yang jelas.
- Mahasiswa generasi sekarang sudah terbiasa dengan aplikasi web.

**Rekomendasi**: Sebelum peluncuran, perlu dilakukan **sosialisasi singkat** (1–2 jam) untuk setiap role — cara login, mengisi logbook, submit laporan. Dokumentasi penggunaan juga perlu disediakan.

---

### B5. Bagaimana strategi agar sistem ini tetap digunakan setelah penelitian selesai?

**Jawaban:**
Strategi keberlanjutan:

1. **Kode yang maintainable**: Service Layer pattern, migration versioning, model `$fillable`, testing — memudahkan pengembang lain melanjutkan.
2. **Testing komprehensif**: 86 test cases memastikan perubahan di masa depan tidak merusak fitur yang sudah ada.
3. **Seed data**: `DatabaseSeeder` + `SidulSeeder` menyediakan data awal siap pakai.
4. **Deployment sederhana**: `composer run setup` — satu perintah untuk instalasi lengkap.
5. **Dokumentasi terstruktur**: Kode dikomentari, struktur folder rapi, migration jelas.
6. **Open source potential**: Kode dapat dibagikan ke program studi lain jika terbukti bermanfaat.

---

### B6. Jenis pengujian apa saja yang Anda rencanakan?

**Jawaban:**
Jenis pengujian yang dilakukan dan direncanakan:

**Sudah dilakukan:**
- ✅ **Pengujian fungsional (black-box)**: 86 test cases dengan PHPUnit.
  - AuthTest: 11 test (login, logout, role blocking)
  - MahasiswaTest: 34 test (dashboard, pendaftaran, logbook, laporan)
  - DosenTest: 16 test (rekomendasi, monitoring, laporan approval)
  - OperatorTest: 19 test (periode, assign dosen, monitoring)
  - AdminTest: 6 test (create/delete user)

**Belum dilakukan (rencana):**
- ⬜ **Pengujian non-fungsional**: Load testing (k6/JMeter), security scanning.
- ⬜ **User Acceptance Test (UAT)**: Uji coba langsung dengan pengguna PCA Mojotengah.
- ⬜ **Cross-browser testing**: Memastikan kompatibilitas di berbagai browser.

---

### B7. Apakah Anda melakukan uji coba langsung dengan pengguna?

**Jawaban:**
Dari kode yang ada, **tidak ditemukan script UAT** yang terdokumentasi. Pengujian yang dilakukan baru sebatas **automated functional testing** menggunakan PHPUnit.

Namun, secara tidak langsung validasi dilakukan melalui:
- **Bimbingan dengan dosen pembimbing** — masukan dari dosen pembimbing menjadi bentuk validasi kebutuhan.
- **Revisi berdasarkan feedback** — perubahan database (nullable dosen_pembimbing_id, rename prodi) menunjukkan adanya penyesuaian berdasarkan masahan.

**Rencana**: UAT akan dilakukan dengan melibatkan perwakilan mahasiswa, dosen, dan operator PCA Mojotengah untuk memastikan sistem sesuai kebutuhan.

---

### B8. Sebutkan kendala atau bug yang ditemukan selama pengembangan.

**Jawaban:**
Kendala dan bug yang ditemukan:

**Bug 1 — `dosen_pembimbing_id` NOT NULL saat pendaftaran**
- **Masalah**: Migration awal membuat `dosen_pembimbing_id` sebagai `NOT NULL`. Saat mahasiswa mendaftar, data ini belum ada (dosen pembimbing ditentukan belakangan oleh operator).
- **Solusi**: Migration baru (`2026_04_26_164058`) mengubah kolom menjadi `nullable` dan menambah detail pendaftaran (perusahaan, alamat, tanggal).

**Bug 2 — Status magang tidak sinkron**
- **Masalah**: Ada dua kolom `status_magang` terpisah — satu di `mahasiswas` (Pending/Approve/Rejected) dan satu di `magangs` (Pending/Aktif/Selesai). Awalnya alur antar keduanya tidak terdefinisi dengan baik.
- **Solusi**: Memisahkan tanggung jawab — `mahasiswas.status_magang` untuk rekomendasi, `magangs.status_magang` untuk progress magang.

**Kendala — Perubahan struktur tabel di tengah pengembangan**
- Field `prodi` di-rename menjadi `konsentrasi`. Ini membutuhkan pembaruan di model, controller, view, dan test yang mereferensi field tersebut.

---

### B9. Bagaimana jika setelah sistem selesai ternyata ada kebutuhan baru?

**Jawaban:**
Waterfall memang kurang fleksibel terhadap perubahan setelah fase implementasi. Namun, arsitektur SIDUL dirancang untuk **mengakomodasi perubahan**:

1. **Migration**: Perubahan skema database bisa ditambahkan via migration baru tanpa mengubah struktur yang sudah ada (contoh: rename kolom, tambah kolom).
2. **Service Layer**: Business logic terpisah dari controller — modifikasi cukup di satu tempat.
3. **Blade Components**: Perubahan UI cukup di satu file komponen.
4. **Testing**: 86 test cases memudahkan regression testing setelah perubahan.

Untuk kebutuhan baru yang signifikan, pendekatan **mini-Waterfall** bisa diterapkan: analisis → desain → implementasi → test → deploy untuk setiap modul baru.

---

### B10. Jika mengulang penelitian, apakah Anda tetap menggunakan metode yang sama?

**Jawaban:**
**Ya, tetap Waterfall** untuk konteks Tugas Akhir dengan:
- Ruang lingkup jelas (manajemen magang)
- Timeline fixed
- Pengembang tunggal
- Kebutuhan dapat diidentifikasi dari awal

**Dengan catatan**: Saya akan menambahkan **prototyping** di fase awal untuk memvalidasi UI/UX dan alur sistem dengan dosen pembimbing sebelum implementasi penuh — mengurangi risiko perubahan besar di tengah jalan.

---

### B11. Sistem mana dari studi literatur yang paling mirip dengan sistem Anda?

**Jawaban:**
Sistem yang paling mirip adalah **sistem informasi magang/praktik kerja lapangan (PKL) berbasis web** yang umum dikembangkan sebagai Tugas Akhir di berbagai universitas. Persamaan umum:
- Fitur pendaftaran magang secara online
- Pengisian logbook harian
- Upload laporan akhir
- Monitoring oleh dosen pembimbing

**Yang membedakan SIDUL**:
- Workflow lebih lengkap (rekomendasi dosen wali → plotting operator → approval dosen)
- Empat role dengan akses terdefinisi ketat via middleware
- Output dokumen PDF (surat pengantar, logbook, laporan)
- Arsitektur Service Layer untuk maintainability
- 86 test cases — aspek pengujian yang jarang ditemukan di penelitian sejenis

---

### B12. Apa keunggulan utama sistem Anda dibanding penelitian lain?

**Jawaban:**
Keunggulan utama SIDUL:

1. **Workflow terintegrasi end-to-end**: Satu sistem menangani dari rekomendasi hingga approval laporan. Tidak ada gap antar proses.

2. **Status tracking yang jelas**: Setiap entitas memiliki status yang terdefinisi:
   - Mahasiswa: `Pending → Approve → Rejected`
   - Magang: `Pending → Aktif → Selesai`
   - Laporan: `review → revisi → approved`
   Alur ini memastikan tidak ada tumpang tindih tanggung jawab.

3. **Output dokumen siap cetak**: Surat pengantar, logbook, dan laporan bisa langsung dicetak PDF — mengurangi pekerjaan administrasi manual.

4. **Testing komprehensif**: 86 test cases memastikan keandalan sistem.

5. **Arsitektur bersih**: Service Layer + ServiceResult DTO — kode testable, readable, maintainable.

---

### B13. Teori apa yang paling berpengaruh dalam perancangan sistem ini?

**Jawaban:**
Teori dan pustaka yang paling berpengaruh:

1. **Rekayasa Perangkat Lunak (Pressman / Sommerville)** — Metodologi Waterfall sebagai kerangka pengembangan.
2. **Laravel Documentation** — Framework reference untuk autentikasi, Eloquent ORM, middleware, Blade, migration.
3. **Basis Data Relasional & Normalisasi (Connolly & Begg / Date)** — Desain skema database dengan foreign keys, normalisasi 3NF.
4. **RBAC (Role-Based Access Control)** — Teori kontrol akses yang diimplementasikan di `RoleMiddleware`.
5. **Utility-First CSS (Tailwind CSS)** — Pendekatan styling yang digunakan di frontend.
6. **Domain-Driven Design (Eric Evans)** — Service Layer pattern untuk pemisahan business logic.

---

### B14. Mengapa Anda memilih teknologi frontend yang digunakan?

**Jawaban:**
Detail jawaban sama dengan **A6**. Ringkasan: Blade untuk server-side rendering, Tailwind CSS untuk utility-first styling, DaisyUI untuk komponen siap pakai. Tidak menggunakan SPA framework karena tidak diperlukan.

---

### B15. Bagaimana proses wawancara dilakukan dalam pengumpulan data?

**Jawaban:**
Proses wawancara dilakukan dengan:
- **Narasumber**: Pihak terkait di PCA Mojotengah — pengelola magang (operator), dosen wali/pembimbing, dan mahasiswa peserta magang.
- **Metode**: Wawancara semi-terstruktur — ada daftar pertanyaan inti, namun memungkinkan diskusi lebih dalam tergantung jawaban narasumber.
- **Tujuan**: Memahami alur magang yang sedang berjalan, mengidentifikasi masalah di sistem manual, dan mengumpulkan kebutuhan fitur.
- **Output**: Daftar kebutuhan fungsional per role dan gambaran workflow sistem.

---

### B16. Apakah semua kebutuhan pengguna sudah diimplementasikan?

**Jawaban:**
Berdasarkan kode, fitur yang sudah diimplementasikan:

| Kebutuhan | Status |
|-----------|--------|
| Login/logout 4 role | ✅ |
| Dashboard per role dengan statistik | ✅ |
| Rekomendasi mahasiswa oleh dosen wali | ✅ |
| Pendaftaran magang (individu & kelompok) | ✅ |
| Plotting dosen pembimbing oleh operator | ✅ |
| Pengisian logbook harian + cetak PDF | ✅ |
| Penulisan laporan 4 bab + cetak PDF | ✅ |
| Review & approval laporan oleh dosen | ✅ |
| Monitoring mahasiswa bimbingan (dosen) | ✅ |
| Monitoring semua magang (operator) | ✅ |
| Toggle periode pendaftaran | ✅ |
| Surat pengantar | ✅ |
| Manajemen user (admin) | ✅ |
| Fitur notifikasi | ❌ Belum |
| Real-time chat/konsultasi | ❌ Belum |
| Export data Excel | ❌ Belum |

---

### B17. Bagaimana respons pengguna saat pertama kali menggunakan sistem?

**Jawaban:**
Response resmi dari pengguna belum tercatat karena sistem masih dalam tahap pengembangan dan belum diluncurkan secara resmi. Namun, untuk memastikan pengalaman pengguna yang baik:

- **UI familiar**: Dashboard style dengan sidebar, card, badge — mirip dengan aplikasi yang sehari-hari digunakan.
- **Form jelas**: Setiap form memiliki label, placeholder, dan validasi error.
- **Feedback visual**: Toast notification untuk setiap aksi (sukses/error).
- **DaisyUI components**: Button, modal, badge, card — komponen yang mudah dikenali.

Rencana: Setelah UAT, respons dan masukan pengguna akan didokumentasikan untuk perbaikan lebih lanjut.

---

### B18. Bagian mana dari sistem yang paling berisiko mengalami kegagalan?

**Jawaban:**
Bagian yang paling berisiko:

1. **CKEditor untuk input laporan**: Konten disimpan sebagai HTML dan ditampilkan dengan `{!! !!}`. Risiko XSS jika ada input berbahaya. Selain itu, copy-paste dari Word bisa membawa style yang tidak diinginkan.

2. **Concurrent access**: Tanpa locking, jika mahasiswa dan dosen mengakses laporan bersamaan, bisa terjadi inkonsistensi data (dosen review konten lama setelah mahasiswa update).

3. **Backup database**: Belum ada mekanisme backup otomatis. Jika server down tanpa backup, data hilang.

4. **Periode toggle manual**: Hanya operator yang bisa membuka/menutup periode. Jika operator lupa membuka periode, mahasiswa tidak bisa mengisi logbook.

---

### B19. Apa kekuatan utama dari sistem yang Anda bangun?

**Jawaban:**
Kekuatan utama SIDUL:

1. **Workflow lengkap**: Satu sistem menangani seluruh siklus magang — dari rekomendasi hingga laporan akhir. Tidak ada gap antar proses.

2. **Keamanan akses**: RBAC dengan middleware memastikan setiap pengguna hanya bisa mengakses data sesuai perannya.

3. **Testing**: 86 test cases memberikan kepercayaan diri bahwa fitur-fitur inti berjalan dengan benar.

4. **Output dokumen**: PDF generation untuk surat pengantar, logbook, dan laporan — memudahkan administrasi dan pengarsipan.

5. **Kode terstruktur**: Service Layer pattern, migration versioning, model `$fillable` — memudahkan pengembangan selanjutnya.

---

### B20. Jika sistem dikembangkan lebih besar, bagian mana yang perlu diperbaiki?

**Jawaban:**
Untuk skala yang lebih besar (fakultas/provinsi):

1. **Database optimization**: Tambah indexing, implementasi query caching (Redis), optimasi query untuk data ribuan mahasiswa.
2. **Infrastruktur**: Dari shared hosting ke VPS/dedicated server. Implementasi load balancing jika traffic tinggi.
3. **File storage**: Pindah dari penyimpanan lokal ke cloud storage (S3/MinIO) untuk PDF dan dokumen.
4. **Notifikasi**: Integrasi email/WhatsApp untuk reminder otomatis.
5. **Audit trail**: Logging semua aktivitas pengguna untuk kepentingan audit dan troubleshooting.
6. **Multi-tenant architecture**: Jika digunakan oleh banyak program studi atau institusi.

---

### B21. Jika diberi waktu tambahan, fitur apa yang ingin ditambahkan?

**Jawaban:**
Fitur yang akan ditambahkan dengan 1 bulan tambahan:

1. **Sistem notifikasi (prioritas utama)**: Email/WhatsApp reminder untuk:
   - Mahasiswa: pengingat isi logbook harian
   - Dosen: pemberitahuan ada laporan perlu direview
   - Operator: pemberitahuan ada magang baru perlu plotting

2. **Dashboard grafik**: Visualisasi data magang (Chart.js) — jumlah per status, per konsentrasi, per periode.

3. **Export data Excel**: Data monitoring dan laporan bisa diexport untuk administrasi.

4. **Soft delete**: Menggunakan Laravel SoftDeletes agar data yang terhapus bisa dipulihkan.

5. **Log perbaikan (activity log)**: Mencatat siapa dan kapan mengakses/mengubah data sensitif.

---

### B22. Mengapa studi literatur penting dalam penelitian ini?

**Jawaban:**
Studi literatur penting karena:

1. **Landasan ilmiah**: Memberikan dasar teori untuk perancangan dan pengembangan sistem.
2. **Identifikasi celah**: Melihat kelebihan dan kekurangan sistem yang sudah ada → menentukan fitur pembeda SIDUL.
3. **Pemilihan teknologi**: Literatur menjadi acuan pemilihan tech stack (Laravel, MySQL, Tailwind) yang tepat untuk kebutuhan.
4. **Best practices**: Mengetahui standar pengembangan sistem informasi yang baik.
5. **Hindari reinventing the wheel**: Tidak perlu membuat fitur dari nol jika sudah ada referensi yang bisa diadaptasi.

---

### B23. Bagian mana dari laporan yang paling sulit Anda kerjakan?

**Jawaban:**
Bagian yang paling sulit:

- **Bab Implementasi (Bab 4)**: Mendokumentasikan kode ke dalam bentuk tulisan sistematis. Harus menjelaskan arsitektur, alur program, dan kaitan antar modul tanpa menyalin kode mentah-mentah. Menjelaskan "kenapa" memilih desain tertentu lebih sulit daripada menjelaskan "apa" yang dibuat.
- **Bab Studi Literatur (Bab 2)**: Mencari referensi yang benar-benar relevan dan membedakan SIDUL dari penelitian yang sudah ada.

---

### B24. Apakah semua referensi yang digunakan valid?

**Jawaban:**
Referensi yang digunakan dalam pengembangan sistem:

**Referensi teknis (valid):**
- Laravel Documentation — laravel.com/docs (official)
- Tailwind CSS Documentation — tailwindcss.com (official)
- DaisyUI Documentation — daisyui.com (official)
- DomPDF GitHub — github.com/barryvdh/laravel-dompdf
- PHPUnit Documentation — phpunit.de (official)

**Referensi akademik:**
Untuk buku dan jurnal yang dikutip di laporan, validitas perlu dicek:
- Minimal 80% dari 10 tahun terakhir
- Bersumber dari jurnal terindeks atau buku referensi standar
- Daftar pustaka harus konsisten dengan format yang ditentukan (APA/IEEE)

---

## C. Pertanyaan Teknis (Implementasi SIDUL)

---

### C1. Jelaskan proses login dari sisi sistem secara teknis.

**Jawaban:**

**Alur teknis login:**

1. **Browser** → User mengisi form username & password → Klik submit.
2. **Route** → `POST /login` → `AuthController::login()`.
3. **Validasi** → `$request->validate(['username' => 'required', 'password' => 'required'])` — jika kosong, kembali dengan error "tidak boleh kosong!".
4. **Autentikasi** → `Auth::attempt($credentials, $remember)` — Laravel:
   - Mencari user di tabel `users` berdasarkan `username`
   - Membandingkan input password dengan hash bcrypt via `Hash::check()`
   - Jika cocok, login session dibuat
5. **Regenerasi session** → `$request->session()->regenerate()` — mencegah session fixation.
6. **Redirect** → `$this->redirectBasedOnRole(Auth::user()->role)`:
   - `mahasiswa` → `/mahasiswa/dashboard`
   - `dosen` → `/dashboard/dosen`
   - `operator` → `/dashboard/operator`
   - `admin` → `/dashboard/admin`
7. **Jika gagal** → `back()->withErrors(['error' => 'NIM/NIK atau Password salah'])`.

---

### C2. Bagaimana sistem menangani kehilangan atau kerusakan data?

**Jawaban:**
Saat ini **belum ada mekanisme backup atau recovery otomatis**. Beberapa antisipasi yang sudah ada:

| Aspek | Status |
|-------|--------|
| Backup database otomatis | ❌ Belum ada |
| Soft delete | ❌ Belum (data langsung dihapus) |
| Riwayat revisi laporan | ✅ Tabel `revisi_laporans` |
| Validasi input cegah error | ✅ `$request->validate()` |
| Foreign key constraints | ✅ Mencegah referensi tidak valid |

**Rekomendasi:**
- Install `spatie/laravel-backup` untuk backup otomatis ke cloud/storage.
- Implementasi SoftDeletes pada model Magang, Logbook, Laporan.
- Export data penting (logbook, laporan) ke PDF sebagai backup dokumentasi.

---

### C3. Apakah Anda melakukan pengujian performa sistem?

**Jawaban:**
Belum ada pengujian performa (load testing) yang dilakukan. Pengujian yang dilakukan baru sebatas **fungsional** (86 PHPUnit test cases).

**Alasan:**
- Skala pengguna: internal program studi (ratusan user) — tidak memerlukan optimasi performa tingkat tinggi.
- Fokus Tugas Akhir: validasi fungsionalitas, bukan optimasi skala besar.

**Rencana ke depan:**
- Load testing menggunakan **k6** atau **JMeter** untuk simulasi 100–500 concurrent users.
- Profiling query database menggunakan Laravel Debugbar.

---

### C4. Apa kendala terbesar saat mengembangkan sistem ini?

**Jawaban:**
**Kendala terbesar: Perubahan desain database di tengah pengembangan.**

**Cerita lengkap:**
Awalnya, tabel `magangs` hanya memiliki kolom `kode_magang`, `dosen_pembimbing_id` (NOT NULL), dan `status_magang`. Saat implementasi pendaftaran, disadari bahwa:
1. Mahasiswa mendaftar magang **sebelum** dosen pembimbing ditentukan.
2. Data perusahaan, alamat, dan tanggal magang juga harus dicatat saat pendaftaran.
3. Format `dosen_pembimbing_id` yang NOT NULL membuat pendaftaran gagal.

**Solusi:**
1. Migration baru menambahkan kolom `perusahaan`, `alamat`, `tanggal_mulai`, `tanggal_selesai`, `tipe_magang`.
2. `dosen_pembimbing_id` diubah menjadi nullable.
3. Flow diubah: Daftar (Pending) → Operator plotting (Aktif) → Logbook & Laporan → Selesai.

**Pelajaran**: Desain database harus mempertimbangkan seluruh lifecycle data dari awal.

---

### C5. Bagaimana struktur sistem Anda (frontend, backend, database)?

**Jawaban:**

```
SIDUL/
├── app/                          # BACKEND (PHP Laravel)
│   ├── Http/
│   │   ├── Controllers/          # 6 controller
│   │   │   ├── AuthController.php
│   │   │   ├── MahasiswaController.php
│   │   │   ├── DosenController.php
│   │   │   ├── OperatorController.php
│   │   │   ├── AdminController.php
│   │   │   └── Controller.php
│   │   └── Middleware/
│   │       ├── RoleMiddleware.php    # RBAC
│   │       └── MockAuthMiddleware.php
│   ├── Models/                   # 12 model Eloquent
│   ├── Services/                 # Service Layer
│   │   ├── ServiceResult.php     # DTO
│   │   ├── MahasiswaService.php
│   │   ├── DosenService.php
│   │   ├── OperatorService.php
│   │   └── PeriodeService.php
│   └── Providers/
│
├── resources/views/              # FRONTEND (Blade + Tailwind)
│   ├── layouts/                  # app.blade.php, auth.blade.php
│   ├── components/               # 12 komponen reusable
│   ├── auth/login.blade.php
│   ├── mahasiswa/                # 5 halaman + 2 PDF
│   ├── dosen/                    # 5 halaman
│   ├── operator/                 # 4 halaman
│   └── admin/                    # 2 halaman
│
├── routes/web.php               # Semua route aplikasi
│
├── database/
│   ├── migrations/               # 10 file migrasi
│   └── seeders/                  # DatabaseSeeder + SidulSeeder
│
├── tests/                        # 86 test cases (PHPUnit)
│   └── Feature/
│       ├── AuthTest.php
│       ├── MahasiswaTest.php
│       ├── DosenTest.php
│       ├── OperatorTest.php
│       └── AdminTest.php
```

---

## D. Pertanyaan Refleksi Pribadi

---

### D1. Jika diberi waktu tambahan, apa yang ingin Anda tingkatkan dari sistem ini?

**Jawaban:**
Hal yang paling ingin saya tingkatkan:

1. **Sistem notifikasi otomatis** — Email/WhatsApp reminder untuk mahasiswa (isi logbook), dosen (review laporan), operator (plotting). Ini yang paling berdampak pada kepatuhan penggunaan.

2. **Manajemen backup** — Backup database otomatis terjadwal agar data aman.

3. **Soft delete** — Agar data yang terhapus tidak benar-benar hilang dan bisa dipulihkan.

4. **Mobile responsiveness yang lebih baik** — Tampilan mobile untuk pengisian logbook dari HP.

5. **Dashboard visual** — Grafik statistik menggunakan Chart.js untuk monitoring yang lebih informatif.

---

### D2. Apa pelajaran terbesar yang Anda dapatkan dari pengerjaan sistem ini?

**Jawaban:**

**Teknis:**
- **Desain database itu krusial**: Perubahan kecil di schema bisa berdampak besar ke seluruh sistem. Rencanakan dengan matang di awal.
- **Testing menghemat waktu**: 86 test cases memberikan rasa aman saat melakukan perubahan. Tanpa test, setiap refactor berisiko merusak fitur yang sudah jadi.
- **Service Layer pattern**: Memisahkan business logic dari controller membuat kode lebih rapi, testable, dan mudah dimodifikasi.

**Non-Teknis:**
- **Disiplin dan manajemen waktu**: Menyeimbangkan coding, menulis laporan, dan revisi adalah tantangan tersendiri.
- **Menerima kritik**: Revisi dari dosen pembimbing adalah proses, bukan kegagalan.
- **Empati ke pengguna**: Kode yang elegant tidak berguna jika pengguna kesulitan menggunakannya.

---

### D3. Apakah sistem ini benar-benar siap digunakan di dunia nyata?

**Jawaban:**
**Siap dengan catatan:**

✅ **Fungsional**: Semua fitur inti sudah berfungsi dan teruji (86 test cases).

⚠️ **Yang perlu disiapkan sebelum live:**
1. **Deployment ke production** — setup server, domain, HTTPS, environment variables (`APP_ENV=production`, `APP_DEBUG=false`, `APP_KEY` baru).
2. **Data awal** — Input data dosen, mahasiswa, operator ke database.
3. **Sosialisasi** — Pelatihan singkat untuk setiap role.
4. **Backup plan** — Setup backup database terjadwal.
5. **UAT** — Uji coba dengan pengguna sebelum full launch.

---

### D4. Bagaimana Anda menjamin sistem ini tetap digunakan ke depannya?

**Jawaban:**
Jaminan keberlanjutan:

1. **Kode terstruktur**: Service Layer pattern, migration versioning, model `$fillable` — memudahkan pengembang lain untuk melanjutkan dan memodifikasi.
2. **Testing**: 86 test cases menjadi safety net untuk perubahan di masa depan.
3. **Dokumentasi**: Kode dikomentari, struktur folder jelas, migration history tercatat.
4. **Minimal dependency**: Hanya 4 package tambahan (DomPDF, PHPWord, Tailwind, DaisyUI) — tidak bergantung pada package yang rawan ditinggalkan.
5. **Open source**: Kode bisa dibagikan ke prodi lain jika terbukti bermanfaat — semakin banyak pengguna, semakin besar motivasi untuk maintenance.

Selain itu, sistem ini menyelesaikan **masalah nyata** — administrasi magang yang sebelumnya manual. Selama proses magang masih berjalan, kebutuhan akan sistem ini tetap ada.
