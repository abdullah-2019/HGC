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
        Schema::create('project_milestones', function (Blueprint $table) {
           $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('title_en', 200);
            $table->string('title_dari', 200)->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_dari')->nullable();
            $table->date('milestone_date')->nullable();
            $table->integer('completion_percent')->nullable();
            $table->string('image_url', 255)->nullable();
            $table->timestamps();
            
            $table->index('project_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_milestones');
    }
};
