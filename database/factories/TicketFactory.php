<?php

namespace Database\Factories;

use App\Models\ContactReasons;
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
            'status' => fake()->randomElement(['New','Closed']),
            'title' => fake()->paragraph(1),
            'message' => fake()->paragraph(2),
            'ticket_file' => fake()->name(),
            'answer' => fake()->paragraph(2),
            'answer_file' => fake()->name(),
            'closed_at' => fake()->randomElement([null,now()]),
        ];
    }
}
