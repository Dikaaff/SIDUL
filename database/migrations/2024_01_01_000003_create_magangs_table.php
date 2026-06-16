<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('magangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_magang', 20)->unique();
            $table->enum('tipe_magang', ['individu', 'kelompok'])->default('individu');
            $table->string('konsentrasi')->nullable();
            $table->string('perusahaan')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->foreignId('dosen_pembimbing_id')->nullable()->constrained('dosens')->onDelete('set null');
            $table->enum('status_magang', ['Pending', 'Aktif', 'Selesai'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('magangs');
    }
};
