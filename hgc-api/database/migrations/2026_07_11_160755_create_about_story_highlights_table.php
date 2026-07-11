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
        Schema::create('about_story_highlights', function (Blueprint $table) {
            $table->id();
            
            // Link to about_stories if you want multiple stories, or keep standalone
            $table->foreignId('about_story_id')->nullable()->constrained('about_stories')->onDelete('cascade');
            
            $table->string('icon_name', 50)->default('Building2'); // Lucide icon name
            $table->string('label_en', 100)->nullable();
            $table->string('label_dari', 100)->nullable();
            $table->string('label_pashto', 100)->nullable();
            $table->string('value_text', 50)->nullable(); // e.g. "6", "38+", "200+"
            
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
        Schema::dropIfExists('about_story_highlights');
    }
};
