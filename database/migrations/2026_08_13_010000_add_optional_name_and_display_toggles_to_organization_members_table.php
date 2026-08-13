<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organization_members', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->boolean('show_name')->default(false)->after('name');
            $table->boolean('show_photo')->default(false)->after('photo');
        });
    }

    public function down(): void
    {
        Schema::table('organization_members', function (Blueprint $table) {
            $table->dropColumn(['name', 'show_name', 'show_photo']);
        });
    }
};
