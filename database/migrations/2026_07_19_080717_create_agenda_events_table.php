<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agenda_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('event_date');
            $table->time('event_time')->nullable();
            $table->string('location')->nullable();
            $table->enum('color_tag', ['c1', 'c2', 'c3'])->default('c1');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_events');
    }
};