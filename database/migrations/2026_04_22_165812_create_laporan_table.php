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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_magang')
                ->constrained('magang', 'id_magang')
                ->cascadeOnDelete();
            $table->string('judul');
            $table->longText('bab1')->nullable();
            $table->longText('bab2')->nullable();
            $table->longText('bab3')->nullable();
            $table->longText('bab4')->nullable();
            $table->enum('status', ['review','revisi','approved'])
                ->default('review');
            $table->text('catatan_dosen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
