<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $query = Team::query()->withCount('players');

        if ($search) {
            $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('city', 'like', '%'.$search.'%');
        }

        $teams = $query->orderBy('city')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('teams.index', [
            'teams' => $teams,
            'search' => $search,
        ]);
    }

    public function show(Team $team): View
    {
        $games = $team->games()
            ->with('homeTeam', 'awayTeam')
            ->orderByDesc('played_at')
            ->get();

        $played = $games->count();
        $wins = 0;
        $pointsFor = 0;
        $pointsAgainst = 0;

        foreach ($games as $game) {
            $pointsFor += $game->pointsFor($team);
            $pointsAgainst += $game->pointsAgainst($team);

            if ($game->wonBy($team)) {
                $wins++;
            }
        }

        $losses = $played - $wins;
        $winPercent = $played > 0 ? round($wins / $played * 100) : 0;
        $avgFor = $played > 0 ? round($pointsFor / $played, 1) : 0;
        $avgAgainst = $played > 0 ? round($pointsAgainst / $played, 1) : 0;

        return view('teams.show', [
            'team' => $team,
            'players' => $team->players()->orderBy('name')->get(),
            'lastGames' => $games->take(5),
            'wins' => $wins,
            'losses' => $losses,
            'winPercent' => $winPercent,
            'avgFor' => $avgFor,
            'avgAgainst' => $avgAgainst,
        ]);
    }
}
