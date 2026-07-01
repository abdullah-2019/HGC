<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');
        $companies = Company::pluck('id', 'slug');

        $products = [
            [
                'slug' => 'crushed-stone-aggregate',
                'name_en' => 'Crushed Stone Aggregate',
                'name_dari' => 'سنگدانه خرد شده',
                'name_pashto' => 'مات شوي ډبرې',
                'tagline_en' => 'High-quality construction aggregate from our own quarries',
                'tagline_dari' => 'سنگدانه با کیفیت بالا از معادن خود ما',
                'tagline_pashto' => 'د لوړ کیفیت جوړونې سنگدانه زموږ د خپلو کانونو څخه',
                'overview_en' => '<p>Premium crushed stone aggregate sourced directly from Hafez Group\'s own quarries across Afghanistan. Our aggregates meet international standards for construction and road building projects.</p><p>Available in multiple sizes and grades to suit any application from concrete mixing to road base layers.</p>',
                'category_slug' => 'mining',
                'company_slug' => 'albahrain',
                'origin' => 'Afghanistan',
                'grade' => 'A Grade',
                'purity' => '98%',
                'specifications' => [
                    ['label' => 'Size Range', 'value' => '0-5mm, 5-10mm, 10-20mm, 20-40mm'],
                    ['label' => 'Compressive Strength', 'value' => '≥ 200 MPa'],
                    ['label' => 'Water Absorption', 'value' => '≤ 2%'],
                    ['label' => 'Bulk Density', 'value' => '1.4-1.6 g/cm³'],
                ],
                'price_range' => '2,500 - 4,500',
                'currency' => 'AFN',
                'unit' => 'per ton',
                'availability' => 'in_stock',
                'applications' => ['Concrete production', 'Road base', 'Railway ballast', 'Drainage systems'],
                'packaging' => ['Bulk loose', '50kg bags', '1-ton jumbo bags'],
                'delivery_info' => 'Nationwide delivery within 48 hours. Bulk orders include free transport within Kabul province.',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'ready-mix-concrete',
                'name_en' => 'Ready-Mix Concrete',
                'name_dari' => 'بتن آماده',
                'name_pashto' => 'چمتو شوی کنکریټ',
                'tagline_en' => 'Premium concrete delivered to your site with guaranteed quality',
                'tagline_dari' => 'بتن با کیفیت به سایت شما تحویل داده می‌شود با کیفیت تضمین شده',
                'tagline_pashto' => 'د تضمین شوي کیفیت سره ستاسو په سایټ کې لوړ کیفیت کنکریټ تحویل شوی',
                'overview_en' => '<p>High-performance ready-mix concrete produced in our state-of-the-art batching plants. We deliver consistent quality with precise mix designs tailored to your project requirements.</p><p>Our fleet of mixer trucks ensures timely delivery to any location in Afghanistan.</p>',
                'category_slug' => 'construction',
                'company_slug' => 'hcrc',
                'origin' => 'Afghanistan',
                'grade' => 'M15 - M50',
                'purity' => null,
                'specifications' => [
                    ['label' => 'Grades Available', 'value' => 'M15, M20, M25, M30, M35, M40, M50'],
                    ['label' => 'Slump Range', 'value' => '50-200mm'],
                    ['label' => '28-Day Strength', 'value' => '15-50 MPa'],
                    ['label' => 'Max Aggregate Size', 'value' => '20mm, 40mm'],
                ],
                'price_range' => '8,000 - 15,000',
                'currency' => 'AFN',
                'unit' => 'per m³',
                'availability' => 'in_stock',
                'applications' => ['Building foundations', 'High-rise structures', 'Bridges', 'Road pavements'],
                'packaging' => ['Transit mixer delivery', 'On-site batching'],
                'delivery_info' => 'Same-day delivery available for Kabul. 24-hour advance booking required for other provinces.',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'slug' => 'bitumen-asphalt',
                'name_en' => 'Bitumen & Asphalt',
                'name_dari' => 'قیر و آسفالت',
                'name_pashto' => 'بیټومین او اسفالټ',
                'tagline_en' => 'Industrial-grade bitumen for highway and road surfacing',
                'tagline_dari' => 'قیر درجه صنعتی برای سطح سرک و بزرگراه',
                'tagline_pashto' => 'د سړک او لويې لارې د سطحې لپاره صنعتي درجې بیټومین',
                'overview_en' => '<p>Top-quality bitumen and asphalt products manufactured to international specifications. Ideal for highway construction, airport runways, and urban road networks.</p>',
                'category_slug' => 'roads',
                'company_slug' => 'hcrc',
                'origin' => 'Iran / UAE',
                'grade' => '60/70, 80/100',
                'purity' => null,
                'specifications' => [
                    ['label' => 'Penetration Grade', 'value' => '60/70, 80/100'],
                    ['label' => 'Softening Point', 'value' => '46-56°C'],
                    ['label' => 'Ductility', 'value' => '≥ 100 cm'],
                    ['label' => 'Flash Point', 'value' => '≥ 250°C'],
                ],
                'price_range' => '45,000 - 65,000',
                'currency' => 'AFN',
                'unit' => 'per ton',
                'availability' => 'in_stock',
                'applications' => ['Highway surfacing', 'Airport runways', 'Parking lots', 'Bridge decks'],
                'packaging' => ['Bulk in tankers', '185kg drums', '50kg pails'],
                'delivery_info' => 'Heated tanker delivery available. Minimum order: 5 tons.',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'slug' => 'solar-power-systems',
                'name_en' => 'Solar Power Systems',
                'name_dari' => 'سیستم های برق خورشیدی',
                'name_pashto' => 'د سولري برق سیسټمونه',
                'tagline_en' => 'Complete solar solutions from 5kW to 500kW capacity',
                'tagline_dari' => 'راه‌حل‌های کامل خورشیدی از ظرفیت ۵ کیلووات تا ۵۰۰ کیلووات',
                'tagline_pashto' => 'د ۵ کیلووات څخه تر ۵۰۰ کیلووات پورې بشپړ سولري حلونه',
                'overview_en' => '<p>Turnkey solar power solutions for residential, commercial, and industrial applications. We provide complete system design, installation, and maintenance services.</p><p>Our systems use Tier-1 solar panels with 25-year performance warranties.</p>',
                'category_slug' => 'energy',
                'company_slug' => 'zainnoorain',
                'origin' => 'China / Germany',
                'grade' => 'Tier-1',
                'purity' => null,
                'specifications' => [
                    ['label' => 'Capacity Range', 'value' => '5kW - 500kW'],
                    ['label' => 'Panel Efficiency', 'value' => '≥ 21%'],
                    ['label' => 'Inverter Type', 'value' => 'Hybrid / Grid-tie / Off-grid'],
                    ['label' => 'Battery Storage', 'value' => 'Lithium-ion, 5-200 kWh'],
                ],
                'price_range' => '150,000 - 5,000,000',
                'currency' => 'AFN',
                'unit' => 'per system',
                'availability' => 'pre_order',
                'applications' => ['Residential power', 'Commercial buildings', 'Industrial facilities', 'Remote telecom towers'],
                'packaging' => ['Complete kit with panels, inverter, batteries, mounting'],
                'delivery_info' => 'Installation within 2-4 weeks of order confirmation. Includes 2-year maintenance contract.',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'slug' => 'construction-equipment-rental',
                'name_en' => 'Construction Equipment Rental',
                'name_dari' => 'اجاره تجهیزات ساختمانی',
                'name_pashto' => 'د جوړونې تجهیزات کرایه',
                'tagline_en' => 'Modern machinery with trained operators and maintenance support',
                'tagline_dari' => 'ماشین‌آلات مدرن با اپراتورهای آموزش دیده و پشتیبانی نگهداری',
                'tagline_pashto' => 'د روزانه ماشین آلاتو سره د روزل شویو اپراتورونو او د ساتنې ملاتړ',
                'overview_en' => '<p>Comprehensive equipment rental fleet including excavators, bulldozers, cranes, concrete mixers, and more. All equipment comes with certified operators and full maintenance support.</p>',
                'category_slug' => 'equipment',
                'company_slug' => 'hcrc',
                'origin' => 'Japan / Korea',
                'grade' => null,
                'purity' => null,
                'specifications' => [
                    ['label' => 'Excavators', 'value' => '20-40 ton capacity'],
                    ['label' => 'Cranes', 'value' => '25-100 ton lifting'],
                    ['label' => 'Concrete Pumps', 'value' => 'Up to 42m boom'],
                    ['label' => 'Dump Trucks', 'value' => '20-30 ton payload'],
                ],
                'price_range' => '5,000 - 50,000',
                'currency' => 'AFN',
                'unit' => 'per day',
                'availability' => 'limited',
                'applications' => ['Building construction', 'Road projects', 'Mining operations', 'Demolition work'],
                'packaging' => null,
                'delivery_info' => 'Equipment delivered to site within 24 hours. Minimum rental: 7 days.',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'slug' => 'logistics-freight-services',
                'name_en' => 'Logistics & Freight Services',
                'name_dari' => 'خدمات لوژستیک و باربری',
                'name_pashto' => 'لوجستیکي او بار وړلو خدمات',
                'tagline_en' => 'End-to-end logistics across Afghanistan with real-time tracking',
                'tagline_dari' => 'لوژستیک end-to-end در سراسر افغانستان با ردیابی real-time',
                'tagline_pashto' => 'په افغانستان کې د real-time تعقیب سره end-to-end لوجستیک',
                'overview_en' => '<p>Full-service logistics solutions including warehousing, transportation, customs clearance, and supply chain management. Our nationwide network covers all 34 provinces.</p>',
                'category_slug' => 'logistics',
                'company_slug' => 'alkoozi',
                'origin' => 'Afghanistan',
                'grade' => null,
                'purity' => null,
                'specifications' => [
                    ['label' => 'Fleet Size', 'value' => '150+ vehicles'],
                    ['label' => 'Coverage', 'value' => 'All 34 provinces'],
                    ['label' => 'Warehousing', 'value' => '50,000+ m²'],
                    ['label' => 'Tracking', 'value' => 'GPS real-time'],
                ],
                'price_range' => 'Negotiable',
                'currency' => 'AFN',
                'unit' => 'per shipment',
                'availability' => 'in_stock',
                'applications' => ['Construction materials', 'Mining equipment', 'Commercial goods', 'Humanitarian cargo'],
                'packaging' => null,
                'delivery_info' => 'Express delivery: 24-48 hours. Standard: 3-5 days. Cold chain available for perishables.',
                'is_featured' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($products as $productData) {
            $categorySlug = $productData['category_slug'];
            $companySlug = $productData['company_slug'];
            
            unset($productData['category_slug'], $productData['company_slug']);
            
            $productData['category_id'] = $categories[$categorySlug] ?? null;
            $productData['company_id'] = $companies[$companySlug] ?? null;

            Product::updateOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );
        }
    }
}