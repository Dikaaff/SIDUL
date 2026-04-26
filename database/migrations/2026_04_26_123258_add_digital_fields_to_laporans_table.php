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
        Schema::table('laporans', function (Blueprint $table) {
            $table->string('judul')->nullable()->after('id_magang');
            $table->longText('konten')->nullable()->after('judul');
            $table->boolean('is_draft')->default(true)->after('konten');
            $table->text('feedback_dosen')->nullable()->after('status_laporan');
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn(['judul', 'konten', 'is_draft', 'feedback_dosen']);
        });
    }
};
