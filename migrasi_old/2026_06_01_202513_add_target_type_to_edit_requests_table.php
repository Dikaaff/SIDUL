<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('edit_requests', function (Blueprint $table) {
            $table->string('target_type')->default('mahasiswa')->after('field');
            $table->unsignedBigInteger('target_id')->nullable()->after('target_type');
            $table->json('metadata')->nullable()->after('catatan_operator');
        });
    }

    public function down(): void
    {
        Schema::table('edit_requests', function (Blueprint $table) {
            $table->dropColumn(['target_type', 'target_id', 'metadata']);
        });
    }
};
