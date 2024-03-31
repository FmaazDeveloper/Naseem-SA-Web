<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Island;
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
            'landmarkable_id' => fake()->randomElement([City::all()->random(),Island::all()->random()]),
            'landmarkable_type' => fake()->randomElement([City::class,Island::class]),
            'name' => fake()->name(),
            'description' => fake()->paragraph(2),
            'photo' => fake()->paragraph(1),
            'location' => fake()->city(),

        ];
    }
}
