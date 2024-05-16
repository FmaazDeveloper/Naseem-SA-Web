<?php

namespace Database\Factories;

use App\Models\Region;
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
        $user = User::factory()->create();

        $user->assignRole($user->role);

        return [
            'user_id' => $user->id,
            'photo' => fake()->randomElement(['images/profiles/Al-Baha.png', 'images/profiles/Riyadh.png', 'images/profiles/Makkah.png', 'images/profiles/Jazan.png',]),
            'phone_number' => fake()->unique()->phoneNumber(),
            'age' => fake()->numberBetween(18, 100),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'nationality' => fake()->country(),
            'region_id' => Region::all()->random(),
            'language' => fake()->languageCode(),
            'overview' => fake()->paragraph(2),
        ];
    }
}
