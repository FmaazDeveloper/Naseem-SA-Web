<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Region>
 */
class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'admin_id' => User::all()->random(),
            'type' => fake()->randomElement(['City','Island']),
            'name' => fake()->city(),
            'main_description' => fake()->paragraph(4),
            'weather_description' => fake()->paragraph(2),
            'card_description' => fake()->paragraph(2),
            'card_photo' => fake()->randomElement(['images/regions/zxv.png','images/regions/log1.png','images/regions/add.png','images/regions/ad1.png']),
            'is_active' => fake()->randomElement(['0','1']),
        ];
    }
}
