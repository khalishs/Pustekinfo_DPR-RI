<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Video Sekilas STELA sekarang cuma pakai link (YouTube, Google Drive,
        // Terabox, dll) — upload MP4 langsung dihapus. Kolom youtube_url yang
        // sudah terisi dipakai lagi jadi video_url supaya link yang ada tidak hilang.
        Schema::table('stela_videos', function (Blueprint $table) {
            $table->renameColumn('youtube_url', 'video_url');
        });

        Schema::table('stela_videos', function (Blueprint $table) {
            $table->dropColumn(['video', 'video_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stela_videos', function (Blueprint $table) {
            $table->string('video')->nullable();
            $table->string('video_type')->default('upload');
        });

        Schema::table('stela_videos', function (Blueprint $table) {
            $table->renameColumn('video_url', 'youtube_url');
        });
    }
};
