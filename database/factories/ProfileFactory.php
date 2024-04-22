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
            'photo' => fake()->randomElement(['images/profiles/Al-Baha.png', 'images/profiles/Riyadh.png', 'images/profiles/Makkah.png', 'images/profiles/Jazan.png',]),
            'phone_number' => fake()->unique()->phoneNumber(),
            'age' => fake()->numberBetween(18,100),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'nationality' => fake()->country(),
            'language' => fake()->languageCode(),
        ];
    }
}
