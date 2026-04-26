<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Dosens
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->timestamps();
        });

        // Tabel Mahasiswas
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('prodi');
            $table->enum('status_magang', ['Pending', 'Approve'])->default('Pending');
            $table->foreignId('dosen_wali_id')->nullable()->constrained('dosens')->onDelete('set null');
            $table->timestamps();
        });

        // Tabel Magangs
        Schema::create('magangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_magang')->unique();
            $table->foreignId('dosen_pembimbing_id')->constrained('dosens')->onDelete('cascade');
            $table->string('status_magang');
            $table->timestamps();
        });

        // Tabel Peserta Magang
        Schema::create('peserta_magangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('magang_id')->constrained('magangs')->onDelete('cascade');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->boolean('is_ketua')->default(false);
            $table->timestamps();
        });

        // Tabel Logbook
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('magang_id')->constrained('magangs')->onDelete('cascade');
            $table->date('tanggal');
            $table->text('kegiatan');
            $table->text('catatan_dosen')->nullable();
            $table->timestamps();
        });

        // Tabel Laporan
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('magang_id')->constrained('magangs')->onDelete('cascade');
            $table->string('judul');
            $table->longText('bab1')->nullable();
            $table->longText('bab2')->nullable();
            $table->longText('bab3')->nullable();
            $table->longText('bab4')->nullable();
            $table->enum('status', ['review', 'revisi', 'approved'])->default('review');
            $table->text('catatan_dosen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
        Schema::dropIfExists('logbooks');
        Schema::dropIfExists('peserta_magangs');
        Schema::dropIfExists('magangs');
        Schema::dropIfExists('mahasiswas');
        Schema::dropIfExists('dosens');
    }
};
