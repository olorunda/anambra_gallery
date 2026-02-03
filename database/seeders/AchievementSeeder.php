<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Achievement;
use App\Models\Image;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $achievements = [
            [
                'title' => 'New School Building',
                'slug' => 'new-school-building',
                'description' => 'A state-of-the-art educational facility featuring modern architecture and advanced learning amenities. This newly constructed school building represents the government\'s commitment to providing quality education infrastructure for the youth of Anambra State.',
                'category' => 'education-human-capital',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAzUXe79V5Ihxq6o0_N5jeDDDWkXkpGJrt2sJv2l3RxaXZnoCTb-U5Se8jTj9_RUB_jEmheaXQfklDDugr0BQ1vqmn6YUUDRKQKaRh-GTAbt2yp9aIn5MV7_tpgdXRdkvqigI-BU5R39rftZYa6daQUDnodKz56-VrDRAqdrMgf1Q__9ngkllBZlMF22rOlbtXx3B3zPXxayle5bvbA169d2_cfvMb0l10b0FiWVJquGZ8NRnF6FhcYcK-hbwmJYhR1C5A_p2wpmXO5',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCXYs528YYnn3nKxHHWnyGt-Wk-zwG7PVdlBVroSZR_qec1jREWLzlnNpvLpHRO7bkn1cyVnHXZQDMO-hmIp2QH76azmAs-QWQFxQnSMfEguee7630eUzujh0HLesZn9gVNAa5t1OK-xRb2u0nz0Eevzp0Y5e3XoifIF1OSn7d15QPofWGfNVOJX6VtJhSCRZ5CGrPfI5akgBB-fMv9nTdeGk3KLYyikeeKfctItn0CkXC3cTk6XWTlUcHymZ2cSmT-Iq6MkwzK-qS6',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuB00MHPatIkZw7me-bJc5fHGXaQxccJ9ja5kAtH6GzPGy3cyla5ro0ZIsV73LgzHMWGS0Ekg1ZjE8MP1Q58WSDKU1Kt92CY3ewj7QTv4vGz8RbgO1mfVcQmFDHruOOSZohB_il7xJ9PjFMYsuT8wg5KtUknZKnJ__KkfKlnPDME6eAncPUi_KfU7AT-4ekOjWmCMh8FTnZe5HITqhp_H2BI8gOIR_6nFGzHMxp81ayhii_Eq49X3lqaE5JbczaX1rGV-ajqEA7Agde3'
                ]
            ],
            [
                'title' => 'Federal College of Education',
                'slug' => 'federal-college-education',
                'description' => 'The Federal College of Education building stands as a testament to Anambra State\'s dedication to higher education. This multi-story facility houses modern classrooms, laboratories, and administrative offices, providing an excellent environment for teacher training and educational development.',
                'category' => 'education-human-capital',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCXYs528YYnn3nKxHHWnyGt-Wk-zwG7PVdlBVroSZR_qec1jREWLzlnNpvLpHRO7bkn1cyVnHXZQDMO-hmIp2QH76azmAs-QWQFxQnSMfEguee7630eUzujh0HLesZn9gVNAa5t1OK-xRb2u0nz0Eevzp0Y5e3XoifIF1OSn7d15QPofWGfNVOJX6VtJhSCRZ5CGrPfI5akgBB-fMv9nTdeGk3KLYyikeeKfctItn0CkXC3cTk6XWTlUcHymZ2cSmT-Iq6MkwzK-qS6',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAzUXe79V5Ihxq6o0_N5jeDDDWkXkpGJrt2sJv2l3RxaXZnoCTb-U5Se8jTj9_RUB_jEmheaXQfklDDugr0BQ1vqmn6YUUDRKQKaRh-GTAbt2yp9aIn5MV7_tpgdXRdkvqigI-BU5R39rftZYa6daQUDnodKz56-VrDRAqdrMgf1Q__9ngkllBZlMF22rOlbtXx3B3zPXxayle5bvbA169d2_cfvMb0l10b0FiWVJquGZ8NRnF6FhcYcK-hbwmJYhR1C5A_p2wpmXO5',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAmSHkxWMNl4ozWSi4TanBHMrfDLnaQWO2EdLEXJkxgbrTJrZRuHoVX0ijjrPhMJS2rra41jXYSWvEWffMIJ_KI5QZrAtylzQkppVPYFTESQ2B5-qWfj_ckzbtDmr-wvsHSI2z42MssQlUaHcmEZQuavvcA338qVSY4MPjcIK8nEvivyObP6K6bEKfnhZV9AOWpwlqpBOfkFbnPC-CFJ74zSz80Ec6VNvPamfnxwwifKbxwtju12TA9ID1nn57Kr8GhRte3nyq6cgVR'
                ]
            ],
            [
                'title' => 'New Government House',
                'slug' => 'new-government-house',
                'description' => 'The new Government House represents a modern administrative hub designed to enhance governance efficiency. This impressive structure features contemporary architecture and state-of-the-art facilities for government operations and public service delivery.',
                'category' => 'infrastructure-transportation',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuB00MHPatIkZw7me-bJc5fHGXaQxccJ9ja5kAtH6GzPGy3cyla5ro0ZIsV73LgzHMWGS0Ekg1ZjE8MP1Q58WSDKU1Kt92CY3ewj7QTv4vGz8RbgO1mfVcQmFDHruOOSZohB_il7xJ9PjFMYsuT8wg5KtUknZKnJ__KkfKlnPDME6eAncPUi_KfU7AT-4ekOjWmCMh8FTnZe5HITqhp_H2BI8gOIR_6nFGzHMxp81ayhii_Eq49X3lqaE5JbczaX1rGV-ajqEA7Agde3',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuB8HxHdkT3Sgp3j0ZWRHe1ZwoflXsSyP5CxEpdcuir-WOKrMpOJ8W9dGBoicDDdJsZqfryd6zlN_D3S-Q1HRqVKYuDTKkU11VCEwk2Znm9PslBMIGJjsi023jfW9PSrmV2dnP6kVKALW4sOwusYly_OvH_Hu8CA_1CxLk9WIdyG2NZJBFr9cO2Fkx3LE2ljnCH_LoSjFCe4T3XQCN6cv6sV5pojF2EPmYYBuvmqbLQzsfdp8xyse2C0C4Bx622DLJruIl73Xihozxhx',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuD5DqRV1Ia6CdjFktXvCTgQu1KNHS1H3updclZYccjF_Uxi1evyq57aFCt1DUZhxbzBt3rNDG5zZ4yTAy3Yu0RDmJTYb56pJacMx_npjEsdhgpn-6x84KaTdcqLodMXQc7MLAScbG5au_fAvCgOvx6rhxHax3xtbZDIZsrMH333lgDQaNb6k1Vrht3C7t5jnf5XoE9wkUH9VO-Bujk9ovC6TmwVHnR4Zf8CYu-HHNK5WwirzI26zZg_CQAWSVUxJCKikthfB3ixRvNk'
                ]
            ],
            [
                'title' => 'New Hospital Building',
                'slug' => 'new-hospital-building',
                'description' => 'A modern healthcare facility equipped with cutting-edge medical technology and infrastructure. This hospital building demonstrates the state\'s commitment to improving healthcare services and ensuring quality medical care for all residents of Anambra State.',
                'category' => 'healthcare',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAmSHkxWMNl4ozWSi4TanBHMrfDLnaQWO2EdLEXJkxgbrTJrZRuHoVX0ijjrPhMJS2rra41jXYSWvEWffMIJ_KI5QZrAtylzQkppVPYFTESQ2B5-qWfj_ckzbtDmr-wvsHSI2z42MssQlUaHcmEZQuavvcA338qVSY4MPjcIK8nEvivyObP6K6bEKfnhZV9AOWpwlqpBOfkFbnPC-CFJ74zSz80Ec6VNvPamfnxwwifKbxwtju12TA9ID1nn57Kr8GhRte3nyq6cgVR',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCXYs528YYnn3nKxHHWnyGt-Wk-zwG7PVdlBVroSZR_qec1jREWLzlnNpvLpHRO7bkn1cyVnHXZQDMO-hmIp2QH76azmAs-QWQFxQnSMfEguee7630eUzujh0HLesZn9gVNAa5t1OK-xRb2u0nz0Eevzp0Y5e3XoifIF1OSn7d15QPofWGfNVOJX6VtJhSCRZ5CGrPfI5akgBB-fMv9nTdeGk3KLYyikeeKfctItn0CkXC3cTk6XWTlUcHymZ2cSmT-Iq6MkwzK-qS6',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuB00MHPatIkZw7me-bJc5fHGXaQxccJ9ja5kAtH6GzPGy3cyla5ro0ZIsV73LgzHMWGS0Ekg1ZjE8MP1Q58WSDKU1Kt92CY3ewj7QTv4vGz8RbgO1mfVcQmFDHruOOSZohB_il7xJ9PjFMYsuT8wg5KtUknZKnJ__KkfKlnPDME6eAncPUi_KfU7AT-4ekOjWmCMh8FTnZe5HITqhp_H2BI8gOIR_6nFGzHMxp81ayhii_Eq49X3lqaE5JbczaX1rGV-ajqEA7Agde3'
                ]
            ],
            [
                'title' => 'Government Apartment Complex',
                'slug' => 'government-apartment',
                'description' => 'A tall residential complex providing modern housing solutions as part of the state\'s urban development initiative. This apartment building features contemporary design and amenities to support the growing housing needs of Anambra State residents.',
                'category' => 'economic-social',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuB8HxHdkT3Sgp3j0ZWRHe1ZwoflXsSyP5CxEpdcuir-WOKrMpOJ8W9dGBoicDDdJsZqfryd6zlN_D3S-Q1HRqVKYuDTKkU11VCEwk2Znm9PslBMIGJjsi023jfW9PSrmV2dnP6kVKALW4sOwusYly_OvH_Hu8CA_1CxLk9WIdyG2NZJBFr9cO2Fkx3LE2ljnCH_LoSjFCe4T3XQCN6cv6sV5pojF2EPmYYBuvmqbLQzsfdp8xyse2C0C4Bx622DLJruIl73Xihozxhx',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAzUXe79V5Ihxq6o0_N5jeDDDWkXkpGJrt2sJv2l3RxaXZnoCTb-U5Se8jTj9_RUB_jEmheaXQfklDDugr0BQ1vqmn6YUUDRKQKaRh-GTAbt2yp9aIn5MV7_tpgdXRdkvqigI-BU5R39rftZYa6daQUDnodKz56-VrDRAqdrMgf1Q__9ngkllBZlMF22rOlbtXx3B3zPXxayle5bvbA169d2_cfvMb0l10b0FiWVJquGZ8NRnF6FhcYcK-hbwmJYhR1C5A_p2wpmXO5',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAmSHkxWMNl4ozWSi4TanBHMrfDLnaQWO2EdLEXJkxgbrTJrZRuHoVX0ijjrPhMJS2rra41jXYSWvEWffMIJ_KI5QZrAtylzQkppVPYFTESQ2B5-qWfj_ckzbtDmr-wvsHSI2z42MssQlUaHcmEZQuavvcA338qVSY4MPjcIK8nEvivyObP6K6bEKfnhZV9AOWpwlqpBOfkFbnPC-CFJ74zSz80Ec6VNvPamfnxwwifKbxwtju12TA9ID1nn57Kr8GhRte3nyq6cgVR'
                ]
            ],
            [
                'title' => 'Lagos - Onitsha Expressway',
                'slug' => 'lagos-onitsha-expressway',
                'description' => 'A major infrastructure project connecting Lagos to Onitsha, this expressway represents significant progress in transportation infrastructure. The colorful buildings along the route showcase urban development and the positive impact of improved road networks on local communities.',
                'category' => 'infrastructure-transportation',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuD5DqRV1Ia6CdjFktXvCTgQu1KNHS1H3updclZYccjF_Uxi1evyq57aFCt1DUZhxbzBt3rNDG5zZ4yTAy3Yu0RDmJTYb56pJacMx_npjEsdhgpn-6x84KaTdcqLodMXQc7MLAScbG5au_fAvCgOvx6rhxHax3xtbZDIZsrMH333lgDQaNb6k1Vrht3C7t5jnf5XoE9wkUH9VO-Bujk9ovC6TmwVHnR4Zf8CYu-HHNK5WwirzI26zZg_CQAWSVUxJCKikthfB3ixRvNk',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCXYs528YYnn3nKxHHWnyGt-Wk-zwG7PVdlBVroSZR_qec1jREWLzlnNpvLpHRO7bkn1cyVnHXZQDMO-hmIp2QH76azmAs-QWQFxQnSMfEguee7630eUzujh0HLesZn9gVNAa5t1OK-xRb2u0nz0Eevzp0Y5e3XoifIF1OSn7d15QPofWGfNVOJX6VtJhSCRZ5CGrPfI5akgBB-fMv9nTdeGk3KLYyikeeKfctItn0CkXC3cTk6XWTlUcHymZ2cSmT-Iq6MkwzK-qS6',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuB00MHPatIkZw7me-bJc5fHGXaQxccJ9ja5kAtH6GzPGy3cyla5ro0ZIsV73LgzHMWGS0Ekg1ZjE8MP1Q58WSDKU1Kt92CY3ewj7QTv4vGz8RbgO1mfVcQmFDHruOOSZohB_il7xJ9PjFMYsuT8wg5KtUknZKnJ__KkfKlnPDME6eAncPUi_KfU7AT-4ekOjWmCMh8FTnZe5HITqhp_H2BI8gOIR_6nFGzHMxp81ayhii_Eq49X3lqaE5JbczaX1rGV-ajqEA7Agde3'
                ]
            ]
        ];

        foreach ($achievements as $index => $achievementData) {
            $achievement = Achievement::create([
                'title' => $achievementData['title'],
                'slug' => $achievementData['slug'],
                'description' => $achievementData['description'],
                'category' => $achievementData['category'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            foreach ($achievementData['images'] as $imageIndex => $imageUrl) {
                $achievement->images()->create([
                    'url' => $imageUrl,
                    'alt_text' => $achievementData['title'] . ' - Image ' . ($imageIndex + 1),
                    'sort_order' => $imageIndex + 1,
                ]);
            }
        }
    }
}
