<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Island;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'landmark_id' => rand(1,10),
            'activityable_id' => fake()->randomElement([City::all()->random(),Island::all()->random()]),
            'activityable_type' => fake()->randomElement([City::class,Island::class]),
            'description' => fake()->paragraph(2),
        ];
    }
}
