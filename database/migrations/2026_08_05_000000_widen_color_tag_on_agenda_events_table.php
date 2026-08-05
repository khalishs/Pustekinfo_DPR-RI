<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE agenda_events MODIFY color_tag VARCHAR(10) NOT NULL DEFAULT 'c1'");
        }
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE agenda_events MODIFY color_tag ENUM('c1','c2','c3') NOT NULL DEFAULT 'c1'");
        }
    }
};
