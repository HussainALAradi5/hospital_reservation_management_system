<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicineCompany>
 */
class MedicineCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => $this->faker->company(),
        'code' => strtoupper($this->faker->unique()->lexify('MC???')),
        'country_id' => Country::inRandomOrder()->value('id') ?? 1,
        'address_id' => Address::inRandomOrder()->first()?->id,
    ];

    }
}
