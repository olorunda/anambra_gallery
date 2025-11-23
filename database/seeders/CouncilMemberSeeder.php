<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CouncilMember;

class CouncilMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Prof. Charles Chukwuemeka Soludo',
                'slug' => 'prof-charles-soludo',
                'position' => 'Governor',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC7uLQIfXNrwxFgOIiCo7YwQ1Zasl774nP71TIEC3-3NKl4KNpDTAUW9huTj6tZnyZ3WiBeRdalUmb8YotO95amKjvW1Nhnjs-cn1z8noIUeg_p7wG3kn3g5m3x_MMS3Q7zodX1SotiIcvrNBLolRH9F-aXKSINuLwTWYdlgvXOmb5iGr9bT7kYVuaEzeZ9QWHe2sTKIwjdYxIc-2_a135fP75Y2Zpih8qP7ssPkIQPPqY1hWpVWu1GoNhBL-oaHkNvo7SQPPj2ODOg',
                'biography' => [
                    'Prof. Charles Chukwuma Soludo, CFR (born 28 July 1960) is a Nigerian politician and economics professor who serves as the fifth democratic Governor of Anambra State since 17 March 2022.',
                    'On 9 November 2021, Prof. Soludo, representing the All Progressives Grand Alliance, was declared winner of the 2021 Anambra State gubernatorial election, defeating his closest rivals from the PDP and APC, Valentine Ozigbo and Emmanuel Nnamdi Uba, respectively.',
                    'Prof. Soludo is a former governor and chairman of the board of directors of the Central Bank of Nigeria (CBN). He was appointed as the bank\'s governor on 29 May 2004. He is also a member of the British Department for International Development\'s advisory panel.'
                ],
                'sort_order' => 1
            ],
            [
                'name' => 'Dr Onyekachukwu Ibezim',
                'slug' => 'dr-onyekachukwu-ibezim',
                'position' => 'Deputy Governor',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCwWyACrUw0TLMtTSFo0I4KwMvJKfIFtGWs7iX8ZtY3XzE_SO48THIsoRTy5FfW4qql_Sj4IzO0ifYMsrut9-DO5kpDjt7RWkeqS1VfRXipSyupIcNNZK7w3rcBABz0CMNACtW9EqWGreRDOZKcmU8J5C8YLcG3YRaqE4oXbtSpMr7_pcC2BHPW0Fse3tcq9QJ9vDjCZ1AObfH1lIu8m2mL4-4cIyFHdoqz8cPgSxCyPW3mVsxL6nyCLvSrc64LmMdofu0BU4Q_iAQx',
                'biography' => [
                    'Dr Onyekachukwu Ibezim serves as the Deputy Governor of Anambra State, bringing extensive experience in public administration and governance to the executive council.',
                    'He has been instrumental in implementing key policy initiatives and supporting the governor\'s vision for the transformation of Anambra State.',
                    'Dr Ibezim\'s expertise in strategic planning and public sector management has been crucial in driving the state\'s development agenda forward.'
                ],
                'sort_order' => 2
            ]
        ];

        foreach ($members as $memberData) {
            CouncilMember::create([
                'name' => $memberData['name'],
                'slug' => $memberData['slug'],
                'position' => $memberData['position'],
                'image' => $memberData['image'],
                'biography' => $memberData['biography'],
                'sort_order' => $memberData['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
