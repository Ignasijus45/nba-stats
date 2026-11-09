<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $homeScore = fake()->numberBetween(85, 135);
        $awayScore = fake()->numberBetween(85, 135);

        if ($awayScore === $homeScore) {
            $awayScore++;
        }

        return [
            'home_team_id' => Team::factory(),
            'away_team_id' => Team::factory(),
            'home_score' => $homeScore,
            'away_score' => $awayScore,
            'played_at' => fake()->dateTimeBetween('-5 months', 'now'),
        ];
    }
}
