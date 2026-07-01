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
       Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 50)->unique();
            $table->string('name_en', 50);
            $table->string('name_dari', 50)->nullable();
            $table->string('name_pashto', 50)->nullable();
            $table->string('icon_name', 50)->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_dari')->nullable();
            $table->text('description_pashto')->nullable();
            $table->integer('projects_count')->default(0);
            $table->string('image_url', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectors');
    }
};
