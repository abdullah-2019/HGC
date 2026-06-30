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
            // Short name / abbreviation
            $table->string('short_name_en')->after('name_pashto');
            $table->string('short_name_dari')->nullable()->after('short_name_en');
            $table->string('short_name_pashto')->nullable()->after('short_name_dari');

            // Sector / Industry
            $table->string('sector_en')->after('description_pashto');
            $table->string('sector_dari')->nullable()->after('sector_en');
            $table->string('sector_pashto')->nullable()->after('sector_dari');

            // Branding alterations & new additions
            $table->string('accent_color')->default('#C9A227')->change(); 
            $table->string('icon_name')->default('Building2')->after('secondary_color');
            $table->string('hero_image_path')->nullable()->after('logo_url');
            // Note: your new blueprint uses logo_path instead of logo_url. 
            // If you wish to rename logo_url to logo_path, uncomment the line below (requires 'doctrine/dbal' package):
            // $table->renameColumn('logo_url', 'logo_path');

            // Contextual Address additions
            $table->string('address_en')->nullable()->after('address'); // Old address field remains intact
            $table->string('address_dari')->nullable()->after('address_en');
            $table->string('address_pashto')->nullable()->after('address_dari');

            // Location (for map)
            $table->decimal('latitude', 10, 8)->nullable()->after('address_pashto');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');

            // Social Media
            $table->string('facebook_url')->nullable()->after('website_url');
            $table->string('linkedin_url')->nullable()->after('facebook_url');
            $table->string('twitter_url')->nullable()->after('linkedin_url');
            $table->string('instagram_url')->nullable()->after('twitter_url');

            // Company Details
            // Note: website_url exists from previous migration. New uses 'website'.
            $table->string('website')->nullable()->after('instagram_url'); 
            $table->year('founded_year')->nullable()->after('established_year'); // Old established_year remains
            $table->string('registration_number')->nullable()->after('founded_year');
            $table->string('tax_id')->nullable()->after('registration_number');
            $table->integer('employee_count')->nullable()->after('tax_id');

            // Status & Display modifications
            // Note: sort_order exists from previous. New uses 'display_order'
            $table->integer('display_order')->default(0)->after('sort_order');
            $table->boolean('is_featured')->default(false)->after('display_order');

            // SEO
            $table->string('meta_title_en')->nullable()->after('is_featured');
            $table->string('meta_title_dari')->nullable()->after('meta_title_en');
            $table->string('meta_title_pashto')->nullable()->after('meta_title_dari');
            $table->text('meta_description_en')->nullable()->after('meta_title_pashto');
            $table->text('meta_description_dari')->nullable()->after('meta_description_en');
            $table->text('meta_description_pashto')->nullable()->after('meta_description_dari');

            // Long-form content (for company profile page)
            $table->longText('about_en')->nullable()->after('meta_description_pashto');
            $table->longText('about_dari')->nullable()->after('about_en');
            $table->longText('about_pashto')->nullable()->after('about_dari');

            $table->longText('mission_en')->nullable()->after('about_pashto');
            $table->longText('mission_dari')->nullable()->after('mission_en');
            $table->longText('mission_pashto')->nullable()->after('mission_dari');

            $table->longText('vision_en')->nullable()->after('mission_pashto');
            $table->longText('vision_dari')->nullable()->after('vision_en');
            $table->longText('vision_pashto')->nullable()->after('vision_dari');

            // Soft Deletes
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'short_name_en', 'short_name_dari', 'short_name_pashto',
                'sector_en', 'sector_dari', 'sector_pashto',
                'icon_name', 'hero_image_path',
                'address_en', 'address_dari', 'address_pashto',
                'latitude', 'longitude',
                'facebook_url', 'linkedin_url', 'twitter_url', 'instagram_url',
                'website', 'founded_year', 'registration_number', 'tax_id', 'employee_count',
                'display_order', 'is_featured',
                'meta_title_en', 'meta_title_dari', 'meta_title_pashto',
                'meta_description_en', 'meta_description_dari', 'meta_description_pashto',
                'about_en', 'about_dari', 'about_pashto',
                'mission_en', 'mission_dari', 'mission_pashto',
                'vision_en', 'vision_dari', 'vision_pashto'
            ]);

            $table->dropSoftDeletes();
        });
    }
};
