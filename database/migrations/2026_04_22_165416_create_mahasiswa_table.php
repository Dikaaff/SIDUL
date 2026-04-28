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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('konsentrasi')->nullable();
            $table->unsignedBigInteger('dosen_wali_id')->nullable();
            $table->enum('status_magang', ['approve', 'pending','rejected'])->default('pending');
            $table->timestamps();
            $table->foreign('dosen_wali_id')
                ->references('id')
                ->on('dosens')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
