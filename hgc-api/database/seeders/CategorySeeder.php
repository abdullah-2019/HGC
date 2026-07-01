<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'slug' => 'mining',
                'name_en' => 'Mining',
                'name_dari' => 'استخراج معادن',
                'name_pashto' => 'د کانونو استخراج',
                'description_en' => 'Mineral extraction and mining products including crushed stone, marble, and ore.',
                'description_dari' => 'محصولات استخراج مواد معدنی و معدنکاری شامل سنگ خرد شده، مرمر و سنگ معدن.',
                'description_pashto' => 'د معدني موادو استخراج او د کانونو محصولات چې ماته ډبره، مرمر او سنگ شامل دي.',
                'icon_name' => 'Pickaxe',
                'type' => 'product',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'slug' => 'construction',
                'name_en' => 'Construction',
                'name_dari' => 'ساختمان',
                'name_pashto' => 'جوړونه',
                'description_en' => 'Construction materials including concrete, cement, steel, and building supplies.',
                'description_dari' => 'مواد ساختمانی شامل بتن، سیمان، فولاد و تجهیزات ساختمانی.',
                'description_pashto' => 'د جوړونې مواد چې کنکریټ، سیمنټ، پولاد او د ودانۍ تجهیزات شامل دي.',
                'icon_name' => 'Wrench',
                'type' => 'product',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'slug' => 'roads',
                'name_en' => 'Roads',
                'name_dari' => 'سرک',
                'name_pashto' => 'سړک',
                'description_en' => 'Road construction materials including bitumen, asphalt, and aggregates.',
                'description_dari' => 'مواد ساخت سرک شامل قیر، آسفالت و سنگدانه.',
                'description_pashto' => 'د سړک جوړونې مواد چې بیټومین، اسفالټ او سنگدانه شامل دي.',
                'icon_name' => 'Road',
                'type' => 'product',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'slug' => 'energy',
                'name_en' => 'Energy',
                'name_dari' => 'انرژی',
                'name_pashto' => 'انرژي',
                'description_en' => 'Energy solutions including solar power systems and electrical infrastructure.',
                'description_dari' => 'راه‌حل‌های انرژی شامل سیستم‌های برق خورشیدی و زیرساخت‌های برقی.',
                'description_pashto' => 'د انرژۍ حلونه چې د سولري برق سیسټمونه او د بریښنا بنسټیز جوړښتونه شامل دي.',
                'icon_name' => 'Sun',
                'type' => 'product',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'slug' => 'equipment',
                'name_en' => 'Equipment',
                'name_dari' => 'تجهیزات',
                'name_pashto' => 'تجهیزات',
                'description_en' => 'Construction machinery and equipment rental services.',
                'description_dari' => 'خدمات اجاره ماشین‌آلات و تجهیزات ساختمانی.',
                'description_pashto' => 'د جوړونې ماشین آلاتو او تجهیزاتو د کرایې خدمات.',
                'icon_name' => 'Hammer',
                'type' => 'both',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'slug' => 'logistics',
                'name_en' => 'Logistics',
                'name_dari' => 'لوژستیک',
                'name_pashto' => 'لوجستیک',
                'description_en' => 'Logistics and freight services including warehousing and transportation.',
                'description_dari' => 'خدمات لوژستیک و باربری شامل انبارداری و حمل و نقل.',
                'description_pashto' => 'لوجستیکي او بار وړلو خدمات چې د ګودامونو او لیږد خدمات شامل دي.',
                'icon_name' => 'Truck',
                'type' => 'both',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}