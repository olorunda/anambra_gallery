<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Welcome to Anambra State',
                'slug' => 'welcome',
                'subtitle' => 'The Light of the Nation',
                'content' => 'Ihiala is a city in Nigeria, located in the southern part of Anambra State and within the region known as Igboland. It has long served as the local administrative capital of Ihiala Local Government Area. The Local Government Area has a population of about 430,800. Ihiala is the largest city in Ihiala Local Government Area, which includes towns like Amorka, Azia, Lilu, Okija, Mbosi, Isseke, Orsumoghu, Ubuluisuzor and Uli. It lies in the agricultural belt of the state. Ihiala falls under the Anambra South senatorial district in Anambra State, Nigeria.',
                'meta_data' => [
                    'featured_region' => 'Anambra West',
                    'call_to_action' => 'Tap below to learn more about Anambra',
                    'primary_button_text' => 'About Anambra',
                    'secondary_button_text' => 'Anambra State Executive Council'
                ],
                'background_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAvwlVhyt2UbEBfP6VMV3Gjq9IJfMdCEG27imFtsRWFaBKpRJkKO2fMBm6D2kUXMk9v4P57g_o1EhCq7hKcNkLUVf_5WNPKM4Eq2PSNkkLlT-V534G52fn_7ZYFX3OYm01jFs5UZwNJjNyJ7CNnAuEKuWoYNUIkpjn6cO2v8yaxykAjNPLIsHuaXWIJVpA4af_RqWg79yNUm2EvDwl8or2KKKigNSKrkuoq1K_sDwdK9u-QteZditUNjceGl20UBS9OZzPvcVlAKpX5',
                'seal_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCCSa2pnsJ_OX4IR38KZWKQINPi8zpXlixHs6t3YHpMdVPi0VXuMfWV7DAZwXLrfw_1ZyRyF5Yf9q-qeNMtAkliR7ctqolYR9R43Edvg77J8gs6m1GIzi8xNbNG5YKKp__IZzsWgUVFY23DHjmWW1KNor5ZJhRlxmtWtMNdM587nhs2y8E85xv_AwgNoXB7AjGMTN9VNgLKT03-H0oV01FGxhwd1H_hzZMri0kgUiao9YDLKnxdm1J3WWiSAYkZMUwvC7BCwFyM6QrB',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'About Anambra State',
                'slug' => 'about',
                'subtitle' => 'Explore what aspect of Anambra State you wish to explore',
                'content' => 'Anambra State is known for its rich cultural heritage, industrial development, and educational excellence. The state is home to numerous institutions of higher learning, thriving markets, and cultural landmarks that showcase the vibrant Igbo heritage.',
                'meta_data' => [
                    'sections' => [
                        [
                            'title' => 'Anambra State Executive Council',
                            'description' => 'Meet the leadership driving governance and development',
                            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDBQSyFQcwXbnoEshEdFM35g4dBQEEv18z1dXhQllVRo49EEv3nSaWJ_Fve2yi11G_mfLm0rQ0n1G7Yr4gNSIbpFOle7kfG6X6zbqSOgZ2tCYeUUt6KdeEzLcZhplhLjxA7RKm1NrP-Dd2HIsvm8KTzauHMf3FShPWsc50STkcn9R58KxG9ug_gAJ9pBBWOXTyAR4Qb3Dv9oIjVw5pwNILjPes0r2_Vba3Vw2WNcxBLPY0LSwyGgrzaL7F1x3RLcIH8EiikgPMr5xeP',
                            'route' => 'executive-council'
                        ],
                        [
                            'title' => 'Achievements',
                            'description' => 'Discover major infrastructure developments',
                            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC9zqCyfDw9IwtB106oy8avXFTx9obWrPfXAzvQbBbkiGHUkWXwPLROYrtwznKg9eMkliyaP4uUc9Bn2ES0fGPMMed65FkLr_LRVqtvpeJ2lwipR3PTLUH149UXe-0atWjuU_S4NrXjDHzgyLMWkrNEWQPMeMiairDbAKTt072TiEy1Hkf5IocA9NbwAOeaADt_UDo8VK5-s3sWp5ktB9dbAjhMUzdWNZ8KmZVQ_60kycKMMMAnJ3IGD3GnPisVvo-XJx_7tmMu-I5U',
                            'route' => 'achievements'
                        ],
                        [
                            'title' => 'History & Culture',
                            'description' => 'Explore the rich heritage and traditions',
                            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD4gzp2T9wI4Mfcevr_XgQ0NqSUVTYzsEvuwbtP41T7SdsIr-LqKdjO8viCTW1jxxp4D3UCrMc-YhBTroKeaoEuYc-tkIeCzb9479QM9W-0A8gC-1lIbt1ss67bQGH-MGgi9tWARah7T2a5J19QDnYTrQL1HU-w2AyDoZSdSRmDGl9rQZk_z2l79tfyw1WtG0AdwLukp1tox_WQn5d4q1_I-tZR35ed277E-IdWzlh8HmK3VKNfGxGYh9dw4DwcjGFLuwpMFCQu60Kp',
                            'route' => 'history-culture'
                        ]
                    ]
                ],
                'seal_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAbF4HvfCeUv4Pw4Wt0sWmfDhUtk6mxLhILSvvJRxdpl6uMkpKQ-Kw3i2WG3De4AlAbUQ_51PO03Tj4CIxO5VsNk-o78TRHC72re5wnQN1u_01uIgzM_klHCWtGA5u93FKIl-kemiP_jpSBJQd8QdfkKZXroS3qlOJxop3EzO2Wbgu3yUkf-JYHYyNBFYyaG4W8iQ8QT2X3GwdXz20L9_K4z06Mi6-PHn3fBL4bxUM6EnG6pEIk11ztxtVQwdjsiLavyxdTPAn8KFBw',
                'sort_order' => 2,
                'is_active' => true
            ]
        ];

        foreach ($pages as $pageData) {
            Page::create($pageData);
        }
    }
}
