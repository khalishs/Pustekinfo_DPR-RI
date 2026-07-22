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
            $table->text('description')->nullable()->after('title');
            $table->boolean('is_featured')->default(false)->after('size');
            $table->foreignId('category_id')->nullable()->after('category')->constrained('gallery_categories')->nullOnDelete();
        });

        // Pindahin data kategori lama (teks) ke category_id baru
        $categories = DB::table('gallery_categories')->pluck('id', 'slug');
        foreach ($categories as $slug => $id) {
            DB::table('gallery_items')->where('category', $slug)->update(['category_id' => $id]);
        }

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->string('category')->nullable();
        });
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'description', 'is_featured']);
        });
    }
};