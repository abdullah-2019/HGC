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
        Schema::table('companies', function (Blueprint $table) {
            $table->text('value_en')->nullable()->after('vision_pashto');
            $table->text('value_dari')->nullable()->after('value_en');
            $table->text('value_pashto')->nullable()->after('value_dari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'value_en',
                'value_dari',
                'value_pashto'
            ]);
        });
    }
};
