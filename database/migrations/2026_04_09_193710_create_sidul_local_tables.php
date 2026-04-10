<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Mahasiswa Profile
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nim')->unique();
            $table->string('prodi')->nullable();
            $table->integer('semester')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->timestamps();
        });

        // Tabel Dosen Profile
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nidn')->nullable()->unique();
            $table->string('prodi')->nullable();
            $table->timestamps();
        });

        // Tabel Operator Profile
        Schema::create('operators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nip')->nullable()->unique();
            $table->timestamps();
        });

        // Tabel Pendaftaran Magang
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('tipe');
            $table->string('perusahaan');
            $table->text('alamat');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('proposal_path')->nullable();
            $table->string('status')->default('Menunggu ACC');
            $table->timestamps();
        });

        // Tabel Logbook
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->text('kegiatan');
            $table->string('status')->default('Belum Diverifikasi');
            $table->timestamps();
        });

        // Tabel Bimbingan
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('dosen_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('jadwal_bimbingan')->nullable();
            $table->text('catatan')->nullable();
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });

        // Tabel Laporan
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul')->nullable();
            $table->string('file_path')->nullable();
            $table->string('status')->default('Belum Dikumpulkan');
            $table->text('catatan_dosen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
        Schema::dropIfExists('bimbingans');
        Schema::dropIfExists('logbooks');
        Schema::dropIfExists('pendaftarans');
        Schema::dropIfExists('operators');
        Schema::dropIfExists('dosens');
        Schema::dropIfExists('mahasiswas');
    }
};
