<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Landmark>
 */
class LandmarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'region_id' => Region::all()->random(),
            'name' => fake()->name(),
            'description' => fake()->paragraph(2),
            'photo' => fake()->randomElement(['images/landmarks/zxv.png','images/landmarks/log1.png','images/landmarks/add.png','images/landmarks/ad1.png']),
            'location' => fake()->city(),
            'is_active' => fake()->randomElement(['0','1']),
        ];
    }
}
