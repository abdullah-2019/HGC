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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->text('text_en');
            $table->text('text_dari')->nullable();
            $table->text('text_pashto')->nullable();
            $table->string('author_name_en', 100)->nullable();
            $table->string('author_name_dari', 100)->nullable();
            $table->string('author_role_en', 100)->nullable();
            $table->string('author_role_dari', 100)->nullable();
            $table->string('author_image_url', 255)->nullable();
            $table->string('company_logo_url', 255)->nullable();
            $table->tinyInteger('rating')->default(5);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index('is_active');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
