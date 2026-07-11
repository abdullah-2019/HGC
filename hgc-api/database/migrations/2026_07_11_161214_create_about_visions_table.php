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
        Schema::create('about_visions', function (Blueprint $table) {
            $table->id();
            
            // Section label & title
            $table->string('section_label_en', 100)->nullable();
            $table->string('section_label_dari', 100)->nullable();
            $table->string('section_label_pashto', 100)->nullable();
            
            $table->string('title_en', 200)->nullable();
            $table->string('title_dari', 200)->nullable();
            $table->string('title_pashto', 200)->nullable();
            
            // Description
            $table->longText('description_en')->nullable();
            $table->longText('description_dari')->nullable();
            $table->longText('description_pashto')->nullable();
            
            // Image side
            $table->string('image_url')->nullable();
            $table->string('badge_value', 20)->default('2030');
            $table->string('badge_label_en', 100)->nullable();
            $table->string('badge_label_dari', 100)->nullable();
            $table->string('badge_label_pashto', 100)->nullable();
            
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
        Schema::dropIfExists('about_visions');
    }
};
