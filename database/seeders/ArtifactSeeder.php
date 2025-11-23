<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artifact;
use App\Models\Image;

class ArtifactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artifacts = [
            [
                'title' => 'Ancient Clay Pot',
                'slug' => 'clay-pot',
                'description' => 'This broken ancient clay pot represents the sophisticated pottery traditions of the Igbo-Ukwu civilization. Dating back to the 9th-10th century, these artifacts demonstrate the advanced ceramic techniques and artistic expression of ancient Anambra craftspeople. The intricate designs and quality of craftsmanship reflect a highly developed cultural society.',
                'category' => 'pottery',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuBmrkPhDYgZ5PlDClczJaRy6aSNhr6gDrz9ZCDUEdyDQMFgcVRf7ooKH3p_cawVmNUx2bxE8FmgtlyyAlNJqgwpECT_4j0_4JZiRllJIAIaGuPqcentP_UQcRC5I3q0AaGLM9Mdsd5JqEA6dshOU0rdroZzDv-EoWZlL57FNv1YMd1FFAuRq9wbrkaA7RVNk68CFBfyp43GMofeWQEBAExMAoBo2OjvcK3khbv4J0yyI4IONKh0VgoQA-8kZJ6PCqzUxMlMDsdP0ysY',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuDYpPPDAClm2zdrCXygkNZTbn1wpbmfZzPTYc2ls1ILS5yU0Cmk0heorT_8QOo0xeLLPyR6zK9dnja7SI-EEbELl2OpZFprK8YTGaJUdelcjLIFxXl86EwZjrJr9-ry5N-gCsYtKLcdzjtJV0_rHkv8qqoG57--xZM9MSfJoot2XFq3aD6gnzKyAV3cuX4QVW2z-etwjwwsCSMuJbrjTSr14-YxbRfYY7hqdth1oHg1idzHDx7aHlClKFN5JYd45VbyVNm0Caost8zs',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCnSLSIAHCyRfAADX-bcGVRSIIr8oQ1x4vtzmU9p1l0yMc_-rgKdwuUPSVLx3FRiqLO24W5aZGzPCklBHD4r3DtLQT4XUHwnT7sUB6xxdnlNsDDVxOOFhsChYG2pFVsNyIH6dPw3VsAq2n7cAcvlq_zhdV7jsJoKTgN_78kUXSCW05VSLTyM_9HZvnZxgJQHbyhURnl9jcSTz5CV0J7Jvm8hErOB0T9h3c301Cb_OHeTF1r-84uUyNH3dA5IK10Y-786bs4hg8-ZCHV'
                ]
            ],
            [
                'title' => 'Stone Carving Artisan',
                'slug' => 'stone-carving',
                'description' => 'This image captures a skilled artisan at work, demonstrating the living tradition of stone carving that has been passed down through generations in Anambra State. The craft represents the continuity of cultural practices and the preservation of traditional skills that connect modern craftspeople with their ancestral heritage.',
                'category' => 'craftsmanship',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCeIYlnuUGEHKgRm_ABHh2e5jlWu1W7--rW4aI0yYfIZB-53FIHal7iwfMVrH32X9tTTVhQBihNPN_wMnC2uUQmJSPaHxY6It7_kQpueDF_oHahdIeRXgtR2JMirE7kEYy8rQWdCIMAEANB0U27dClUVsvxZd7AnJmBV_0k9Ha_KNotJJkpNKkSkD9r6RMUN1gpLXvuoj9v_okOTxzyG5O3Nw0LK5AoEsdmaPDx4qzkbmqLTYXtHz0MU0M8yc5_RqN7jnM_sbhwmU6H',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuBmrkPhDYgZ5PlDClczJaRy6aSNhr6gDrz9ZCDUEdyDQMFgcVRf7ooKH3p_cawVmNUx2bxE8FmgtlyyAlNJqgwpECT_4j0_4JZiRllJIAIaGuPqcentP_UQcRC5I3q0AaGLM9Mdsd5JqEA6dshOU0rdroZzDv-EoWZlL57FNv1YMd1FFAuRq9wbrkaA7RVNk68CFBfyp43GMofeWQEBAExMAoBo2OjvcK3khbv4J0yyI4IONKh0VgoQA-8kZJ6PCqzUxMlMDsdP0ysY',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuBhxdNz8c6wJz4pz6rX713zZ9cBulAZQEm5gWClCDn340q9UxHz_WPNlm5uksrm4QhauBsLhoX8iO5W5Gt58Kxf599j52IUyu8yffE6niminplLk2kVYtqviriD63NZNEl9vdquhUj-3sz180K7QC2zWFbg2OykOXF8Ldim_9FFg8bJodp3DBBqe4W1seBUmeBxDQ6zsKzZv8dq4BPFphER3XYO4rUXQD4mLv3kvD_9NqJK6FOAM7O7q9M3W9iOea5SZqAJDp3MPoYt',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCAL17mQq3JbD1yF4qGsfol26Lot8l_OCOD5mm4Df6W4OAaCnnBolPq_qoYV0SEt2pIM8feUEcFqTatpuOzW8CkVMr_IxPIIuU3r1K11U55O28JWcDEu_trPM1ElgmcE6FWrCo_qWGYzCGyK8cQGprixvCy3dR-PtRJfGI-v7x8rjIQnvexhSnnpd6d0RuPhcNR157c41xNRHmYoa_SUnP0Gw0bPkDbEKF1I_EqHdtnW4fs6smRVTrwKHlgO304XuscpunRwaxAYaTw'
                ]
            ],
            [
                'title' => 'Spiral Ammonite Fossil',
                'slug' => 'ammonite-fossil',
                'description' => 'This remarkable spiral ammonite fossil tells a story that spans millions of years, connecting Anambra\'s geological history with its cultural significance. These ancient marine creatures once inhabited the seas that covered this region, and their fossilized remains provide insight into the deep historical foundations upon which Igbo civilization developed.',
                'category' => 'fossils',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuBhxdNz8c6wJz4pz6rX713zZ9cBulAZQEm5gWClCDn340q9UxHz_WPNlm5uksrm4QhauBsLhoX8iO5W5Gt58Kxf599j52IUyu8yffE6niminplLk2kVYtqviriD63NZNEl9vdquhUj-3sz180K7QC2zWFbg2OykOXF8Ldim_9FFg8bJodp3DBBqe4W1seBUmeBxDQ6zsKzZv8dq4BPFphER3XYO4rUXQD4mLv3kvD_9NqJK6FOAM7O7q9M3W9iOea5SZqAJDp3MPoYt',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuDYpPPDAClm2zdrCXygkNZTbn1wpbmfZzPTYc2ls1ILS5yU0Cmk0heorT_8QOo0xeLLPyR6zK9dnja7SI-EEbELl2OpZFprK8YTGaJUdelcjLIFxXl86EwZjrJr9-ry5N-gCsYtKLcdzjtJV0_rHkv8qqoG57--xZM9MSfJoot2XFq3aD6gnzKyAV3cuX4QVW2z-etwjwwsCSMuJbrjTSr14-YxbRfYY7hqdth1oHg1idzHDx7aHlClKFN5JYd45VbyVNm0Caost8zs',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCeIYlnuUGEHKgRm_ABHh2e5jlWu1W7--rW4aI0yYfIZB-53FIHal7iwfMVrH32X9tTTVhQBihNPN_wMnC2uUQmJSPaHxY6It7_kQpueDF_oHahdIeRXgtR2JMirE7kEYy8rQWdCIMAEANB0U27dClUVsvxZd7AnJmBV_0k9Ha_KNotJJkpNKkSkD9r6RMUN1gpLXvuoj9v_okOTxzyG5O3Nw0LK5AoEsdmaPDx4qzkbmqLTYXtHz0MU0M8yc5_RqN7jnM_sbhwmU6H'
                ]
            ],
            [
                'title' => 'Ancient Bronze Mirror',
                'slug' => 'bronze-mirror',
                'description' => 'This ornate bronze mirror exemplifies the exceptional metalworking skills of the Igbo-Ukwu civilization. The intricate craftsmanship and sophisticated bronze-working techniques demonstrate the advanced metallurgical knowledge possessed by ancient Anambra artisans, making these artifacts among the most sophisticated examples of early African metalwork.',
                'category' => 'bronze',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuDYpPPDAClm2zdrCXygkNZTbn1wpbmfZzPTYc2ls1ILS5yU0Cmk0heorT_8QOo0xeLLPyR6zK9dnja7SI-EEbELl2OpZFprK8YTGaJUdelcjLIFxXl86EwZjrJr9-ry5N-gCsYtKLcdzjtJV0_rHkv8qqoG57--xZM9MSfJoot2XFq3aD6gnzKyAV3cuX4QVW2z-etwjwwsCSMuJbrjTSr14-YxbRfYY7hqdth1oHg1idzHDx7aHlClKFN5JYd45VbyVNm0Caost8zs',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCnSLSIAHCyRfAADX-bcGVRSIIr8oQ1x4vtzmU9p1l0yMc_-rgKdwuUPSVLx3FRiqLO24W5aZGzPCklBHD4r3DtLQT4XUHwnT7sUB6xxdnlNsDDVxOOFhsChYG2pFVsNyIH6dPw3VsAq2n7cAcvlq_zhdV7jsJoKTgN_78kUXSCW05VSLTyM_9HZvnZxgJQHbyhURnl9jcSTz5CV0J7Jvm8hErOB0T9h3c301Cb_OHeTF1r-84uUyNH3dA5IK10Y-786bs4hg8-ZCHV',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuBmrkPhDYgZ5PlDClczJaRy6aSNhr6gDrz9ZCDUEdyDQMFgcVRf7ooKH3p_cawVmNUx2bxE8FmgtlyyAlNJqgwpECT_4j0_4JZiRllJIAIaGuPqcentP_UQcRC5I3q0AaGLM9Mdsd5JqEA6dshOU0rdroZzDv-EoWZlL57FNv1YMd1FFAuRq9wbrkaA7RVNk68CFBfyp43GMofeWQEBAExMAoBo2OjvcK3khbv4J0yyI4IONKh0VgoQA-8kZJ6PCqzUxMlMDsdP0ysY'
                ]
            ],
            [
                'title' => 'Ornate Terracotta Vases',
                'slug' => 'terracotta-vases',
                'description' => 'These two ornate terracotta vases showcase the artistic excellence and cultural sophistication of Igbo pottery traditions. The detailed decorative patterns and refined craftsmanship reflect both functional utility and aesthetic beauty, demonstrating how everyday objects were elevated to works of art in ancient Anambra society.',
                'category' => 'pottery',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCnSLSIAHCyRfAADX-bcGVRSIIr8oQ1x4vtzmU9p1l0yMc_-rgKdwuUPSVLx3FRiqLO24W5aZGzPCklBHD4r3DtLQT4XUHwnT7sUB6xxdnlNsDDVxOOFhsChYG2pFVsNyIH6dPw3VsAq2n7cAcvlq_zhdV7jsJoKTgN_78kUXSCW05VSLTyM_9HZvnZxgJQHbyhURnl9jcSTz5CV0J7Jvm8hErOB0T9h3c301Cb_OHeTF1r-84uUyNH3dA5IK10Y-786bs4hg8-ZCHV',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuBhxdNz8c6wJz4pz6rX713zZ9cBulAZQEm5gWClCDn340q9UxHz_WPNlm5uksrm4QhauBsLhoX8iO5W5Gt58Kxf599j52IUyu8yffE6niminplLk2kVYtqviriD63NZNEl9vdquhUj-3sz180K7QC2zWFbg2OykOXF8Ldim_9FFg8bJodp3DBBqe4W1seBUmeBxDQ6zsKzZv8dq4BPFphER3XYO4rUXQD4mLv3kvD_9NqJK6FOAM7O7q9M3W9iOea5SZqAJDp3MPoYt',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuDYpPPDAClm2zdrCXygkNZTbn1wpbmfZzPTYc2ls1ILS5yU0Cmk0heorT_8QOo0xeLLPyR6zK9dnja7SI-EEbELl2OpZFprK8YTGaJUdelcjLIFxXl86EwZjrJr9-ry5N-gCsYtKLcdzjtJV0_rHkv8qqoG57--xZM9MSfJoot2XFq3aD6gnzKyAV3cuX4QVW2z-etwjwwsCSMuJbrjTSr14-YxbRfYY7hqdth1oHg1idzHDx7aHlClKFN5JYd45VbyVNm0Caost8zs',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCeIYlnuUGEHKgRm_ABHh2e5jlWu1W7--rW4aI0yYfIZB-53FIHal7iwfMVrH32X9tTTVhQBihNPN_wMnC2uUQmJSPaHxY6It7_kQpueDF_oHahdIeRXgtR2JMirE7kEYy8rQWdCIMAEANB0U27dClUVsvxZd7AnJmBV_0k9Ha_KNotJJkpNKkSkD9r6RMUN1gpLXvuoj9v_okOTxzyG5O3Nw0LK5AoEsdmaPDx4qzkbmqLTYXtHz0MU0M8yc5_RqN7jnM_sbhwmU6H'
                ]
            ],
            [
                'title' => 'Collection of Metal Artifacts',
                'slug' => 'metal-artifacts',
                'description' => 'This diverse collection of ancient metal artifacts represents the pinnacle of Igbo-Ukwu metallurgical achievement. Each piece tells a story of technological innovation, artistic expression, and cultural significance, collectively forming one of Africa\'s most important archaeological treasures that continues to inform our understanding of ancient civilizations.',
                'category' => 'metal',
                'images' => [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCAL17mQq3JbD1yF4qGsfol26Lot8l_OCOD5mm4Df6W4OAaCnnBolPq_qoYV0SEt2pIM8feUEcFqTatpuOzW8CkVMr_IxPIIuU3r1K11U55O28JWcDEu_trPM1ElgmcE6FWrCo_qWGYzCGyK8cQGprixvCy3dR-PtRJfGI-v7x8rjIQnvexhSnnpd6d0RuPhcNR157c41xNRHmYoa_SUnP0Gw0bPkDbEKF1I_EqHdtnW4fs6smRVTrwKHlgO304XuscpunRwaxAYaTw',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuBmrkPhDYgZ5PlDClczJaRy6aSNhr6gDrz9ZCDUEdyDQMFgcVRf7ooKH3p_cawVmNUx2bxE8FmgtlyyAlNJqgwpECT_4j0_4JZiRllJIAIaGuPqcentP_UQcRC5I3q0AaGLM9Mdsd5JqEA6dshOU0rdroZzDv-EoWZlL57FNv1YMd1FFAuRq9wbrkaA7RVNk68CFBfyp43GMofeWQEBAExMAoBo2OjvcK3khbv4J0yyI4IONKh0VgoQA-8kZJ6PCqzUxMlMDsdP0ysY',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCnSLSIAHCyRfAADX-bcGVRSIIr8oQ1x4vtzmU9p1l0yMc_-rgKdwuUPSVLx3FRiqLO24W5aZGzPCklBHD4r3DtLQT4XUHwnT7sUB6xxdnlNsDDVxOOFhsChYG2pFVsNyIH6dPw3VsAq2n7cAcvlq_zhdV7jsJoKTgN_78kUXSCW05VSLTyM_9HZvnZxgJQHbyhURnl9jcSTz5CV0J7Jvm8hErOB0T9h3c301Cb_OHeTF1r-84uUyNH3dA5IK10Y-786bs4hg8-ZCHV',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuBhxdNz8c6wJz4pz6rX713zZ9cBulAZQEm5gWClCDn340q9UxHz_WPNlm5uksrm4QhauBsLhoX8iO5W5Gt58Kxf599j52IUyu8yffE6niminplLk2kVYtqviriD63NZNEl9vdquhUj-3sz180K7QC2zWFbg2OykOXF8Ldim_9FFg8bJodp3DBBqe4W1seBUmeBxDQ6zsKzZv8dq4BPFphER3XYO4rUXQD4mLv3kvD_9NqJK6FOAM7O7q9M3W9iOea5SZqAJDp3MPoYt',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuDYpPPDAClm2zdrCXygkNZTbn1wpbmfZzPTYc2ls1ILS5yU0Cmk0heorT_8QOo0xeLLPyR6zK9dnja7SI-EEbELl2OpZFprK8YTGaJUdelcjLIFxXl86EwZjrJr9-ry5N-gCsYtKLcdzjtJV0_rHkv8qqoG57--xZM9MSfJoot2XFq3aD6gnzKyAV3cuX4QVW2z-etwjwwsCSMuJbrjTSr14-YxbRfYY7hqdth1oHg1idzHDx7aHlClKFN5JYd45VbyVNm0Caost8zs'
                ]
            ]
        ];

        foreach ($artifacts as $index => $artifactData) {
            $artifact = Artifact::create([
                'title' => $artifactData['title'],
                'slug' => $artifactData['slug'],
                'description' => $artifactData['description'],
                'category' => $artifactData['category'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            foreach ($artifactData['images'] as $imageIndex => $imageUrl) {
                $artifact->images()->create([
                    'url' => $imageUrl,
                    'alt_text' => $artifactData['title'] . ' - Image ' . ($imageIndex + 1),
                    'sort_order' => $imageIndex + 1,
                ]);
            }
        }
    }
}
