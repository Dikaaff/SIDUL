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
        Schema::create('magang', function (Blueprint $table) {
            $table->id('id_magang');
            $table->string('kode_magang')->unique();
            $table->foreignId('id_dosen_pembimbing')
                ->constrained('dosen', 'id_dosen')
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
        Schema::dropIfExists('magang');
    }
};
