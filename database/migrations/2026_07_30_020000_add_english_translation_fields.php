<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news_items', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('category_en')->nullable()->after('category');
            $table->text('excerpt_en')->nullable()->after('excerpt');
            $table->longText('content_en')->nullable()->after('content');
        });

        Schema::table('agenda_events', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('core_values', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('subtitle_en')->nullable()->after('subtitle');
        });

        Schema::table('leaderships', function (Blueprint $table) {
            $table->string('welcome_title_en')->nullable()->after('welcome_title');
            $table->text('description_en')->nullable()->after('description');
            $table->string('signature_role_en')->nullable()->after('signature_role');
            $table->string('education_en')->nullable()->after('education');
            $table->string('term_en')->nullable()->after('term');
            $table->string('expertise_en')->nullable()->after('expertise');
        });

        Schema::table('organization_members', function (Blueprint $table) {
            $table->string('position_en')->nullable()->after('position');
            $table->text('unit_description_en')->nullable()->after('unit_description');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
            $table->json('features_en')->nullable()->after('features');
            $table->string('cta_text_en')->nullable()->after('cta_text');
        });

        Schema::table('statistics', function (Blueprint $table) {
            $table->string('label_en')->nullable()->after('label');
        });

        Schema::table('timeline_items', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('vision_missions', function (Blueprint $table) {
            $table->text('vision_text_en')->nullable()->after('vision_text');
            $table->text('mission_items_en')->nullable()->after('mission_items');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->text('address_en')->nullable()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('news_items', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'category_en', 'excerpt_en', 'content_en']);
        });

        Schema::table('agenda_events', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en']);
        });

        Schema::table('core_values', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en']);
        });

        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->dropColumn('name_en');
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en']);
        });

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'subtitle_en']);
        });

        Schema::table('leaderships', function (Blueprint $table) {
            $table->dropColumn(['welcome_title_en', 'description_en', 'signature_role_en', 'education_en', 'term_en', 'expertise_en']);
        });

        Schema::table('organization_members', function (Blueprint $table) {
            $table->dropColumn(['position_en', 'unit_description_en']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en', 'features_en', 'cta_text_en']);
        });

        Schema::table('statistics', function (Blueprint $table) {
            $table->dropColumn('label_en');
        });

        Schema::table('timeline_items', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en']);
        });

        Schema::table('vision_missions', function (Blueprint $table) {
            $table->dropColumn(['vision_text_en', 'mission_items_en']);
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('address_en');
        });
    }
};
