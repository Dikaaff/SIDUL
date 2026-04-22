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
        Schema::create('peserta_magang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_magang')
                ->constrained('magang', 'id_magang')
                ->cascadeOnDelete();
            $table->foreignId('id_mahasiswa')
                ->constrained('mahasiswa', 'id_mahasiswa')
                ->cascadeOnDelete();
            $table->boolean('is_ketua')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_magang');
    }
};
