# Dashboard Mahasiswa – SIDUL

## 1. Overview Dashboard Mahasiswa

Dashboard Mahasiswa merupakan halaman utama yang digunakan mahasiswa untuk mengelola seluruh proses kegiatan magang setelah berhasil masuk ke dalam sistem SIDUL.

Dashboard ini berfungsi sebagai pusat navigasi utama yang menampilkan status progres magang mahasiswa serta menyediakan akses cepat ke fitur-fitur utama seperti pendaftaran magang, pengelolaan dokumen persyaratan, logbook kegiatan, laporan magang, dan pengajuan surat akhir magang.

Setiap fitur pada dashboard dirancang dalam bentuk menu navigasi dan kartu status (progress card) yang dapat diklik oleh mahasiswa untuk membuka halaman terkait.

---

# 2. Struktur Menu Dashboard Mahasiswa

Dashboard mahasiswa memiliki menu utama sebagai berikut:

1. Dashboard
2. Pendaftaran Magang
3. Dokumen Persyaratan
4. Logbook Magang
5. Laporan Magang
6. Surat Akhir Magang

Setiap menu memiliki fungsi navigasi yang mengarahkan mahasiswa ke halaman yang sesuai dengan tahap proses magang.

---

# 3. Alur Proses di Dashboard Mahasiswa

Setelah mahasiswa masuk ke dashboard, alur penggunaan sistem dimulai dari tahap pendaftaran magang hingga penyelesaian kegiatan magang.

Alur prosesnya adalah sebagai berikut:

Dashboard Mahasiswa
↓
Mahasiswa memilih menu **Pendaftaran Magang**
↓
Mahasiswa mengisi form pendaftaran magang
↓
Mahasiswa mengirim data pendaftaran
↓
Sistem menampilkan status pendaftaran
↓
Operator melakukan verifikasi pendaftaran
↓
Jika disetujui, sistem menampilkan **dosen pembimbing yang direkomendasikan**
↓
Mahasiswa melanjutkan ke menu **Dokumen Persyaratan**
↓
Mahasiswa mengunggah dokumen persyaratan magang
↓
Sistem melakukan proses verifikasi dokumen
↓
Jika dokumen diterima, mahasiswa dapat melaksanakan kegiatan magang
↓
Mahasiswa mulai mengisi **Logbook Magang**
↓
Mahasiswa mengunggah **Laporan Magang**
↓
Mahasiswa mengajukan **Surat Akhir Magang**
↓
Proses magang selesai

---

# 4. Detail Fitur Dashboard Mahasiswa

## 4.1 Dashboard

Halaman dashboard menampilkan informasi ringkas mengenai progres kegiatan magang mahasiswa.

Informasi yang ditampilkan:

* Status pendaftaran magang
* Nama dosen pembimbing
* Status dokumen persyaratan
* Jumlah logbook yang telah diisi
* Status laporan magang
* Status surat akhir magang

Komponen dashboard:

Progress card untuk setiap tahap proses magang.

Contoh kartu status:

* Status Pendaftaran
* Status Dokumen
* Status Logbook
* Status Laporan
* Status Surat Akhir

Setiap kartu dapat diklik dan akan mengarahkan mahasiswa ke halaman fitur terkait.

---

## 4.2 Pendaftaran Magang

Menu ini digunakan mahasiswa untuk melakukan pengajuan magang.

Fungsi yang tersedia:

* Mengisi data instansi magang
* Mengisi judul magang
* Mengisi deskripsi kegiatan magang
* Mengunggah proposal magang

Aksi yang tersedia:

* Tombol **Submit Pendaftaran**
* Tombol **Edit Data Pendaftaran**

Setelah pendaftaran dikirim, mahasiswa dapat melihat status pendaftaran seperti:

* Pending
* Diverifikasi
* Ditolak

Jika pendaftaran telah diverifikasi, sistem akan menampilkan dosen pembimbing yang direkomendasikan.

---

## 4.3 Dokumen Persyaratan

Menu ini digunakan untuk mengunggah dokumen administrasi magang.

Dokumen yang dapat diunggah antara lain:

* Proposal magang
* Surat pengantar magang
* Dokumen persyaratan lainnya

Fungsi yang tersedia:

* Upload dokumen
* Melihat daftar dokumen
* Mengunduh dokumen
* Melihat status verifikasi dokumen

Status dokumen:

* Pending
* Diterima
* Ditolak

Jika dokumen telah diterima, mahasiswa dapat melanjutkan ke tahap kegiatan magang.

---

## 4.4 Logbook Magang

Menu ini digunakan mahasiswa untuk mencatat kegiatan harian selama magang.

Fungsi yang tersedia:

* Menambahkan logbook kegiatan
* Mengedit logbook
* Menghapus logbook
* Melihat daftar logbook

Data logbook meliputi:

* Tanggal kegiatan
* Deskripsi kegiatan
* Lampiran file (opsional)

Setiap logbook yang dikirim akan tersimpan dalam sistem sebagai dokumentasi kegiatan magang.

---

## 4.5 Laporan Magang

Menu ini digunakan mahasiswa untuk mengunggah laporan akhir magang.

Fungsi yang tersedia:

* Upload laporan magang
* Melihat status laporan
* Mengunduh laporan yang telah diunggah
* Mengunggah revisi laporan jika diperlukan

Status laporan:

* Pending review
* Revisi
* Disetujui

Jika laporan disetujui, mahasiswa dapat melanjutkan ke tahap pengajuan surat akhir magang.

---

## 4.6 Surat Akhir Magang

Menu ini digunakan mahasiswa untuk mengajukan surat akhir sebagai bukti penyelesaian kegiatan magang.

Fungsi yang tersedia:

* Mengajukan permohonan surat akhir
* Melihat status pengajuan
* Mengunduh surat akhir magang yang telah diterbitkan

Status pengajuan surat:

* Pending
* Diproses
* Selesai

Jika surat akhir telah diterbitkan, maka seluruh proses kegiatan magang mahasiswa dianggap selesai.

---

# 5. Navigasi dan Redirect Sistem

Setiap menu pada dashboard memiliki navigasi yang saling terhubung.

Contoh alur navigasi:

Klik **Pendaftaran Magang**
→ Redirect ke halaman form pendaftaran

Klik **Dokumen Persyaratan**
→ Redirect ke halaman upload dokumen

Klik **Logbook Magang**
→ Redirect ke halaman manajemen logbook

Klik **Laporan Magang**
→ Redirect ke halaman upload laporan

Klik **Surat Akhir Magang**
→ Redirect ke halaman pengajuan surat akhir

Navigasi ini memastikan mahasiswa dapat mengakses setiap tahap proses magang dengan mudah melalui dashboard utama.

---

# 6. Status Progress Magang

Sistem juga menampilkan progress tahapan magang mahasiswa.

Tahapan progress:

Pendaftaran
→ Verifikasi
→ Pengajuan Dokumen
→ Kegiatan Magang
→ Laporan Magang
→ Surat Akhir
→ Selesai

Progress ini dapat ditampilkan dalam bentuk progress bar atau timeline pada dashboard mahasiswa.
. dan style design nya masih sperti sekarang jangan di ubah2, dan pastikan responsive yaa!!