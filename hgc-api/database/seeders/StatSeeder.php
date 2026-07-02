<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            [
                'key' => 'years_experience',
                'value' => 24,
                'suffix' => '+',
                'label_en' => 'Years of Experience',
                'label_dari' => 'سال تجربه',
                'label_pashto' => 'د تجربې کالونه',
                'icon_name' => 'Clock',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'projects_completed',
                'value' => 200,
                'suffix' => '+',
                'label_en' => 'Projects Completed',
                'label_dari' => 'پروژه تکمیل شده',
                'label_pashto' => 'بشپړ شوي پروژې',
                'icon_name' => 'Briefcase',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'provinces_covered',
                'value' => 38,
                'suffix' => '+',
                'label_en' => 'Provinces Covered',
                'label_dari' => 'ولایت تحت پوشش',
                'label_pashto' => 'پوښل شوي ولایتونه',
                'icon_name' => 'MapPin',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'companies_in_group',
                'value' => 6,
                'suffix' => '',
                'label_en' => 'Companies in Group',
                'label_dari' => 'شرکت در گروپ',
                'label_pashto' => 'شرکتونه په ګروپ کې',
                'icon_name' => 'Building2',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            Stat::updateOrCreate(
                ['key' => $stat['key']],
                $stat
            );
        }
    }
}