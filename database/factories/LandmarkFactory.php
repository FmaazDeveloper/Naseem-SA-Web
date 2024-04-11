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
            'photo' => fake()->randomElement(['Abha city.jpg','الرياض 12.jpg','IMG_3422.JPG','Art_Museum.jpg']),
            'location' => fake()->city(),

        ];
    }
}
