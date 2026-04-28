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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('magang_id')
                ->constrained('magangs')
                ->cascadeOnDelete();
            $table->string('judul')->nullable();
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
        Schema::dropIfExists('laporans');
    }
};
