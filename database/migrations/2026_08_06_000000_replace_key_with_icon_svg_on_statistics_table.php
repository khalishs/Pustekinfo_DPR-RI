<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    const ICON_BY_KEY = [
        'apps' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>',
        'karyawan' => '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/>',
        'pengguna' => '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'spbe' => '<circle cx="12" cy="8" r="6"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
    ];

    public function up(): void
    {
        Schema::table('statistics', function (Blueprint $table) {
            $table->text('icon_svg')->nullable()->after('key');
        });

        // Pindahin ikon yang sebelumnya hardcoded per `key` ke kolom icon_svg,
        // supaya statistik yang sudah ada tetap tampil dengan ikon yang sama.
        foreach (DB::table('statistics')->get() as $stat) {
            $icon = self::ICON_BY_KEY[$stat->key] ?? self::ICON_BY_KEY['apps'];
            DB::table('statistics')->where('id', $stat->id)->update(['icon_svg' => $icon]);
        }

        Schema::table('statistics', function (Blueprint $table) {
            $table->dropColumn('key');
        });
    }

    public function down(): void
    {
        Schema::table('statistics', function (Blueprint $table) {
            $table->string('key')->nullable();
        });
        Schema::table('statistics', function (Blueprint $table) {
            $table->dropColumn('icon_svg');
        });
    }
};
