<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hospital>
 */
class HospitalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
        'code' => strtoupper($this->faker->unique()->lexify('HSP???')),
        'name' => $this->faker->company(),
        'region_id' => Region::inRandomOrder()->first()?->id,
        'address_id' => Address::inRandomOrder()->first()?->id,
        'open_at' => '08:00',
        'close_at' => '18:00',
        'days_of_work' => 'Sun-Mon-Tue-Wed-Thu',
        'medical_staff_ids' => json_encode([]),
        'room_ids' => json_encode([]),

    ];

    }
}
