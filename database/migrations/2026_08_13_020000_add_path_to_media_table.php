<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->string('path')->nullable()->after('size');
        });

        // Upload baru disimpan sebagai file di storage/app/public (ikut ter-track
        // git, jadi ikut ke-push/pull ke developer lain) alih-alih blob di database.
        // Kolom data dibikin nullable karena file lama bakal di-backfill lalu
        // kosongin datanya, dan upload baru gak perlu isi kolom ini sama sekali.
        DB::statement('ALTER TABLE media MODIFY data LONGBLOB NULL');
    }

    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('path');
        });
    }
};
