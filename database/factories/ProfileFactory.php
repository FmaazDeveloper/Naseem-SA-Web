<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Guide;
use App\Models\Tourist;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'profileable_id' => fake()->randomElement([Admin::all()->random(),Tourist::all()->random(),Guide::all()->random()]),
            'profileable_type' => fake()->randomElement([Admin::class,Tourist::class,Guide::class]),
            'nationality' => fake()->country(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'age' => fake()->numberBetween(18,100),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'language' => fake()->languageCode(),
        ];
    }
}
