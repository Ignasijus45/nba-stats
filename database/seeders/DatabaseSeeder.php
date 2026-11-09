<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $teams = [
            ['city' => 'Atlanta', 'name' => 'Hawks', 'conference' => 'East'],
            ['city' => 'Boston', 'name' => 'Celtics', 'conference' => 'East'],
            ['city' => 'Brooklyn', 'name' => 'Nets', 'conference' => 'East'],
            ['city' => 'Charlotte', 'name' => 'Hornets', 'conference' => 'East'],
            ['city' => 'Chicago', 'name' => 'Bulls', 'conference' => 'East'],
            ['city' => 'Cleveland', 'name' => 'Cavaliers', 'conference' => 'East'],
            ['city' => 'Detroit', 'name' => 'Pistons', 'conference' => 'East'],
            ['city' => 'Indiana', 'name' => 'Pacers', 'conference' => 'East'],
            ['city' => 'Miami', 'name' => 'Heat', 'conference' => 'East'],
            ['city' => 'Milwaukee', 'name' => 'Bucks', 'conference' => 'East'],
            ['city' => 'New York', 'name' => 'Knicks', 'conference' => 'East'],
            ['city' => 'Orlando', 'name' => 'Magic', 'conference' => 'East'],
            ['city' => 'Philadelphia', 'name' => '76ers', 'conference' => 'East'],
            ['city' => 'Toronto', 'name' => 'Raptors', 'conference' => 'East'],
            ['city' => 'Washington', 'name' => 'Wizards', 'conference' => 'East'],
            ['city' => 'Dallas', 'name' => 'Mavericks', 'conference' => 'West'],
            ['city' => 'Denver', 'name' => 'Nuggets', 'conference' => 'West'],
            ['city' => 'Golden State', 'name' => 'Warriors', 'conference' => 'West'],
            ['city' => 'Houston', 'name' => 'Rockets', 'conference' => 'West'],
            ['city' => 'Los Angeles', 'name' => 'Clippers', 'conference' => 'West'],
            ['city' => 'Los Angeles', 'name' => 'Lakers', 'conference' => 'West'],
            ['city' => 'Memphis', 'name' => 'Grizzlies', 'conference' => 'West'],
            ['city' => 'Minnesota', 'name' => 'Timberwolves', 'conference' => 'West'],
            ['city' => 'New Orleans', 'name' => 'Pelicans', 'conference' => 'West'],
            ['city' => 'Oklahoma City', 'name' => 'Thunder', 'conference' => 'West'],
            ['city' => 'Phoenix', 'name' => 'Suns', 'conference' => 'West'],
            ['city' => 'Portland', 'name' => 'Trail Blazers', 'conference' => 'West'],
            ['city' => 'Sacramento', 'name' => 'Kings', 'conference' => 'West'],
            ['city' => 'San Antonio', 'name' => 'Spurs', 'conference' => 'West'],
            ['city' => 'Utah', 'name' => 'Jazz', 'conference' => 'West'],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }

        $allTeams = Team::all();

        foreach ($allTeams as $team) {
            Player::factory()->count(5)->for($team)->create();
        }

        for ($i = 0; $i < 200; $i++) {
            $home = $allTeams->random();
            $away = $allTeams->where('id', '!=', $home->id)->random();

            Game::factory()->create([
                'home_team_id' => $home->id,
                'away_team_id' => $away->id,
            ]);
        }
    }
}
