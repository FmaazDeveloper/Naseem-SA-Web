<?php

namespace Database\Factories;

use App\Models\AdministrativeRegion;
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
            'user_id' => fake()->unique()->numberBetween(1, 10),
            'photo' => fake()->randomElement(['images/profiles/Al-Baha.png', 'images/profiles/Riyadh.png', 'images/profiles/Makkah.png', 'images/profiles/Jazan.png',]),
            'phone_number' => fake()->unique()->phoneNumber(),
            'age' => fake()->numberBetween(18,100),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'nationality' => fake()->country(),
            'region_id' => AdministrativeRegion::all()->random(),
            'language' => fake()->languageCode(),
        ];
    }
}
