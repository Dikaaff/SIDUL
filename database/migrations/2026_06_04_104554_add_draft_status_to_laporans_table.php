<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            // SQLite does not support MODIFY COLUMN or ENUM.
            // The column is already TEXT; the default is handled at the app level.
            // Skip this migration for SQLite (used in testing).
            return;
        }

        DB::statement("ALTER TABLE laporans MODIFY COLUMN status ENUM('draft','review','revisi','approved') NOT NULL DEFAULT 'draft'");
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("ALTER TABLE laporans MODIFY COLUMN status ENUM('review','revisi','approved') NOT NULL DEFAULT 'review'");
    }
};
