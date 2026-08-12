<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stela_videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_type')->default('upload');
            $table->string('video')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('link_url')->nullable();
            $table->timestamps();
        });

        // Pindahkan video Sekilas STELA yang sudah pernah diisi lewat SiteSetting
        // (sebelum fitur ini punya tabel sendiri) supaya tidak hilang.
        $setting = DB::table('site_settings')->first();

        if ($setting && ($setting->stela_video || $setting->stela_youtube_url)) {
            DB::table('stela_videos')->insert([
                'video_type' => $setting->stela_video_type ?? 'upload',
                'video' => $setting->stela_video,
                'youtube_url' => $setting->stela_youtube_url,
                'link_url' => $setting->stela_url,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['stela_video', 'stela_video_type', 'stela_youtube_url', 'stela_url']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('stela_video')->nullable();
            $table->string('stela_video_type')->default('upload');
            $table->string('stela_youtube_url')->nullable();
            $table->string('stela_url')->nullable();
        });

        Schema::dropIfExists('stela_videos');
    }
};
