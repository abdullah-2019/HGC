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
        Schema::create('events', function (Blueprint $table) {
           $table->id();
            $table->string('slug', 150)->unique();
            $table->string('title_en', 200);
            $table->string('title_dari', 200)->nullable();
            $table->string('title_pashto', 200)->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_dari')->nullable();
            $table->text('description_pashto')->nullable();
            $table->string('location_en', 255)->nullable();
            $table->string('location_dari', 255)->nullable();
            $table->string('location_pashto', 255)->nullable();
            $table->date('event_date');
            $table->string('event_time', 100)->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->boolean('is_published')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
