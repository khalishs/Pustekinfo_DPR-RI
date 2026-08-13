<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('original_name')->nullable();
            $table->string('mime_type');
            $table->unsignedBigInteger('size');
            $table->binary('data');
            $table->timestamps();
        });

        // Foto disimpan langsung sebagai data biner di database (bukan sebagai file
        // terpisah) supaya ikut tersimpan begitu database di-export/dibagikan ke
        // developer lain — kolom BLOB bawaan MySQL cuma muat 64KB, jadi dinaikkan
        // ke LONGBLOB (maks ~4GB) supaya cukup untuk foto ukuran penuh.
        DB::statement('ALTER TABLE media MODIFY data LONGBLOB NOT NULL');
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
