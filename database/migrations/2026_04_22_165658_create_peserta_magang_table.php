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
        Schema::create('peserta_magangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('magang_id')
                ->constrained('magangs')
                ->cascadeOnDelete();
            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswas')
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
        Schema::dropIfExists('peserta_magangs');
    }
};
