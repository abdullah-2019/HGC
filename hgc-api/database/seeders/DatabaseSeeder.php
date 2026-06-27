<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Companies
        DB::table('companies')->insert([
            [
                'slug' => 'hcrc',
                'name_en' => 'Hafez Construction & Road Company',
                'name_dari' => 'شرکت ساختمانی و سرک حافظ',
                'accent_color' => '#B22222',
                'tagline_en' => 'Building Afghanistan Infrastructure',
                'established_year' => 2001,
                'sort_order' => 1,
            ],
            [
                'slug' => 'albahrain',
                'name_en' => 'Al-Bahrain Mining Company',
                'name_dari' => 'شرکت استخراج معادن البحرین',
                'accent_color' => '#1A237E',
                'tagline_en' => 'Mineral Solutions for Global Markets',
                'established_year' => 2005,
                'sort_order' => 2,
            ],
            [
                'slug' => 'zainnoorain',
                'name_en' => 'Zain Noorain Construction',
                'name_dari' => 'شرکت ساختمانی زین نورین',
                'accent_color' => '#F57C00',
                'tagline_en' => 'Quality Construction Services',
                'established_year' => 2008,
                'sort_order' => 3,
            ],
            [
                'slug' => 'almadinah',
                'name_en' => 'Al-Madinah General Trading',
                'name_dari' => 'تجارت عمومی المدینه',
                'accent_color' => '#2E7D32',
                'tagline_en' => 'Trusted Local & International Markets',
                'established_year' => 2010,
                'sort_order' => 4,
            ],
            [
                'slug' => 'haramain',
                'name_en' => 'Haramain Financial Services',
                'name_dari' => 'خدمات مالی حرمین',
                'accent_color' => '#FFD700',
                'tagline_en' => 'Financial Solutions for Growth',
                'established_year' => 2012,
                'sort_order' => 5,
            ],
            [
                'slug' => 'alkoozi',
                'name_en' => 'Al-Koozi Logistics & Transport',
                'name_dari' => 'لوجستیک و ترانسپورت الکوزی',
                'accent_color' => '#00838F',
                'tagline_en' => 'Reliable Nationwide Delivery',
                'established_year' => 2015,
                'sort_order' => 6,
            ],
        ]);

        // Categories
        DB::table('categories')->insert([
            ['slug' => 'mining', 'name_en' => 'Mining', 'name_dari' => 'استخراج معادن', 'icon_name' => 'Mountain', 'type' => 'both', 'sort_order' => 1],
            ['slug' => 'construction', 'name_en' => 'Construction', 'name_dari' => 'ساختمان', 'icon_name' => 'Building2', 'type' => 'both', 'sort_order' => 2],
            ['slug' => 'roads', 'name_en' => 'Roads', 'name_dari' => 'سرک', 'icon_name' => 'Road', 'type' => 'both', 'sort_order' => 3],
            ['slug' => 'energy', 'name_en' => 'Energy', 'name_dari' => 'انرژی', 'icon_name' => 'Zap', 'type' => 'both', 'sort_order' => 4],
            ['slug' => 'solar', 'name_en' => 'Solar', 'name_dari' => 'سولری', 'icon_name' => 'Sun', 'type' => 'both', 'sort_order' => 5],
            ['slug' => 'logistics', 'name_en' => 'Logistics', 'name_dari' => 'لوژستیک', 'icon_name' => 'Truck', 'type' => 'both', 'sort_order' => 6],
            ['slug' => 'equipment', 'name_en' => 'Equipment', 'name_dari' => 'تجهیزات', 'icon_name' => 'Wrench', 'type' => 'product', 'sort_order' => 7],
        ]);

        // Sectors
        DB::table('sectors')->insert([
            ['slug' => 'roads', 'name_en' => 'Roads', 'name_dari' => 'سرک ها', 'icon_name' => 'Road', 'projects_count' => 85, 'sort_order' => 1],
            ['slug' => 'buildings', 'name_en' => 'Buildings', 'name_dari' => 'ساختمان ها', 'icon_name' => 'Home', 'projects_count' => 62, 'sort_order' => 2],
            ['slug' => 'mining', 'name_en' => 'Mining', 'name_dari' => 'معادن', 'icon_name' => 'Mountain', 'projects_count' => 18, 'sort_order' => 3],
            ['slug' => 'electrical', 'name_en' => 'Electrical', 'name_dari' => 'برق', 'icon_name' => 'Zap', 'projects_count' => 24, 'sort_order' => 4],
            ['slug' => 'solar', 'name_en' => 'Solar', 'name_dari' => 'سولری', 'icon_name' => 'Sun', 'projects_count' => 12, 'sort_order' => 5],
            ['slug' => 'logistics', 'name_en' => 'Logistics', 'name_dari' => 'لوژستیک', 'icon_name' => 'Truck', 'projects_count' => 30, 'sort_order' => 6],
        ]);

        // Partners
        DB::table('partners')->insert([
            [
                'name' => 'UNOPS',
                'full_name' => 'United Nations Office for Project Services',
                'slug' => 'unops',
                'type' => 'un_agency',
                'type_label_en' => 'Development Partner',
                'type_label_dari' => 'شریک توسعه',
                'projects_count' => 45,
                'partnership_since' => 2008,
                'description_en' => 'Long-term partnership supporting infrastructure development and humanitarian projects across Afghanistan.',
                'sort_order' => 1,
            ],
            [
                'name' => 'World Bank',
                'full_name' => 'World Bank Group',
                'slug' => 'world-bank',
                'type' => 'financial',
                'type_label_en' => 'Financial Partner',
                'type_label_dari' => 'شریک مالی',
                'projects_count' => 32,
                'partnership_since' => 2010,
                'description_en' => 'Collaboration on major road rehabilitation and public infrastructure projects funded by international development grants.',
                'sort_order' => 2,
            ],
            [
                'name' => 'USACE',
                'full_name' => 'U.S. Army Corps of Engineers',
                'slug' => 'usace',
                'type' => 'government',
                'type_label_en' => 'Government Partner',
                'type_label_dari' => 'شریک دولتی',
                'projects_count' => 28,
                'partnership_since' => 2005,
                'description_en' => 'Strategic partnership for construction and engineering projects supporting stabilization and reconstruction efforts.',
                'sort_order' => 3,
            ],
            [
                'name' => 'UNICEF',
                'full_name' => 'United Nations Children\'s Fund',
                'slug' => 'unicef',
                'type' => 'un_agency',
                'type_label_en' => 'UN Agency',
                'type_label_dari' => 'سازمان ملل',
                'projects_count' => 18,
                'partnership_since' => 2012,
                'description_en' => 'Partnership focused on building schools, health facilities, and water infrastructure for communities in need.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Ministry of Public Works',
                'full_name' => 'Islamic Republic of Afghanistan',
                'slug' => 'mpw',
                'type' => 'government',
                'type_label_en' => 'Government',
                'type_label_dari' => 'دولت',
                'projects_count' => 85,
                'partnership_since' => 2001,
                'description_en' => 'Primary government partner for national highway construction, bridge building, and road maintenance contracts.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Ministry of Interior',
                'full_name' => 'Islamic Republic of Afghanistan',
                'slug' => 'moi',
                'type' => 'government',
                'type_label_en' => 'Government',
                'type_label_dari' => 'دولت',
                'projects_count' => 42,
                'partnership_since' => 2003,
                'description_en' => 'Collaboration on police headquarters, border facilities, and security infrastructure projects nationwide.',
                'sort_order' => 6,
            ],
        ]);

        // Site Settings
        DB::table('site_settings')->insert([
            ['setting_key' => 'site_name_en', 'setting_value' => 'Hafez Group of Companies', 'setting_type' => 'string', 'description' => 'Website name in English'],
            ['setting_key' => 'site_name_dari', 'setting_value' => 'گروپ کمپنی های حافظ', 'setting_type' => 'string', 'description' => 'Website name in Dari'],
            ['setting_key' => 'site_tagline_en', 'setting_value' => 'Building Afghanistan\'s Future', 'setting_type' => 'string', 'description' => 'Main tagline'],
            ['setting_key' => 'contact_email', 'setting_value' => 'info@hgc.af', 'setting_type' => 'string', 'description' => 'Primary contact email'],
            ['setting_key' => 'contact_phone', 'setting_value' => '+93 71 111 1694', 'setting_type' => 'string', 'description' => 'Primary contact phone'],
            ['setting_key' => 'contact_address', 'setting_value' => 'Kabul, Afghanistan', 'setting_type' => 'string', 'description' => 'Office address'],
            ['setting_key' => 'seo_default_title', 'setting_value' => 'Hafez Group of Companies | Construction, Mining, Logistics', 'setting_type' => 'string', 'description' => 'Default meta title'],
            ['setting_key' => 'seo_default_description', 'setting_value' => 'Leading Afghan conglomerate since 2001. Construction, mining, logistics & financial services across 38+ provinces.', 'setting_type' => 'string', 'description' => 'Default meta description'],
        ]);
    }
}