<?php

namespace Database\Factories;

use App\Models\User;
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
            'user_id' => User::all()->random(),
            'nationality' => fake()->country(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'age' => fake()->numberBetween(18,100),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'language' => fake()->languageCode(),
        ];
    }
}
