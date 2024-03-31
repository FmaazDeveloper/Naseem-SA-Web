<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Island>
 */
class IslandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'admin_id' => rand(1,31),
            'name' => fake()->city(),
            'main_description' => fake()->paragraph(4),
            'weather_description' => fake()->paragraph(2),
            'card_description' => fake()->paragraph(2),
            'card_photo' => fake()->paragraph(1),
        ];
    }
}
