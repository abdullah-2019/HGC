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
        Schema::create('about_carousel_slides', function (Blueprint $table) {
            $table->id();
            
            $table->string('image_url')->nullable();
            $table->string('title_en', 200)->nullable();
            $table->string('title_dari', 200)->nullable();
            $table->string('title_pashto', 200)->nullable();
            $table->string('location_en', 100)->nullable();
            $table->string('location_dari', 100)->nullable();
            $table->string('location_pashto', 100)->nullable();
            
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
        Schema::dropIfExists('about_carousel_slides');
    }
};
