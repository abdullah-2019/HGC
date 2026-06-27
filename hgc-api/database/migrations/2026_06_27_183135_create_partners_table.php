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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('full_name', 200)->nullable();
            $table->string('slug', 50)->unique()->nullable();
            $table->enum('type', ['un_agency', 'government', 'ngo', 'private', 'financial', 'development'])->default('government');
            $table->string('type_label_en', 50)->nullable();
            $table->string('type_label_dari', 50)->nullable();
            $table->string('logo_url', 255)->nullable();
            $table->string('website_url', 255)->nullable();
            $table->integer('projects_count')->default(0);
            $table->year('partnership_since')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_dari')->nullable();
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
        Schema::dropIfExists('partners');
    }
};
