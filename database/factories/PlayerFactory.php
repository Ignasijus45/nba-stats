<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'name' => fake()->firstNameMale().' '.fake()->lastName(),
            'position' => fake()->randomElement(['G', 'F', 'C']),
        ];
    }
}
