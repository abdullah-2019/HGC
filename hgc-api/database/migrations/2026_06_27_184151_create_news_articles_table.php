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
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 150)->unique();
            $table->string('title_en', 200);
            $table->string('title_dari', 200)->nullable();
            $table->string('title_pashto', 200)->nullable();
            $table->text('excerpt_en')->nullable();
            $table->text('excerpt_dari')->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_dari')->nullable();
            $table->string('cover_image_url', 255)->nullable();
            $table->string('author_name', 100)->nullable();
            $table->enum('category', ['news', 'project_update', 'award', 'partnership', 'csr'])->default('news');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
            
            $table->index('slug');
            $table->index(['is_published', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
