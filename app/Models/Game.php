<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['home_team_id', 'away_team_id', 'home_score', 'away_score', 'played_at'])]
class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'played_at' => 'date',
        ];
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function isHomeTeam(Team $team): bool
    {
        return $this->home_team_id === $team->id;
    }

    public function pointsFor(Team $team): int
    {
        return $this->isHomeTeam($team) ? $this->home_score : $this->away_score;
    }

    public function pointsAgainst(Team $team): int
    {
        return $this->isHomeTeam($team) ? $this->away_score : $this->home_score;
    }

    public function wonBy(Team $team): bool
    {
        return $this->pointsFor($team) > $this->pointsAgainst($team);
    }

    public function opponentOf(Team $team): Team
    {
        return $this->isHomeTeam($team) ? $this->awayTeam : $this->homeTeam;
    }
}
