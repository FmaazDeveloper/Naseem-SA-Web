<?php

namespace Database\Factories;

use App\Models\ContactReasons;
use App\Models\StatusType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
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
            'admin_id' => User::all()->random(),
            'contact_reason_id' => ContactReasons::all()->random(),
            'status_id' => StatusType::all()->random(),
            'title' => fake()->paragraph(1),
            'message' => fake()->paragraph(3),
            'file' => fake()->file(),
            'answer' => fake()->paragraph(3),
            'closed_at' => now(),
        ];
    }
}
