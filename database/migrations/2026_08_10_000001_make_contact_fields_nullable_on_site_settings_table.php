<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE site_settings MODIFY address TEXT NULL');
        DB::statement('ALTER TABLE site_settings MODIFY phone VARCHAR(255) NULL');
        DB::statement('ALTER TABLE site_settings MODIFY email VARCHAR(255) NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE site_settings MODIFY address TEXT NOT NULL');
        DB::statement('ALTER TABLE site_settings MODIFY phone VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE site_settings MODIFY email VARCHAR(255) NOT NULL');
    }
};
