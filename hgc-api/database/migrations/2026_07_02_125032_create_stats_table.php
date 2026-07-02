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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('key', 50)->unique(); // e.g., 'years_experience'
            
            // Display values
            $table->integer('value')->default(0);
            $table->string('suffix', 10)->default(''); // '+', '%', etc.
            
            // i18n labels
            $table->string('label_en', 100);
            $table->string('label_dari', 100)->nullable();
            $table->string('label_pashto', 100)->nullable();
            
            // Icon from Lucide
            $table->string('icon_name', 50)->default('Building2');
            
            // Optional: link to company or global
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            
            // Display control
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            $table->timestamps();
            
            $table->index('key');
            $table->index('company_id');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
