@extends('layouts.app')

@section('content')

<a href="/teams" class="text-decoration-none">&larr; All teams</a>

<h1 class="h3 mt-2 mb-4">
    {{ $team->city }} {{ $team->name }}
    <span class="badge bg-secondary fs-6 align-middle">{{ $team->conference }}</span>
</h1>

<div class="row mb-4">
    <div class="col-6 col-md-3 mb-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <div class="text-muted small">Record</div>
                <div class="fs-3 fw-bold">{{ $wins }}–{{ $losses }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <div class="text-muted small">Win %</div>
                <div class="fs-3 fw-bold">{{ $winPercent }}%</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <div class="text-muted small">Points per game</div>
                <div class="fs-3 fw-bold">{{ $avgFor }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <div class="text-muted small">Points allowed</div>
                <div class="fs-3 fw-bold">{{ $avgAgainst }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h5 mb-3">Players</h2>

                @forelse ($players as $player)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>{{ $player->name }}</span>
                        <span class="badge bg-light text-dark">{{ $player->position }}</span>
                    </div>
                @empty
                    <p class="text-muted mb-0">No players.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h5 mb-3">Last 5 games</h2>

                <table class="table table-hover mb-0">
                    <tr class="table-light">
                        <th>Date</th>
                        <th>Opponent</th>
                        <th class="text-end">Score</th>
                        <th class="text-end">Result</th>
                    </tr>
                    @forelse ($lastGames as $game)
                        <tr>
                            <td>{{ $game->played_at->format('Y-m-d') }}</td>
                            <td>
                                {{ $game->isHomeTeam($team) ? 'vs' : '@' }}
                                {{ $game->opponentOf($team)->name }}
                            </td>
                            <td class="text-end">{{ $game->pointsFor($team) }}–{{ $game->pointsAgainst($team) }}</td>
                            <td class="text-end">
                                @if ($game->wonBy($team))
                                    <span class="badge bg-success">W</span>
                                @else
                                    <span class="badge bg-danger">L</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted">No games yet.</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
