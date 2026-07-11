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
        Schema::create('about_mission_points', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('about_mission_id')->constrained('about_missions')->onDelete('cascade');
            
            $table->text('text_en')->nullable();
            $table->text('text_dari')->nullable();
            $table->text('text_pashto')->nullable();
            
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
        Schema::dropIfExists('about_mission_points');
    }
};
