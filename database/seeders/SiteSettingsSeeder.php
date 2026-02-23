<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_title',
                'label' => 'Site Title',
                'value' => 'PT Kayaba Indonesia',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_description',
                'label' => 'Site Description',
                'value' => 'Leading Manufacturer of Shock Absorbers & Hydraulic Equipment. Member of Astra Otoparts & KYB Corporation Japan.',
                'type' => 'textarea',
                'group' => 'general',
            ],
            [
                'key' => 'site_logo',
                'label' => 'Site Logo',
                'value' => null, // User can upload later
                'type' => 'file',
                'group' => 'general',
            ],
            [
                'key' => 'site_favicon',
                'label' => 'Site Favicon',
                'value' => null, // User can upload later
                'type' => 'file',
                'group' => 'general',
            ],
            
            // Contact Info (for Footer/Global use)
            [
                'key' => 'contact_address',
                'label' => 'Contact Address',
                'value' => "Jl. Jawa No.4, Blok II, Jatiwangi\nCikarang Barat, Bekasi 17530\nIndonesia",
                'type' => 'textarea',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_phone',
                'label' => 'Contact Phone',
                'value' => '+62 21 8981456',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_email',
                'label' => 'Contact Email',
                'value' => 'info@kyb.astra.co.id',
                'type' => 'email',
                'group' => 'contact',
            ],

            // Social Media
            [
                'key' => 'social_facebook',
                'label' => 'Facebook URL',
                'value' => '#',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_instagram',
                'label' => 'Instagram URL',
                'value' => '#',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_youtube',
                'label' => 'YouTube URL',
                'value' => '#',
                'type' => 'url',
                'group' => 'social',
            ],

            // SEO & Meta
            [
                'key' => 'meta_keywords',
                'label' => 'Meta Keywords',
                'value' => 'shock absorber, kyb, astra otoparts, hydraulic equipment, otomotif, sparepart',
                'type' => 'textarea',
                'group' => 'seo',
            ],
            [
                'key' => 'meta_description',
                'label' => 'Meta Description',
                'value' => 'PT Kayaba Indonesia is a leading manufacturer of Shock Absorbers & Hydraulic Equipment in Indonesia.',
                'type' => 'textarea',
                'group' => 'seo',
            ],
            [
                'key' => 'google_analytics',
                'label' => 'Google Analytics ID (G-XXXXX)',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
            ],

            // Maintenance
            [
                'key' => 'maintenance_mode',
                'label' => 'Maintenance Mode (1=On, 0=Off)',
                'value' => '0',
                'type' => 'number',
                'group' => 'maintenance',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
