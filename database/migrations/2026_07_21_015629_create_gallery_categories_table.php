<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('gallery_categories')->insert([
            ['name' => 'Pelatihan', 'slug' => 'pelatihan', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kegiatan', 'slug' => 'kegiatan', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kerjasama', 'slug' => 'kerjasama', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Seremoni', 'slug' => 'seremoni', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_categories');
    }
};