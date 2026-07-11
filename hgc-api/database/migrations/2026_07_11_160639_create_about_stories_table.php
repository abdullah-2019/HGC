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
        Schema::create('about_stories', function (Blueprint $table) {
            $table->id();
            
            // Section label
            $table->string('section_label_en', 100)->nullable();
            $table->string('section_label_dari', 100)->nullable();
            $table->string('section_label_pashto', 100)->nullable();
            
            // Title (with year placeholder support)
            $table->string('title_en', 200)->nullable();
            $table->string('title_dari', 200)->nullable();
            $table->string('title_pashto', 200)->nullable();
            $table->year('founded_year')->default(2001);
            
            // Paragraphs (3 paragraphs as in your component)
            $table->longText('paragraph_1_en')->nullable();
            $table->longText('paragraph_1_dari')->nullable();
            $table->longText('paragraph_1_pashto')->nullable();
            
            $table->longText('paragraph_2_en')->nullable();
            $table->longText('paragraph_2_dari')->nullable();
            $table->longText('paragraph_2_pashto')->nullable();
            
            $table->longText('paragraph_3_en')->nullable();
            $table->longText('paragraph_3_dari')->nullable();
            $table->longText('paragraph_3_pashto')->nullable();
            
            // Image side
            $table->string('main_image')->nullable();
            $table->string('floating_card_value', 20)->default('24+');
            $table->string('floating_card_label_en', 100)->nullable();
            $table->string('floating_card_label_dari', 100)->nullable();
            $table->string('floating_card_label_pashto', 100)->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_stories');
    }
};
