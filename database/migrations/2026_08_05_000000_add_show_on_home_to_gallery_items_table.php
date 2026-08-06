<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->boolean('show_on_home')->default(false)->after('is_featured');
        });

        // Home dulu nampilin 8 foto teratas (by sort_order) tanpa opsi manual.
        // Supaya tampilan Home nggak tiba-tiba kosong setelah kolom ini opt-in,
        // 8 foto yang sebelumnya otomatis tampil ditandai show_on_home di sini.
        $ids = DB::table('gallery_items')->orderBy('sort_order')->limit(8)->pluck('id');
        DB::table('gallery_items')->whereIn('id', $ids)->update(['show_on_home' => true]);
    }

    public function down(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropColumn('show_on_home');
        });
    }
};
