<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('magangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_magang')->unique();
            $table->foreignId('dosen_pembimbing_id')
                ->nullable()
                ->constrained('dosens', 'id')
                ->cascadeOnDelete();
            $table->string('perusahaan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('konsentrasi')->nullable();
            $table->string('tipe_magang')->default('individu');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magangs');
    }
};
