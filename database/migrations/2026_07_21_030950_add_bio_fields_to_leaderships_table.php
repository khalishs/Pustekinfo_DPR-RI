<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leaderships', function (Blueprint $table) {
            $table->string('education')->nullable()->after('signature_role');
            $table->string('term')->nullable()->after('education');
            $table->string('expertise')->nullable()->after('term');
            $table->string('email')->nullable()->after('expertise');
        });
    }

    public function down(): void
    {
        Schema::table('leaderships', function (Blueprint $table) {
            $table->dropColumn(['education', 'term', 'expertise', 'email']);
        });
    }
};