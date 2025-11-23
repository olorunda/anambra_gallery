<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Site identity settings
            [
                'key' => 'site.name',
                'value' => 'Anambra State Information Portal',
                'type' => 'text',
                'group' => 'general',
                'description' => 'The main site name displayed across the application'
            ],
            [
                'key' => 'site.tagline',
                'value' => 'The Light of the Nation',
                'type' => 'text',
                'group' => 'general',
                'description' => 'The site tagline or slogan'
            ],
            [
                'key' => 'site.description',
                'value' => 'Official information portal for Anambra State, Nigeria - showcasing government achievements, cultural heritage, and executive leadership.',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Site description for SEO and meta tags'
            ],

            // Logo and branding
            [
                'key' => 'site.logo',
                'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCCSa2pnsJ_OX4IR38KZWKQINPi8zpXlixHs6t3YHpMdVPi0VXuMfWV7DAZwXLrfw_1ZyRyF5Yf9q-qeNMtAkliR7ctqolYR9R43Edvg77J8gs6m1GIzi8xNbNG5YKKp__IZzsWgUVFY23DHjmWW1KNor5ZJhRlxmtWtMNdM587nhs2y8E85xv_AwgNoXB7AjGMTN9VNgLKT03-H0oV01FGxhwd1H_hzZMri0kgUiao9YDLKnxdm1J3WWiSAYkZMUwvC7BCwFyM6QrB',
                'type' => 'image',
                'group' => 'branding',
                'description' => 'Main site logo (Anambra State Seal)'
            ],
            [
                'key' => 'site.emblem',
                'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAahs_GBXB_QF-I2oDBJhi15x_dMHjAZ1F-OLBdDdy0qr-5324psB2fiDLoURwDT-LHSiDMy1QKS8Snt--7wIvkhYqb0lknBNdsNgwSCeFJUJ5J59P4eilVazpgi1OfzlmrL77B1l8Fe0Ofrx_2TfB1kIO8hLsurBWWLosZX4w4KylXUQ_ion0Xq4oKmpSZV3pL9C7bjsxxcnwwQrSB6rm-JP69cTZDSPwfvJRY89Ou34gtfqXXKaluv03XEfCNT2TAtgtWwx-20byP',
                'type' => 'image',
                'group' => 'branding',
                'description' => 'Anambra State Emblem used in headers'
            ],

            // Navigation settings
            [
                'key' => 'navigation.main_menu',
                'value' => json_encode([
                    ['name' => 'Home', 'route' => 'home'],
                    ['name' => 'About', 'route' => 'about'],
                    ['name' => 'Executive Council', 'route' => 'executive-council'],
                    ['name' => 'Achievements', 'route' => 'achievements'],
                    ['name' => 'History & Culture', 'route' => 'history-culture']
                ]),
                'type' => 'json',
                'group' => 'navigation',
                'description' => 'Main navigation menu structure'
            ],

            // Content settings
            [
                'key' => 'content.items_per_page',
                'value' => '12',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Default number of items to display per page'
            ],
            [
                'key' => 'content.enable_search',
                'value' => 'true',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Enable/disable search functionality'
            ],

            // Social media and contact
            [
                'key' => 'contact.address',
                'value' => 'Anambra State Government House, Awka, Nigeria',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Official government address'
            ],
            [
                'key' => 'contact.phone',
                'value' => '+234-XXX-XXX-XXXX',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Official contact phone number'
            ],
            [
                'key' => 'contact.email',
                'value' => 'info@anambrastate.gov.ng',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Official government email address'
            ],

            // Theme settings
            [
                'key' => 'theme.primary_color',
                'value' => '#facc15',
                'type' => 'text',
                'group' => 'theme',
                'description' => 'Primary theme color (yellow-400)'
            ],
            [
                'key' => 'theme.dark_mode_enabled',
                'value' => 'true',
                'type' => 'text',
                'group' => 'theme',
                'description' => 'Enable/disable dark mode support'
            ]
        ];

        foreach ($settings as $settingData) {
            Setting::create($settingData);
        }
    }
}
