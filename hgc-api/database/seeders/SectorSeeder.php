<?php
        
namespace Database\Seeders;
        
use App\Models\Sector;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectorSeeder extends Seeder
{
    public function run(): void
    {
        $sectors = [
            [
                'slug' => 'roads',
                'name_en' => 'Roads',
                'name_dari' => 'سرک ها',
                'name_pashto' => 'سړکونه',
                'icon_name' => 'Road',
                'description_en' => 'Construction and maintenance of highways, bridges, and urban roads across Afghanistan.',
                'description_dari' => 'ساخت و نگهداری بزرگراه‌ها، پل‌ها و سرک‌های شهری در سراسر افغانستان.',
                'description_pashto' => 'د لويې لارو، پلوونو او ښاري سړکونو جوړونه او ساتنه په افغانستان کې.',
                'projects_count' => 85,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'slug' => 'buildings',
                'name_en' => 'Buildings',
                'name_dari' => 'ساختمان ها',
                'name_pashto' => 'ودانۍ',
                'icon_name' => 'Home',
                'description_en' => 'Commercial, residential, and industrial building construction and renovation.',
                'description_dari' => 'ساخت و بازسازی ساختمان‌های تجاری، مسکونی و صنعتی.',
                'description_pashto' => 'د سوداګریزو، استوګنې او صنعتي ودانیو جوړونه او بیا رغونه.',
                'projects_count' => 62,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'slug' => 'mining',
                'name_en' => 'Mining',
                'name_dari' => 'معادن',
                'name_pashto' => 'کانونه',
                'icon_name' => 'Mountain',
                'description_en' => 'Responsible mineral extraction and mining operations contributing to national development.',
                'description_dari' => 'استخراج مسئولانه مواد معدنی و عملیات معدنکاری که به توسعه ملی کمک می‌کند.',
                'description_pashto' => 'د معدني موادو مسؤلانه استخراج او کان کیندنې عملیات چې د ملي پراختیا لپاره ګټور دي.',
                'projects_count' => 18,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'slug' => 'electrical',
                'name_en' => 'Electrical',
                'name_dari' => 'برق',
                'name_pashto' => 'بریښنا',
                'icon_name' => 'Zap',
                'description_en' => 'Power generation, transmission lines, and electrical infrastructure projects.',
                'description_dari' => 'تولید برق، خطوط انتقال و پروژه‌های زیرساختی برقی.',
                'description_pashto' => 'د بریښنا تولید، د لیږد کرښې او د بریښنا بنسټیزو جوړښتونو پروژې.',
                'projects_count' => 24,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'slug' => 'solar',
                'name_en' => 'Solar',
                'name_dari' => 'سولری',
                'name_pashto' => 'لمرنی',
                'icon_name' => 'Sun',
                'description_en' => 'Solar energy solutions including photovoltaic installations and solar farms.',
                'description_dari' => 'راه‌حل‌های انرژی خورشیدی شامل نصب فتوولتائیک و مزارع خورشیدی.',
                'description_pashto' => 'د لمر د انرژۍ حلونه چې د فوتوولټایک نصبول او د لمر فارمونه په کې شامل دي.',
                'projects_count' => 12,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'slug' => 'logistics',
                'name_en' => 'Logistics',
                'name_dari' => 'لوژستیک',
                'name_pashto' => 'لجستیک',
                'icon_name' => 'Truck',
                'description_en' => 'Transportation, warehousing, and supply chain management services.',
                'description_dari' => 'خدمات حمل و نقل، انبارداری و مدیریت زنجیره تأمین.',
                'description_pashto' => 'د لیږد، د ګودامونو او د عرضې زنځیر د مدیریت خدمات.',
                'projects_count' => 30,
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($sectors as $sector) {
            Sector::updateOrCreate(
                ['slug' => $sector['slug']],
                $sector
            );
        }
    }
}