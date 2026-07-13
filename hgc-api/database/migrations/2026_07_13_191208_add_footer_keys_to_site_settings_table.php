<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $keys = [
            // Brand description (for footer about text)
            ['setting_key' => 'brand_description_en', 'setting_value' => 'A leading conglomerate delivering excellence in construction, infrastructure, and development across Afghanistan since 2001.', 'setting_type' => 'string', 'description' => 'Brand description for footer'],
            ['setting_key' => 'brand_description_dari', 'setting_value' => 'یک گروپ پیشرو در ارائه excellence در ساخت، زیرساخت و توسعه در سراسر افغانستان از سال ۲۰۰۱.', 'setting_type' => 'string', 'description' => 'Brand description Dari'],
            ['setting_key' => 'brand_description_pashto', 'setting_value' => 'یو مخکښ ګروپ چې د ۲۰۰۱ کال راهیسې په افغانستان کې د جوړولو، بنسټیزه جوړښت او پراختیا کې وړتیا وړاندې کوي.', 'setting_type' => 'string', 'description' => 'Brand description Pashto'],

            // Copyright
            ['setting_key' => 'copyright_text_en', 'setting_value' => '© 2025 Hafez Group of Companies. All rights reserved.', 'setting_type' => 'string', 'description' => 'Copyright text English'],
            ['setting_key' => 'copyright_text_dari', 'setting_value' => '© ۲۰۲۵ گروپ شرکت‌های حافظ. تمام حقوق محفوظ است.', 'setting_type' => 'string', 'description' => 'Copyright text Dari'],
            ['setting_key' => 'copyright_text_pashto', 'setting_value' => '© ۲۰۲۵ د حافظ شرکتونو ګروپ. ټول حقوق خوندي دي.', 'setting_type' => 'string', 'description' => 'Copyright text Pashto'],

            // Privacy & Terms labels
            ['setting_key' => 'privacy_policy_label_en', 'setting_value' => 'Privacy Policy', 'setting_type' => 'string', 'description' => 'Privacy policy link text'],
            ['setting_key' => 'privacy_policy_label_dari', 'setting_value' => 'سیاست محرمیت', 'setting_type' => 'string', 'description' => 'Privacy policy Dari'],
            ['setting_key' => 'privacy_policy_label_pashto', 'setting_value' => 'د پټتیا تګلاره', 'setting_type' => 'string', 'description' => 'Privacy policy Pashto'],

            ['setting_key' => 'terms_label_en', 'setting_value' => 'Terms of Service', 'setting_type' => 'string', 'description' => 'Terms link text'],
            ['setting_key' => 'terms_label_dari', 'setting_value' => 'شرایط استفاده', 'setting_type' => 'string', 'description' => 'Terms Dari'],
            ['setting_key' => 'terms_label_pashto', 'setting_value' => 'د خدمت شرطونه', 'setting_type' => 'string', 'description' => 'Terms Pashto'],

            // Quick links / footer links as JSON
            ['setting_key' => 'footer_links', 'setting_value' => json_encode([
                ['label_en' => 'About', 'label_dari' => 'درباره ما', 'label_pashto' => 'زموږ په اړه', 'href' => '/about', 'sort_order' => 1],
                ['label_en' => 'Projects', 'label_dari' => 'پروژه‌ها', 'label_pashto' => 'پروژې', 'href' => '/projects', 'sort_order' => 2],
                ['label_en' => 'Products', 'label_dari' => 'محصولات', 'label_pashto' => 'محصولات', 'href' => '/products', 'sort_order' => 3],
                ['label_en' => 'Contact', 'label_dari' => 'تماس', 'label_pashto' => 'اړیکه', 'href' => '/contact', 'sort_order' => 4],
            ]), 'setting_type' => 'json', 'description' => 'Footer quick links'],

            // Social links as JSON (fallback if contact_infos table not available)
            ['setting_key' => 'social_links', 'setting_value' => json_encode([
                ['icon' => 'Globe', 'label' => 'Website', 'url' => 'https://hcrc-af.com', 'is_active' => true],
                ['icon' => 'Users', 'label' => 'Social', 'url' => '#', 'is_active' => true],
                ['icon' => 'MessageCircle', 'label' => 'WhatsApp', 'url' => 'https://wa.me/93711111694', 'is_active' => true],
                ['icon' => 'Mail', 'label' => 'Email', 'url' => 'mailto:info@hcrc-af.com', 'is_active' => true],
            ]), 'setting_type' => 'json', 'description' => 'Social media links'],
        ];

        foreach ($keys as $key) {
            DB::table('site_settings')->updateOrInsert(
                ['setting_key' => $key['setting_key']],
                $key + ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $keysToRemove = [
            'brand_description_en', 'brand_description_dari', 'brand_description_pashto',
            'copyright_text_en', 'copyright_text_dari', 'copyright_text_pashto',
            'privacy_policy_label_en', 'privacy_policy_label_dari', 'privacy_policy_label_pashto',
            'terms_label_en', 'terms_label_dari', 'terms_label_pashto',
            'footer_links', 'social_links',
        ];

        DB::table('site_settings')->whereIn('setting_key', $keysToRemove)->delete();
    }
};