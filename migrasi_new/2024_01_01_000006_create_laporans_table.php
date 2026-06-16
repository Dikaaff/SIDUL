<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('magang_id')->constrained('magangs')->onDelete('cascade');
            $table->string('judul');
            $table->mediumText('bab1')->nullable();
            $table->mediumText('bab2')->nullable();
            $table->mediumText('bab3')->nullable();
            $table->mediumText('bab4')->nullable();
            $table->enum('status', ['draft', 'review', 'revisi', 'approved'])->default('draft');
            $table->text('catatan_dosen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
