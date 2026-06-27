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
        Schema::create('companies', function (Blueprint $table) {
           $table->id();
            $table->string('slug', 50)->unique();
            $table->string('name_en', 100);
            $table->string('name_dari', 100)->nullable();
            $table->string('name_pashto', 100)->nullable();
            
            // Branding
            $table->string('accent_color', 7);
            $table->string('secondary_color', 7)->nullable();
            $table->string('logo_url', 255)->nullable();
            
            // Content
            $table->string('tagline_en', 255)->nullable();
            $table->string('tagline_dari', 255)->nullable();
            $table->string('tagline_pashto', 255)->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_dari')->nullable();
            $table->text('description_pashto')->nullable();
            
            // Contact
            $table->string('email', 100)->nullable();
            $table->string('phone', 50)->nullable();
            $table->text('address')->nullable();
            
            // Meta
            $table->string('website_url', 255)->nullable();
            $table->year('established_year')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            $table->timestamps();
            
            $table->index('slug');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
