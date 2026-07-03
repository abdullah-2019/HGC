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
        Schema::create('company_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('icon_name', 50); // e.g., 'Shield', 'Handshake', 'Lightbulb'
            $table->integer('sort_order')->default(0);
            
            // Translatable content
            $table->string('title_en', 100);
            $table->string('title_dari', 100)->nullable();
            $table->string('title_pashto', 100)->nullable();
            
            $table->text('description_en');
            $table->text('description_dari')->nullable();
            $table->text('description_pashto')->nullable();
            
            $table->timestamps();
            
            $table->unique(['company_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_values');
    }
};
