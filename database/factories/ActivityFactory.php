<?php

namespace Database\Factories;

use App\Models\AdministrativeRegion;
use App\Models\Region;
use App\Models\Landmark;
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
            'administrative_region_id' => AdministrativeRegion::all()->random(),
            'region_id' => Region::all()->random(),
            'landmark_id' => Landmark::all()->random(),
            'description' => fake()->paragraph(2),
            'is_active' => fake()->randomElement(['0','1']),
        ];
    }
}
