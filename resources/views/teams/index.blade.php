@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4">Teams</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="GET" action="/teams" class="d-flex mb-3">
            <input name="search" value="{{ $search }}" placeholder="Search by team or city" class="form-control me-2">
            <button type="submit" class="btn btn-primary me-2">Search</button>
            <a href="/teams" class="btn btn-light">Clear</a>
        </form>

        <table class="table table-hover">
            <tr class="table-light">
                <th>Team</th>
                <th>Conference</th>
                <th class="text-end">Players</th>
            </tr>
            @forelse ($teams as $team)
                <tr>
                    <td><a href="/teams/{{ $team->id }}" class="text-decoration-none">{{ $team->city }} <strong>{{ $team->name }}</strong></a></td>
                    <td><span class="badge bg-secondary">{{ $team->conference }}</span></td>
                    <td class="text-end">{{ $team->players_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-muted">No teams found.</td>
                </tr>
            @endforelse
        </table>

        {{ $teams->links() }}
    </div>
</div>

@endsection
