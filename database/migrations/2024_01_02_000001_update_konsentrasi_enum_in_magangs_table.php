<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE magangs MODIFY konsentrasi ENUM('Web Development', '2D Animation', 'Networking') NULL");
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE magangs MODIFY konsentrasi VARCHAR(255) NULL');
    }
};
