<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userTypes = ['doctor', 'nurse', 'pharmacist', 'patient', 'admin'];
        $type = $this->faker->randomElement($userTypes);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'age' => $this->faker->numberBetween(22, 65),
            'telephone_number' => $this->faker->numerify('3########'),
            'gender_type' => $this->faker->randomElement(['M', 'F']),
            'is_married' => $this->faker->boolean(),
            'user_type' => $type,
            'hospital_id' => in_array($type, ['doctor', 'nurse', 'pharmacist', 'patient', 'admin'])
                ? Hospital::inRandomOrder()->first()?->id
                : null,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}