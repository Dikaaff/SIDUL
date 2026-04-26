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
                ->constrained('dosens', 'id')
                ->cascadeOnDelete();
            $table->string('status_magang');
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
