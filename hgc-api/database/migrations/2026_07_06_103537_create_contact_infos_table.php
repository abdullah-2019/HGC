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
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();

            // English (default)
            $table->string('address')->nullable();
            $table->string('phones')->nullable();
            $table->string('email')->nullable();
            $table->string('office_hours')->nullable();

            // Dari
            $table->string('address_dari')->nullable();
            $table->string('phones_dari')->nullable();
            $table->string('email_dari')->nullable();
            $table->string('office_hours_dari')->nullable();

            // Pashto
            $table->string('address_pashto')->nullable();
            $table->string('phones_pashto')->nullable();
            $table->string('email_pashto')->nullable();
            $table->string('office_hours_pashto')->nullable();

            // Social media (same across all languages)
            $table->string('facebook')->nullable();
            $table->string('x')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('telegram')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp')->nullable();

            // Map (same across all languages)
            $table->text('map_embed_url')->nullable();
            $table->decimal('map_lat', 10, 8)->nullable();
            $table->decimal('map_lng', 11, 8)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
