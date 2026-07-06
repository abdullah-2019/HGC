<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    public function run(): void
    {
        ContactInfo::create([
            // English
            'address' => 'Share-Now, Old Taimani, Street No 3, Kabul, Afghanistan',
            'phones' => '+93 (0) 711 111 694',
            'email' => 'info@hgc.af',
            'office_hours' => 'Saturday - Thursday, 8:00 AM - 5:00 PM',
            // Dari
            'address_dari' => 'شیرنو، تایمانی قدیم، کوچه ۳، کابل، افغانستان',
            'phones_dari' => '+۹۳ (۰) ۷۱۱ ۱۱۱ ۶۹۴',
            'email_dari' => 'info@hgc.af',
            'office_hours_dari' => 'شنبه تا پنجشنبه، ۸:۰۰ صبح تا ۵:۰۰ بعد از ظهر',
            // Pashto
            'address_pashto' => 'شیرنو، زوړ تایماني، کوڅه ۳، کابل، افغانستان',
            'phones_pashto' => '+۹۳ (۰) ۷۱۱ ۱۱۱ ۶۹۴',
            'email_pashto' => 'info@hgc.af',
            'office_hours_pashto' => 'شنبه تر پنجشنبه، سهار ۸:۰۰ تر ماسپخین ۵:۰۰',
            // Social
            'facebook' => 'https://facebook.com/hgc',
            'x' => null,
            'linkedin' => null,
            'telegram' => 'https://t.me/hgc',
            'instagram' => 'https://instagram.com/hgc',
            'youtube' => null,
            'whatsapp' => null,
            // Map
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3286.0!2d69.1760!3d34.5320!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzTCsDMxJzU1LjIiTiA2OcKwMTAnMzMuNiJF!5e0!3m2!1sen!2s!4v1',
            'map_lat' => 34.5320,
            'map_lng' => 69.1760,
        ]);
    }
}