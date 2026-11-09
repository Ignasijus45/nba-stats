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
}
