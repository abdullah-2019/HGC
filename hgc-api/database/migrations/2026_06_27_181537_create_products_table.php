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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            
            // Basic Info
            $table->string('name_en', 150);
            $table->string('name_dari', 150)->nullable();
            $table->string('name_pashto', 150)->nullable();
            $table->string('tagline_en', 255)->nullable();
            $table->string('tagline_dari', 255)->nullable();
            $table->string('tagline_pashto', 255)->nullable();
            
            // Rich Content (like MSG lead-ore page)
            $table->longText('overview_en')->nullable();
            $table->longText('overview_dari')->nullable();
            $table->longText('overview_pashto')->nullable();
            
            // Hero/Featured
            $table->string('hero_image_url', 255)->nullable();
            $table->string('thumbnail_url', 255)->nullable();
            
            // Categorization
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            
            // Product Details
            $table->string('origin', 100)->nullable();
            $table->string('grade', 100)->nullable();
            $table->string('purity', 50)->nullable();
            $table->json('specifications')->nullable(); // [{"label":"Size","value":"0-5mm"},...]
            
            // Pricing & Availability
            $table->string('price_range', 100)->nullable();
            $table->string('currency', 10)->default('AFN');
            $table->string('unit', 50)->nullable();
            $table->enum('availability', ['in_stock', 'limited', 'pre_order', 'out_of_stock'])->default('in_stock');
            
            // Applications & Packaging
            $table->json('applications')->nullable();
            $table->json('packaging')->nullable();
            $table->text('delivery_info')->nullable();
            
            // SEO
            $table->string('meta_title_en', 150)->nullable();
            $table->string('meta_desc_en', 300)->nullable();
            
            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            $table->timestamps();
            
            $table->index('slug');
            $table->index('is_featured');
            $table->index('is_active');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
