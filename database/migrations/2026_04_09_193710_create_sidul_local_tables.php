<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Users sudah ada (dari default Laravel), tetapi kita akan modifikasi fieldnya nanti atau asumsikan file migrasi default menyesuaikan.
        // Di sini saya tambahkan tabel-tabel spesifik SIDUL.
        // Asumsi tabel users sudah di-create di migrasi 0001_01_01_000000_create_users_table.php,
        // tapi kita perlu pastikan `username` dan `role` ada di sana. Karena ini custom tables, kita buat custom tables saja.
        
        // Tabel Mahasiswas
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->foreignId('user_id')->nullable()->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->foreignId('dosen_wali_id')->nullable(); // akan di-reference nanti
            $table->enum('status_magang', ['Pending', 'Approve'])->default('Pending');
            $table->timestamps();
        });

        // Tabel Dosens
        Schema::create('dosens', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->foreignId('user_id')->nullable()->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->timestamps();
        });

        // Tambah foreign key untuk dosen_wali_id di mahasiswas
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->foreign('dosen_wali_id')->references('id_dosen')->on('dosens')->onDelete('set null');
        });

        // Tabel Magangs
        Schema::create('magangs', function (Blueprint $table) {
            $table->id('id_magang');
            $table->string('kode_magang')->unique();
            $table->string('nim'); // NIM ketua pendaftar
            $table->string('perusahaan')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('konsentrasi')->nullable();
            $table->string('tipe_magang')->default('individu');
            $table->text('link_bukti_magang')->nullable();
            $table->text('link_survey_perusahaan')->nullable();
            $table->foreignId('dosen_pembimbing_id')->nullable()->constrained('dosens', 'id_dosen')->onDelete('set null');
            $table->string('status_magang')->default('Pending');
            $table->timestamps();
        });

        // Tabel Peserta Magang
        Schema::create('peserta_magangs', function (Blueprint $table) {
            $table->id('id_peserta_magang');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswas', 'id_mahasiswa')->onDelete('cascade');
            $table->foreignId('id_magang')->constrained('magangs', 'id_magang')->onDelete('cascade');
            $table->string('nim');
            $table->timestamps();
        });

        // Tabel Logbook
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id('id_logbook');
            $table->foreignId('id_magang')->constrained('magangs', 'id_magang')->onDelete('cascade');
            $table->text('logbook');
            $table->text('catatan_dosen')->nullable();
            $table->timestamps();
        });

        // Tabel Laporan
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_magang')->constrained('magangs', 'id_magang')->onDelete('cascade');
            $table->text('laporan');
            $table->enum('status_laporan', ['Pending', 'Revisi', 'Approve'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropForeign(['dosen_wali_id']);
        });
        Schema::dropIfExists('laporans');
        Schema::dropIfExists('logbooks');
        Schema::dropIfExists('peserta_magangs');
        Schema::dropIfExists('magangs');
        Schema::dropIfExists('dosens');
        Schema::dropIfExists('mahasiswas');
    }
};
