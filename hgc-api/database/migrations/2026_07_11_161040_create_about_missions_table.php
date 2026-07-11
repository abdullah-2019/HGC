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
        Schema::create('about_missions', function (Blueprint $table) {
            $table->id();
            
            // Section label & title
            $table->string('section_label_en', 100)->nullable();
            $table->string('section_label_dari', 100)->nullable();
            $table->string('section_label_pashto', 100)->nullable();
            
            $table->string('title_en', 200)->nullable();
            $table->string('title_dari', 200)->nullable();
            $table->string('title_pashto', 200)->nullable();
            
            // Description paragraph
            $table->longText('description_en')->nullable();
            $table->longText('description_dari')->nullable();
            $table->longText('description_pashto')->nullable();
            
            // Image side
            $table->string('image_url')->nullable();
            $table->string('quote_text_en', 300)->nullable();
            $table->string('quote_text_dari', 300)->nullable();
            $table->string('quote_text_pashto', 300)->nullable();
            
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
        Schema::dropIfExists('about_missions');
    }
};
