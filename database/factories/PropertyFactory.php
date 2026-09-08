<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'         => User::factory(),
            'title'           => fake()->words(3, true),
            'address'         => fake()->streetAddress(),
            'city'            => fake()->city(),
            'price_per_night' => fake()->numberBetween(50000, 300000),
            'capacity'        => fake()->numberBetween(1, 8),
            'description'     => fake()->paragraph(),
            'status'          => 'active',
        ];
    }
}