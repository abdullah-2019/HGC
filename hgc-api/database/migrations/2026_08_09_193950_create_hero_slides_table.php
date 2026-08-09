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
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('ken_burns')->default('zoom-in');
            $table->string('badge_en');
            $table->string('badge_dari');
            $table->string('badge_pashto');
            $table->json('title_en');
            $table->json('title_dari');
            $table->json('title_pashto');
            $table->json('highlights_en')->nullable();
            $table->json('highlights_dari')->nullable();
            $table->json('highlights_pashto')->nullable();
            $table->text('subtitle_en');
            $table->text('subtitle_dari');
            $table->text('subtitle_pashto');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
