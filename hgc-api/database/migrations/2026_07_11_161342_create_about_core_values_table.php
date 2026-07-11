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
        Schema::create('about_core_values', function (Blueprint $table) {
            $table->id();
            
            // Section header
            $table->string('section_label_en', 100)->nullable();
            $table->string('section_label_dari', 100)->nullable();
            $table->string('section_label_pashto', 100)->nullable();
            
            $table->string('section_title_en', 200)->nullable();
            $table->string('section_title_dari', 200)->nullable();
            $table->string('section_title_pashto', 200)->nullable();
            
            $table->text('section_description_en')->nullable();
            $table->text('section_description_dari')->nullable();
            $table->text('section_description_pashto')->nullable();
            
            // Individual value cards (6 values as in your component)
            $table->string('icon_name', 50)->default('Shield'); // Lucide icon name
            $table->string('title_en', 100)->nullable();
            $table->string('title_dari', 100)->nullable();
            $table->string('title_pashto', 100)->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_dari')->nullable();
            $table->text('description_pashto')->nullable();
            
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
        Schema::dropIfExists('about_core_values');
    }
};
