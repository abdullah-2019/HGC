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
        Schema::create('about_page_settings', function (Blueprint $table) {
            $table->id();
            
            // Hero Banner
            $table->string('hero_background_image')->nullable();
            $table->string('hero_label_en', 100)->nullable();
            $table->string('hero_label_dari', 100)->nullable();
            $table->string('hero_label_pashto', 100)->nullable();
            $table->string('hero_title_en', 200)->nullable();
            $table->string('hero_title_dari', 200)->nullable();
            $table->string('hero_title_pashto', 200)->nullable();
            $table->text('hero_subtitle_en')->nullable();
            $table->text('hero_subtitle_dari')->nullable();
            $table->text('hero_subtitle_pashto')->nullable();
            
            // SEO
            $table->string('meta_title_en', 200)->nullable();
            $table->string('meta_title_dari', 200)->nullable();
            $table->string('meta_title_pashto', 200)->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_dari')->nullable();
            $table->text('meta_description_pashto')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_page_settings');
    }
};
