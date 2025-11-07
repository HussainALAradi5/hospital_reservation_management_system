<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
        'code' => strtoupper($this->faker->unique()->lexify('ADR???')),
        'region_id' => Region::inRandomOrder()->first()?->id,
        'street' => $this->faker->streetName(),
        'road' => $this->faker->streetSuffix(),
        'building' => $this->faker->buildingNumber(),
        'block' => $this->faker->postcode(),
    ];

    }
}
