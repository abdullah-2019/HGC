<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'image' => '/images/hero-construction.webp',
                'ken_burns' => 'zoom-in',
                'badge_en' => 'Since 2001 — Building Afghanistan\'s Future',
                'badge_dari' => 'از سال ۲۰۰۱ — ساختن آینده افغانستان',
                'badge_pashto' => 'له ۲۰۰۱ کال راهیسې — د افغانستان راتلونکی جوړول',
                'title_en' => ['Building ', 'Afghanistan\'s', 'Future'],
                'title_dari' => ['', 'آینده', ' افغانستان', 'را می سازیم'],
                'title_pashto' => ['د ', 'افغانستان', '', 'راتلونکی جوړوو'],
                'highlights_en' => [1],
                'highlights_dari' => [1],
                'highlights_pashto' => [1],
                'subtitle_en' => 'Construction • Mining • Logistics • Financial Services — driving national development across 38+ provinces.',
                'subtitle_dari' => 'ساختمان • استخراج معادن • لوژستیک • خدمات مالی — توسعه ملی در ۳۸+ ولایت.',
                'subtitle_pashto' => 'ودانۍ • د کانونو استخراج • لوجستیک • مالي خدمات — ملي پراختیا په ۳۸+ ولایتونو کې.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'image' => '/images/contact-hero.webp',
                'ken_burns' => 'pan-right',
                'badge_en' => 'Responsible Mining Operations',
                'badge_dari' => 'عملیات مسئولانه استخراج معادن',
                'badge_pashto' => 'د مسؤلانه کانونو استخراج عملیات',
                'title_en' => ['Extracting ', 'Value', 'From the Earth'],
                'title_dari' => ['استخراج ', 'ارزش', 'از زمین'],
                'title_pashto' => ['د ځمکې څخه ', 'ارزښت', ' استخراج'],
                'highlights_en' => [1],
                'highlights_dari' => [1],
                'highlights_pashto' => [1],
                'subtitle_en' => 'Sustainable mineral extraction powering Afghanistan\'s industrial growth and lasting economic impact.',
                'subtitle_dari' => 'استخراج پایدار مواد معدنی که رشد صنعتی افغانستان را تقویت می‌کند.',
                'subtitle_pashto' => 'د معدني موادو دوامداره استخراج چې د افغانستان صنعتي وده ځواکمنوي.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'image' => '/images/hero-logistics.webp',
                'ken_burns' => 'zoom-out',
                'badge_en' => 'Nationwide Logistics Network',
                'badge_dari' => 'شبکه لوژستیک سراسری',
                'badge_pashto' => 'د ټول هیواد لوجستیک شبکه',
                'title_en' => ['Connecting ', 'Every', 'Province'],
                'title_dari' => ['اتصال ', 'هر', 'ولایت'],
                'title_pashto' => ['د ', 'هر', 'ولایت نښلول'],
                'highlights_en' => [1],
                'highlights_dari' => [1],
                'highlights_pashto' => [1],
                'subtitle_en' => 'Reliable transportation and supply chain solutions delivering across all 38+ provinces of Afghanistan.',
                'subtitle_dari' => 'حمل و نقل و زنجیره تأمین قابل اعتماد در سراسر ۳۸+ ولایت افغانستان.',
                'subtitle_pashto' => 'د باوري لیږد او عرضې زنځیر حلونه په ټولو ۳۸+ ولایتونو کې.',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }
    }
}