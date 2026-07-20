<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaderships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position')->default('KEPALA PUSTEKINFO');
            $table->string('photo')->nullable();
            $table->string('welcome_title')->default('Teknologi untuk pelayanan yang lebih baik');
            $table->text('description');
            $table->string('signature_role')->default('Kepala Pusat Teknologi Informasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderships');
    }
};