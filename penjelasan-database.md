# Penjelasan Database SIDUL (Bahasa Manusia)

---

## 1. Tabel `users` — Data Akun Login

Tabel ini menyimpan data login semua pengguna. Setiap pengguna punya **role** yang menentukan apa yang bisa mereka lakukan:
- **mahasiswa** — bisa daftar magang, isi logbook, upload laporan
- **dosen** — bisa merekomendasi mahasiswa, membimbing, review logbook & laporan
- **operator** — bisa plotting dosen pembimbing, approve edit data, toggle periode, dll
- **admin** — bisa kelola akun dosen & operator

> Relasi: Satu user bisa punya satu data mahasiswa ATAU satu data dosen (tergantung role-nya).

---

## 2. Tabel `mahasiswas` — Data Mahasiswa

Ini data detail mahasiswa. Setiap mahasiswa terhubung ke satu akun user. Mahasiswa punya:
- **NIM** dan **nama**
- **Konsentrasi** (misal: Web Development, Networking, dll)
- **Status magang**: Pending (belum direkomendasi), Approve (sudah disetujui dosen wali), atau Rejected (ditolak)
- **Dosen wali** — dosen yang bertanggung jawab memberikan rekomendasi

> Relasi: Setiap mahasiswa punya SATU dosen wali. Satu dosen wali bisa punya BANYAK mahasiswa.

---

## 3. Tabel `dosens` — Data Dosen

Data dosen dengan NIK dan nama. Dosen punya dua peran:
1. **Dosen Wali** — merekomendasi mahasiswa bimbingannya untuk magang
2. **Dosen Pembimbing** — membimbing mahasiswa yang sudah magang (review logbook, approve laporan)

> Relasi: Satu dosen bisa jadi wali dari BANYAK mahasiswa, dan bisa jadi pembimbing dari BANYAK magang.

---

## 4. Tabel `magangs` — Data Pendaftaran Magang

Ini data magang yang sudah didaftarkan oleh mahasiswa. Isinya:
- **Kode magang** — kode unik (auto generate)
- **Tipe magang** — individu (sendiri) atau kelompok (tim)
- **Perusahaan & alamat** — tempat magang
- **Tanggal mulai & selesai**
- **Dosen pembimbing** — ditunjuk oleh operator
- **Status magang**: Pending (baru daftar), Aktif (sudah diplotting), Selesai, Ditolak

> Relasi: Satu magang bisa diikuti oleh SATU atau BANYAK mahasiswa (tergantung tipe). Satu magang punya SATU dosen pembimbing.

---

## 5. Tabel `peserta_magangs` — Penghubung Mahasiswa ke Magang

Tabel ini menjawab pertanyaan: "Mahasiswa ini ikut magang yang mana dan sebagai apa?"

Di sinilah ditentukan siaja **ketua kelompok** (is_ketua = true) dan siaja anggota biasa. Kalau magang individu, cuma ada satu peserta sebagai ketua.

> Relasi: Menghubungkan mahasiswa dengan magang (Many-to-Many dengan tambahan field is_ketua).

---

## 6. Tabel `logbooks` — Catatan Kegiatan Harian

Logbook isinya catatan kegiatan harian selama magang. Setiap kali mahasiswa nulis kegiatan, tersimpan di sini:
- **Tanggal** dan **kegiatan**
- **Catatan dosen** — bisa diisi dosen pembimbing kalau mau ngasih feedback

> Relasi: Satu magang bisa punya BANYAK logbook. Rahasianya: kalau magang kelompok, satu magang dipakai bareng, jadinya logbooknya dipakai bareng juga.

---

## 7. Tabel `laporans` — Laporan Akhir Magang

Setiap magang punya SATU laporan akhir. Laporan terdiri dari judul dan 4 bab (masing-masing disimpan terpisah di kolom bab1, bab2, bab3, bab4).

Status laporan:
- **review** — draft, masih bisa diedit
- **revisi** — butuh perbaikan
- **approved** — sudah lulus

> Relasi: Satu magang cuma punya SATU laporan. Tapi laporan bisa punya BANYAK komentar dan BANYAK revisi.

---

## 8. Tabel `komentar_laporans` — Komentar per BAB

Dosen pembimbing bisa ngasih komentar per BAB laporan. Misalnya dosen baca bab 1, trus komen "bab 1 perlu diperbaiki bagian latar belakang".

> Relasi: Satu laporan bisa punya BANYAK komentar, dari BANYAK user (biasanya dosen).

---

## 9. Tabel `revisi_laporans` — Riwayat Perubahan Laporan

Setiap kali mahasiswa memperbaiki laporan (berdasarkan komentar dosen), sistem nyimpan riwayat perubahannya: konten lama → konten baru, dan BAB mana yang diubah.

> Relasi: Satu laporan bisa punya BANYAK revisi.

---

## 10. Tabel `edit_requests` — Permintaan Edit Data

Ini fitur buat mahasiswa yang mau ngubah data dirinya (nama, konsentrasi, data perusahaan, atau anggota kelompok). Operator yang approve atau tolak.

Contoh:
- "Saya ingin mengubah nama perusahaan dari PT A ke PT B"
- "Saya ingin mengganti anggota kelompok"

> Relasi: Satu mahasiswa bisa punya BANYAK permintaan. Diproses oleh operator.

---

## 11. Tabel `settings` — Pengaturan Sistem

Tabel simpel buat nyimpen pengaturan. Isinya cuma key-value. Contoh: `is_periode_open` = 1 artinya periode magang dibuka, kalau 0 berarti ditutup.

---

## 12. Tabel `operators` — Data Staf Operator

Data detail operator (staff_id). Mirip kayak mahasiswa dan dosen, ini data pelengkap dari user yang role-nya operator.

---

## Ringkasan Alur dari Awal sampai Akhir

```
1. MAHASISWA login
2. Dosen Wali merekomendasi mahasiswa (status → Approve)
3. Mahasiswa daftar magang (isi perusahaan, tanggal, dll) → muncul data di magangs
4. Operator assign dosen pembimbing (status magang → Aktif)
5. Mahasiswa isi LOGBOOK setiap hari
6. Mahasiswa upload LAPORAN akhir
7. Dosen review laporan, kasih komentar, minta revisi atau approve
8. Operator bisa buka/tutup PERIODE magang kapan aja
```

---

## Catatan Khusus

- **Magang kelompok**: 1 data magang dipakai bareng oleh ketua + anggota. Logbook dan laporan juga dipakai bareng. Yang bisa ngubah anggota kelompok cuma KETUA.
- **Dosen wali vs dosen pembimbing**: Dosen wali tugasnya merekomendasi (sebelum magang), dosen pembimbing tugasnya bimbing (sesudah magang). Bisa jadi orang yang sama, bisa juga beda.
- **Edit request**: Kalau mahasiswa mau ngubah data setelah magang berjalan, dia ajukan permintaan ke operator. Bukan langsung edit sendiri.
