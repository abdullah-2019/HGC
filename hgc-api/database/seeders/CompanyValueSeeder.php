<?php
// database/seeders/CompanyValueSeeder.php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyValues;
use Illuminate\Database\Seeder;

class CompanyValueSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $values = [
                [
                    'icon_name' => 'Shield',
                    'sort_order' => 1,
                    'title_en' => 'Integrity',
                    'title_dari' => 'صداقت',
                    'title_pashto' => 'صمیمیت',
                    'description_en' => 'We uphold the highest ethical standards in all our business dealings.',
                    'description_dari' => 'ما بالاترین معیارهای اخلاقی را در تمام معاملات تجاری خود رعایت می‌کنیم.',
                    'description_pashto' => 'موږ په خپلو ټولو سوداګریزو معاملاتو کې تر ټولو لوړ اخلاقي معیارونه ساتو.',
                ],
                [
                    'icon_name' => 'Handshake',
                    'sort_order' => 2,
                    'title_en' => 'Commitment',
                    'title_dari' => 'تعهد',
                    'title_pashto' => 'تعهد',
                    'description_en' => 'Dedicated to delivering on our promises with unwavering reliability.',
                    'description_dari' => 'متعهد به تحویل وعده‌های خود با قابلیت اعتماد بی‌چون و چرا.',
                    'description_pashto' => 'د خپلو ژمنو د پلي کولو لپاره د بې باورۍ اعتماد سره وقف شوي.',
                ],
                [
                    'icon_name' => 'Lightbulb',
                    'sort_order' => 3,
                    'title_en' => 'Innovation',
                    'title_dari' => 'نوآوری',
                    'title_pashto' => 'نوښت',
                    'description_en' => 'Continuously seeking new solutions to drive progress and growth.',
                    'description_dari' => 'به طور مداوم به دنبال راه‌حل‌های جدید برای پیشبرد پیشرفت و رشد هستیم.',
                    'description_pashto' => 'د پرمختګ او ودې لپاره تل نوي حلونه پلټو.',
                ],
                [
                    'icon_name' => 'Heart',
                    'sort_order' => 4,
                    'title_en' => 'Excellence',
                    'title_dari' => 'برتری',
                    'title_pashto' => 'بریا',
                    'description_en' => 'Striving for the highest quality in every project we undertake.',
                    'description_dari' => 'تلاش برای بالاترین کیفیت در هر پروژه‌ای که بر عهده می‌گیریم.',
                    'description_pashto' => 'په هره پروژه کې چې موږ یې پیل کوو د تر ټولو لوړ کیفیت لپاره هڅه کول.',
                ],
                [
                    'icon_name' => 'Scale',
                    'sort_order' => 5,
                    'title_en' => 'Accountability',
                    'title_dari' => 'پاسخگویی',
                    'title_pashto' => 'د ځواب ورکولو مسؤلیت',
                    'description_en' => 'Taking responsibility for our actions and their impact on society.',
                    'description_dari' => 'مسئولیت اقدامات خود و تأثیر آنها بر جامعه را بر عهده می‌گیریم.',
                    'description_pashto' => 'د خپلو کړنو او د هغوی د ټولنې پر اغیز مسؤلیت منو.',
                ],
                [
                    'icon_name' => 'Leaf',
                    'sort_order' => 6,
                    'title_en' => 'Sustainability',
                    'title_dari' => 'پایداری',
                    'title_pashto' => 'دوامداره والی',
                    'description_en' => 'Building a better future through responsible and sustainable practices.',
                    'description_dari' => 'ساختن آینده‌ای بهتر از طریق شیوه‌های مسئولانه و پایدار.',
                    'description_pashto' => 'د مسؤلانه او دوامداره کړنو له لارې غوره راتلونکې جوړول.',
                ],
            ];

            foreach ($values as $value) {
                CompanyValues::create(array_merge($value, ['company_id' => $company->id]));
            }
        }
    }
}