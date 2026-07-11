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
        Schema::create('about_vision_pillars', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('about_vision_id')->constrained('about_visions')->onDelete('cascade');
            
            $table->string('icon_name', 50)->default('Compass'); // Lucide icon name
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
        Schema::dropIfExists('about_vision_pillars');
    }
};
