<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materials = [
            'Gold',
            'Silver',
            'Platinum',
            'Titanium',
            'Stainless Steel',
            'Copper',
            'Bronze',
            'Brass',
            'Palladium',
            'Rhodium'
        ];

        return [
            'material' => $this->faker->unique()->randomElement($materials),
            'description' => $this->faker->sentence,
        ];
    }
}
