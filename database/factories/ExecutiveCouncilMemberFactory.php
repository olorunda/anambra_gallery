<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExecutiveCouncilMember>
 */
class ExecutiveCouncilMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        $positions = [
            'Governor',
            'Deputy Governor',
            'Commissioner for Finance',
            'Commissioner for Education',
            'Commissioner for Health',
            'Commissioner for Works',
            'Commissioner for Agriculture',
            'Commissioner for Commerce',
            'Secretary to State Government',
            'Chief of Staff'
        ];

        return [
            'name' => $name,
            'position' => $this->faker->randomElement($positions),
            'slug' => \Illuminate\Support\Str::slug($name),
            'image' => $this->faker->imageUrl(400, 600, 'people', true),
            'biography' => implode(' ', [
                $this->faker->paragraph(4),
                $this->faker->paragraph(3),
                $this->faker->paragraph(2),
            ]),
            'display_order' => $this->faker->numberBetween(1, 100),
            'is_active' => true,
        ];
    }
}
