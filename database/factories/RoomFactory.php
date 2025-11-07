<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'code' => strtoupper($this->faker->unique()->lexify('RM???')),
        'name' => $this->faker->word() . ' Room',
        'type' => $this->faker->randomElement(['doctor_season', 'treatment']),
        'status' => $this->faker->randomElement(['free', 'occupied', 'maintenance']),
        'hospital_id' => Hospital::inRandomOrder()->first()?->id,
        'medical_staff_ids' => [],
        'last_sign_in_user_ids' => [],
        'sign_out_user_ids' => [],
    ];

    }
}
