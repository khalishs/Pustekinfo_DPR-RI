<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // "sekretariat" digabung jadi baris kedua yang sama dengan "bidang",
        // supaya bagan organisasi cuma 2 baris (lihat profil.blade.php).
        DB::table('organization_members')->where('level', 'sekretariat')->update(['level' => 'bidang']);

        DB::statement("ALTER TABLE organization_members MODIFY level ENUM('kepala','bidang') NOT NULL DEFAULT 'bidang'");

        Schema::table('organization_members', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        Schema::table('organization_members', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
        });

        DB::statement("ALTER TABLE organization_members MODIFY level ENUM('kepala','sekretariat','bidang') NOT NULL DEFAULT 'bidang'");
    }
};
