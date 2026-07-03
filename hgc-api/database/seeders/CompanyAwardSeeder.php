<?php
// database/seeders/CompanyAwardSeeder.php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyAwards;
use Illuminate\Database\Seeder;

class CompanyAwardSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();

        $awardTemplates = [
            // HCRC - Construction
            'hcrc' => [
                [
                    'icon_name' => 'Trophy',
                    'sort_order' => 1,
                    'award_year' => 2026,
                    'title_en' => 'Excellence in Infrastructure Development',
                    'title_dari' => 'برتری در توسعه زیربنا',
                    'title_pashto' => 'د بنسټیزو جوړښتونو پراختیا کې بریا',
                    'description_en' => 'Recognized for outstanding contributions to national infrastructure projects across Afghanistan.',
                    'description_dari' => 'به خاطر مشارکت برجسته در پروژه‌های زیربنایی ملی در سراسر افغانستان.',
                    'description_pashto' => 'د افغانستان په کچه د ملي بنسټیزو پروژو ته د ځانګړو ونډو په پام کې نیولو.',
                    'organization_en' => 'Ministry of Public Works',
                    'organization_dari' => 'وزارت کارهای عامه',
                    'organization_pashto' => 'د عامه کارونو وزارت',
                ],
                [
                    'icon_name' => 'Star',
                    'sort_order' => 2,
                    'award_year' => 2025,
                    'title_en' => 'Best Construction Company of the Year',
                    'title_dari' => 'بهترین شرکت ساختمانی سال',
                    'title_pashto' => 'د کال غوره جوړونې شرکت',
                    'description_en' => 'Awarded for delivering high-quality construction projects on time and within budget.',
                    'description_dari' => 'به خاطر تحویل پروژه‌های ساختمانی با کیفیت بالا در زمان و بودجه مقرر.',
                    'description_pashto' => 'د پوره وخت او بودجې په چوکاټ کې د لوړ کیفیت جوړونې پروژو د سپارلو لپاره.',
                    'organization_en' => 'Afghan Chamber of Commerce',
                    'organization_dari' => 'اتاق تجارت افغانستان',
                    'organization_pashto' => 'د افغانستان د سوداګرۍ خونه',
                ],
                [
                    'icon_name' => 'Medal',
                    'sort_order' => 3,
                    'award_year' => 2024,
                    'title_en' => 'Safety Excellence Award',
                    'title_dari' => 'جایزه برتری ایمنی',
                    'title_pashto' => 'د خوندیتوب د بریا جایزه',
                    'description_en' => 'Recognized for maintaining the highest safety standards across all project sites.',
                    'description_dari' => 'به خاطر حفظ استانداردهای ایمنی در سطح بالا در تمام محل‌های پروژه.',
                    'description_pashto' => 'د ټولو پروژو په ځایونو کې د خوندیتوب د لوړو معیارونو ساتلو لپاره.',
                    'organization_en' => 'National Safety Council',
                    'organization_dari' => 'شورای ملی ایمنی',
                    'organization_pashto' => 'د ملي خوندیتوب شورا',
                ],
                [
                    'icon_name' => 'Award',
                    'sort_order' => 4,
                    'award_year' => 2023,
                    'title_en' => 'Sustainable Building Innovation',
                    'title_dari' => 'نوآوری ساختمان پایدار',
                    'title_pashto' => 'د دوامداره ودانۍ نوښت',
                    'description_en' => 'Pioneering eco-friendly construction methods in Afghanistan.',
                    'description_dari' => 'پیشگامی در روش‌های ساختمان‌سازی سازگار با محیط زیست در افغانستان.',
                    'description_pashto' => 'د افغانستان کې د چاپیریال دوستانه جوړونې میتودونو کې مخکښوالی.',
                    'organization_en' => 'Green Afghanistan Initiative',
                    'organization_dari' => 'ابتکار سبز افغانستان',
                    'organization_pashto' => 'د سبز افغانستان ابتکار',
                ],
                [
                    'icon_name' => 'Trophy',
                    'sort_order' => 5,
                    'award_year' => 2022,
                    'title_en' => 'Community Development Champion',
                    'title_dari' => 'قهرمان توسعه اجتماعی',
                    'title_pashto' => 'د ټولنیزې پراختیا اتل',
                    'description_en' => 'For creating employment and training opportunities for local communities.',
                    'description_dari' => 'برای ایجاد فرصت‌های اشتغال و آموزش برای جوامع محلی.',
                    'description_pashto' => 'د سیمه ایزو ټولنو لپاره د دندو او روزنې فرصتونو رامنځته کولو لپاره.',
                    'organization_en' => 'Hafez Construction & Reconstruction Company',
                    'organization_dari' => 'شرکت ساخت و ساز حافظ',
                    'organization_pashto' => 'د حافظ جوړونې او بیا جوړونې شرکت',
                ],
            ],

            // Al Bahrain Mining
            'albahrain' => [
                [
                    'icon_name' => 'Gem',
                    'sort_order' => 1,
                    'award_year' => 2026,
                    'title_en' => 'Responsible Mining Excellence',
                    'title_dari' => 'برتری استخراج مسئولانه',
                    'title_pashto' => 'د مسؤلانه استخراج بریا',
                    'organization_en' => 'Afghan Mining Association',
                    'organization_dari' => 'انجمن معادن افغانستان',
                    'organization_pashto' => 'د افغانستان د کانونو ټولنه',
                ],
                [
                    'icon_name' => 'Mountain',
                    'sort_order' => 2,
                    'award_year' => 2025,
                    'title_en' => 'Environmental Stewardship Award',
                    'title_dari' => 'جایزه سرپرستی محیط زیست',
                    'title_pashto' => 'د چاپیریال ساتنې جایزه',
                    'organization_en' => 'National Environmental Agency',
                    'organization_dari' => 'اداره ملی محیط زیست',
                    'organization_pashto' => 'د ملي چاپیریال ادارې',
                ],
            ],

            // Zain Noorain Trading
            'zainnoorain' => [
                [
                    'icon_name' => 'Handshake',
                    'sort_order' => 1,
                    'award_year' => 2026,
                    'title_en' => 'Best Trading Partner',
                    'title_dari' => 'بهترین شریک تجارتی',
                    'title_pashto' => 'غوره سوداګریز شریک',
                    'organization_en' => 'International Trade Council',
                    'organization_dari' => 'شورای تجارت بین‌المللی',
                    'organization_pashto' => 'د نړیوالې سوداګرۍ شورا',
                ],
            ],

            // Al Madinah Supermarket
            'almadinah' => [
                [
                    'icon_name' => 'Store',
                    'sort_order' => 1,
                    'award_year' => 2026,
                    'title_en' => 'Customer Service Excellence',
                    'title_dari' => 'برتری خدمات مشتری',
                    'title_pashto' => 'د پیرودونکو خدماتو کې بریا',
                    'organization_en' => 'Retail Association of Afghanistan',
                    'organization_dari' => 'انجمن خرده‌فروشی افغانستان',
                    'organization_pashto' => 'د افغانستان د خرده پلور ټولنه',
                ],
            ],

            // Haramain Group
            'haramain' => [
                [
                    'icon_name' => 'Landmark',
                    'sort_order' => 1,
                    'award_year' => 2026,
                    'title_en' => 'Diversified Enterprise of the Year',
                    'title_dari' => 'مؤسسه متنوع سال',
                    'title_pashto' => 'د کال متنوع سازمان',
                    'organization_en' => 'Afghan Business Federation',
                    'organization_dari' => 'فدراسیون تجارت افغانستان',
                    'organization_pashto' => 'د افغانستان د سوداګرۍ فدراسیون',
                ],
            ],

            // Al Koozi Logistics
            'alkoozi' => [
                [
                    'icon_name' => 'Truck',
                    'sort_order' => 1,
                    'award_year' => 2026,
                    'title_en' => 'Logistics Innovation Award',
                    'title_dari' => 'جایزه نوآوری لجستیک',
                    'title_pashto' => 'د لوجستیک نوښت جایزه',
                    'organization_en' => 'Transport & Logistics Council',
                    'organization_dari' => 'شورای ترانسپورت و لجستیک',
                    'organization_pashto' => 'د ترانسپورټ او لوجستیک شورا',
                ],
            ],
        ];

        foreach ($companies as $company) {
            $templates = $awardTemplates[$company->slug] ?? [];

            foreach ($templates as $template) {
                CompanyAwards::create(array_merge($template, [
                    'company_id' => $company->id,
                ]));
            }
        }
    }
}