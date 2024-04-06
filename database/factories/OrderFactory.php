<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tourist_id' => User::all()->random(),
            'guide_id' => User::all()->random(),
            'admin_id' => User::all()->random(),
            'region_id' => Region::all()->random(),
            'number_of_people' => fake()->numberBetween(1,10),
            'number_of_days' => fake()->numberBetween(1,10),
            'status' => fake()->randomElement(['Active', 'Pending', 'Completed', 'Canceled']),
            'closed_at' => fake()->dateTime(),
        ];
    }
}
