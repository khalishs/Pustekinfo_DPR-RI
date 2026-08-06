<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agenda_events', function (Blueprint $table) {
            $table->string('color', 7)->nullable()->after('color_tag');
        });

        DB::table('agenda_events')->where('color_tag', 'c1')->update(['color' => '#e0a340']);
        DB::table('agenda_events')->where('color_tag', 'c2')->update(['color' => '#b0413e']);
        DB::table('agenda_events')->where('color_tag', 'c3')->update(['color' => '#1f9d7c']);
        DB::table('agenda_events')->whereNull('color')->update(['color' => '#14839C']);

        Schema::table('agenda_events', function (Blueprint $table) {
            $table->dropColumn('color_tag');
        });
    }

    public function down(): void
    {
        Schema::table('agenda_events', function (Blueprint $table) {
            $table->enum('color_tag', ['c1', 'c2', 'c3'])->default('c1')->after('color');
        });

        DB::table('agenda_events')->update(['color_tag' => 'c1']);

        Schema::table('agenda_events', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};
