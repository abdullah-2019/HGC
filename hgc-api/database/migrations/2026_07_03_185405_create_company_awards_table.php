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
        Schema::create('company_awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('icon_name')->nullable(); // lucide icon name
            $table->integer('sort_order')->default(0);
            $table->year('award_year')->nullable();
            $table->string('title_en');
            $table->string('title_dari')->nullable();
            $table->string('title_pashto')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_dari')->nullable();
            $table->text('description_pashto')->nullable();
            $table->string('organization_en')->nullable();
            $table->string('organization_dari')->nullable();
            $table->string('organization_pashto')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['company_id', 'is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_awards');
    }
};
