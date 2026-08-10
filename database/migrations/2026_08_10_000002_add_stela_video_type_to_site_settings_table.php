<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('stela_video_type')->default('upload')->after('stela_video');
            $table->string('stela_youtube_url')->nullable()->after('stela_video_type');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['stela_video_type', 'stela_youtube_url']);
        });
    }
};
