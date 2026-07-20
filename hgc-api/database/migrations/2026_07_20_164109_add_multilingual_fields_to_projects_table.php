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
        Schema::table('projects', function (Blueprint $table) {
            // Province multilingual
            $table->string('province_en', 50)->nullable()->after('location_pashto');
            $table->string('province_dari', 50)->nullable()->after('province_en');
            $table->string('province_pashto', 50)->nullable()->after('province_dari');

            // Client name pashto
            $table->string('client_name_pashto', 150)->nullable()->after('client_name_dari');

            // SEO multilingual
            $table->string('meta_title_dari', 150)->nullable()->after('meta_desc_en');
            $table->string('meta_desc_dari', 300)->nullable()->after('meta_title_dari');
            $table->string('meta_title_pashto', 150)->nullable()->after('meta_desc_dari');
            $table->string('meta_desc_pashto', 300)->nullable()->after('meta_title_pashto');
        });

        // Migrate existing province data to province_en
        DB::table('projects')->whereNotNull('province')->update([
            'province_en' => DB::raw('province')
        ]);

        // Drop old province column
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('province');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('province', 50)->nullable()->after('location_pashto');

            $table->dropColumn([
                'province_en',
                'province_dari',
                'province_pashto',
                'client_name_pashto',
                'meta_title_dari',
                'meta_desc_dari',
                'meta_title_pashto',
                'meta_desc_pashto',
            ]);
        });
    }
};