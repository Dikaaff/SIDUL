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
        Schema::table('magangs', function (Blueprint $table) {
            $table->enum('tipe_magang', ['individu', 'kelompok'])->default('individu')->after('kode_magang');
            $table->string('konsentrasi')->nullable()->after('tipe_magang');
            $table->string('perusahaan')->nullable()->after('konsentrasi');
            $table->text('alamat')->nullable()->after('perusahaan');
            $table->date('tanggal_mulai')->nullable()->after('alamat');
            $table->date('tanggal_selesai')->nullable()->after('tanggal_mulai');
            
            // Make dosen_pembimbing_id nullable because at registration it might not be assigned yet
            $table->foreignId('dosen_pembimbing_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('magangs', function (Blueprint $table) {
            $table->dropColumn(['tipe_magang', 'konsentrasi', 'perusahaan', 'alamat', 'tanggal_mulai', 'tanggal_selesai']);
            $table->foreignId('dosen_pembimbing_id')->nullable(false)->change();
        });
    }
};
