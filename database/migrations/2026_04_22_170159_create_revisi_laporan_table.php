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
        Schema::create('revisi_laporan', function (Blueprint $table) {
                $table->id('id_revisi');
                $table->foreignId('id_laporan')
                    ->constrained('laporan', 'id_laporan')
                    ->cascadeOnDelete();
                $table->integer('bab_yang_diubah')->nullable();
                $table->longText('konten_lama');
                $table->longText('konten_baru');
                $table->foreignId('updated_by')
                    ->constrained('users')
                    ->cascadeOnDelete();
                $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisi_laporan');
    }
};
