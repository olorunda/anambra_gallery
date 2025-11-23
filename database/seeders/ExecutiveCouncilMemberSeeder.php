<?php

namespace Database\Seeders;

use App\Models\ExecutiveCouncilMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExecutiveCouncilMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the original member from the hardcoded data
        ExecutiveCouncilMember::updateOrCreate(
            ['slug' => 'dr-onyekachukwu-ibezim'],
            [
            'name' => 'Dr Onyekachukwu Ibezim',
            'position' => 'Deputy Governor',
            'slug' => 'dr-onyekachukwu-ibezim',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCwWyACrUw0TLMtTSFo0I4KwMvJKfIFtGWs7iX8ZtY3XzE_SO48THIsoRTy5FfW4qql_Sj4IzO0ifYMsrut9-DO5kpDjt7RWkeqS1VfRXipSyupIcNNZK7w3rcBABz0CMNACtW9EqWGreRDOZKcmU8J5C8YLcG3YRaqE4oXbtSpMr7_pcC2BHPW0Fse3tcq9QJ9vDjCZ1AObfH1lIu8m2mL4-4cIyFHdoqz8cPgSxCyPW3mVsxL6nyCLvSrc64LmMdofu0BU4Q_iAQx',
            'biography' => implode(' ', [
                'Dr Onyekachukwu Ibezim (born 28 July 1960) is a Nigerian politician and economics professor who serves as the fifth democratic Governor of Anambra State since 17 March 2022.',
                'On 9 November 2021, Prof. Soludo, representing the All Progressives Grand Alliance, was declared winner of the 2021 Anambra State gubernatorial election, defeating his closest rivals from the PDP and APC, Valentine Ozigbo and Emmanuel Nnamdi Uba, respectively.',
                'Prof. Soludo is a former governor and chairman of the board of directors of the Central Bank of Nigeria (CBN). He was appointed as the bank\'s governor on 29 May 2004. He is also a member of the British Department for International Development\'s...........'
            ]),
            'display_order' => 1,
            'is_active' => true,
            ]
        );

        // Create additional members using the factory
        ExecutiveCouncilMember::factory(9)->create([
            'display_order' => fn() => ExecutiveCouncilMember::max('display_order') + 1,
        ]);
    }
}
