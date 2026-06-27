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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            
            $table->string('name_en', 200);
            $table->string('name_dari', 200)->nullable();
            $table->string('name_pashto', 200)->nullable();
            
            // Location
            $table->string('location_en', 100)->nullable();
            $table->string('location_dari', 100)->nullable();
            $table->string('location_pashto', 100)->nullable();
            $table->string('province', 50)->nullable();
            
            // Client
            $table->string('client_name_en', 150)->nullable();
            $table->string('client_name_dari', 150)->nullable();
            $table->string('client_logo_url', 255)->nullable();
            
            // Financial & Timeline
            $table->decimal('budget_amount', 15, 2)->nullable();
            $table->string('budget_currency', 10)->default('AFN');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('duration_text', 100)->nullable();
            
            // Categorization
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            
            // Content
            $table->longText('description_en')->nullable();
            $table->longText('description_dari')->nullable();
            $table->longText('description_pashto')->nullable();
            
            // Status
            $table->enum('status', ['ongoing', 'completed', 'planned', 'on_hold'])->default('ongoing');
            $table->integer('completion_percent')->default(0);
            
            // Media
            $table->string('cover_image_url', 255)->nullable();
            $table->json('gallery_images')->nullable();
            
            // SEO
            $table->string('meta_title_en', 150)->nullable();
            $table->string('meta_desc_en', 300)->nullable();
            
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            $table->timestamps();
            
            $table->index('slug');
            $table->index('status');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
