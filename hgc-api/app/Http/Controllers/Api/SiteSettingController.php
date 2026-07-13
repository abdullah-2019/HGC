<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class SiteSettingController extends Controller
{
    /**
     * GET /api/site-settings
     * Returns all site settings as a structured object for the footer/about/contact
     * Reads from site_settings (key-value) AND contact_infos tables
     */
    public function index(): JsonResponse
    {
        // 1. Fetch all site_settings as key-value map
        $settings = DB::table('site_settings')
            ->pluck('setting_value', 'setting_key')
            ->toArray();

        // 2. Fetch contact info (first row)
        $contact = DB::table('contact_infos')->first();

        // 3. Build structured response
        $data = [
            // ── Brand ──
            'brandTitleEn' => $settings['site_name_en'] ?? 'Hafez Group of Companies',
            'brandTitleDari' => $settings['site_name_dari'] ?? 'گروپ شرکت‌های حافظ',
            'brandTitlePashto' => $settings['site_name_pashto'] ?? 'د حافظ شرکتونو ګروپ',
            'brandSubtitleEn' => $settings['site_tagline_en'] ?? "Building Afghanistan's Future",
            'brandSubtitleDari' => $settings['site_tagline_dari'] ?? 'ساختن آینده افغانستان',
            'brandSubtitlePashto' => $settings['site_tagline_pashto'] ?? 'د افغانستان راتلونکی جوړول',
            'brandDescEn' => $settings['brand_description_en'] ?? 'A leading conglomerate delivering excellence in construction, infrastructure, and development across Afghanistan since 2001.',
            'brandDescDari' => $settings['brand_description_dari'] ?? null,
            'brandDescPashto' => $settings['brand_description_pashto'] ?? null,

            // ── Contact (from contact_infos table) ──
            'officeLabelEn' => 'Kabul Office',
            'officeLabelDari' => 'دفتر کابل',
            'officeLabelPashto' => 'د کابل دفتر',
            'addressEn' => $contact->address ?? 'Kabul, Afghanistan',
            'addressDari' => $contact->address_dari ?? null,
            'addressPashto' => $contact->address_pashto ?? null,
            'phoneLabelEn' => 'Phone',
            'phoneLabelDari' => 'تلفن',
            'phoneLabelPashto' => 'تلیفون',
            'phonePrimary' => $contact->phones ?? $settings['contact_phone'] ?? '+93 (0) 711 111 694',
            'phoneSecondary' => null, // contact_infos has single phones field
            'emailLabelEn' => 'Email',
            'emailLabelDari' => 'ایمیل',
            'emailLabelPashto' => 'بریښنالیک',
            'emailAddress' => $contact->email ?? $settings['contact_email'] ?? 'info@hgc.af',

            // ── Social Links (from contact_infos social fields) ──
            'socialLinks' => $this->buildSocialLinks($contact, $settings),

            // ── Footer Links (from site_settings JSON) ──
            'footerLinks' => $this->parseJsonSetting($settings['footer_links'] ?? null, $this->defaultFooterLinks()),

            // ── Copyright ──
            'copyrightEn' => $settings['copyright_text_en'] ?? '© 2025 Hafez Group of Companies. All rights reserved.',
            'copyrightDari' => $settings['copyright_text_dari'] ?? null,
            'copyrightPashto' => $settings['copyright_text_pashto'] ?? null,
            'privacyTextEn' => $settings['privacy_policy_label_en'] ?? 'Privacy Policy',
            'privacyTextDari' => $settings['privacy_policy_label_dari'] ?? null,
            'privacyTextPashto' => $settings['privacy_policy_label_pashto'] ?? null,
            'termsTextEn' => $settings['terms_label_en'] ?? 'Terms of Service',
            'termsTextDari' => $settings['terms_label_dari'] ?? null,
            'termsTextPashto' => $settings['terms_label_pashto'] ?? null,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Build social links from contact_infos social fields
     */
    private function buildSocialLinks(?object $contact, array $settings): array
    {
        $links = [];

        $socialMap = [
            'website' => ['icon' => 'Globe', 'label' => 'Website'],
            'facebook' => ['icon' => 'Facebook', 'label' => 'Facebook'],
            'x' => ['icon' => 'Twitter', 'label' => 'X/Twitter'],
            'linkedin' => ['icon' => 'Linkedin', 'label' => 'LinkedIn'],
            'telegram' => ['icon' => 'Send', 'label' => 'Telegram'],
            'instagram' => ['icon' => 'Instagram', 'label' => 'Instagram'],
            'youtube' => ['icon' => 'Youtube', 'label' => 'YouTube'],
            'whatsapp' => ['icon' => 'MessageCircle', 'label' => 'WhatsApp'],
        ];

        if ($contact) {
            foreach ($socialMap as $field => $config) {
                $url = $contact->$field ?? null;
                if ($url) {
                    $links[] = [
                        'icon' => $config['icon'],
                        'label' => $config['label'],
                        'url' => $url,
                        'is_active' => true,
                    ];
                }
            }
        }

        // Fallback: if no contact_infos social data, use site_settings social_links JSON
        if (empty($links)) {
            $links = $this->parseJsonSetting($settings['social_links'] ?? null, $this->defaultSocialLinks());
        }

        return $links;
    }

    /**
     * Safely parse JSON setting
     */
    private function parseJsonSetting(?string $value, array $fallback): array
    {
        if (!$value) return $fallback;
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : $fallback;
    }

    private function defaultSocialLinks(): array
    {
        return [
            ['icon' => 'Globe', 'label' => 'Website', 'url' => 'https://hcrc-af.com', 'is_active' => true],
            ['icon' => 'Users', 'label' => 'Social', 'url' => '#', 'is_active' => true],
            ['icon' => 'MessageCircle', 'label' => 'WhatsApp', 'url' => 'https://wa.me/93711111694', 'is_active' => true],
            ['icon' => 'Mail', 'label' => 'Email', 'url' => 'mailto:info@hcrc-af.com', 'is_active' => true],
        ];
    }

    private function defaultFooterLinks(): array
    {
        return [
            ['label_en' => 'About', 'label_dari' => 'درباره ما', 'label_pashto' => 'زموږ په اړه', 'href' => '/about', 'sort_order' => 1],
            ['label_en' => 'Projects', 'label_dari' => 'پروژه‌ها', 'label_pashto' => 'پروژې', 'href' => '/projects', 'sort_order' => 2],
            ['label_en' => 'Products', 'label_dari' => 'محصولات', 'label_pashto' => 'محصولات', 'href' => '/products', 'sort_order' => 3],
            ['label_en' => 'Contact', 'label_dari' => 'تماس', 'label_pashto' => 'اړیکه', 'href' => '/contact', 'sort_order' => 4],
        ];
    }
}