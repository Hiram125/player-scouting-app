@extends('layouts.app')

@section('content')

<style>
.page-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 5px;
}

.subtitle {
    color: #94a3b8;
    font-size: 14px;
    margin-bottom: 20px;
}

.filters {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin-bottom: 20px;
}

.filters input,
.filters select {
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #1f2937;
    background: #111827;
    color: #e5e7eb;
}

.filters button {
    grid-column: span 4;
    padding: 10px;
    background: #22c55e;
    border: none;
    border-radius: 6px;
    color: black;
    font-weight: 600;
    cursor: pointer;
}

.table {
    width: 100%;
    border-collapse: collapse;
    background: #111827;
    border-radius: 8px;
    overflow: hidden;
}

.table th {
    text-align: left;
    font-size: 12px;
    text-transform: uppercase;
    color: #94a3b8;
    padding: 12px;
    border-bottom: 1px solid #1f2937;
}

.table td {
    padding: 12px;
    border-bottom: 1px solid #1f2937;
    font-size: 14px;
}

.table tr:hover {
    background: #1f2937;
    cursor: pointer;
}

.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
}

.sign { background: #14532d; color: #22c55e; }
.monitor { background: #78350f; color: #fbbf24; }
.reject { background: #7f1d1d; color: #f87171; }

.empty {
    text-align: center;
    padding: 40px;
    color: #94a3b8;
}
</style>

<div>

    <!-- HEADER -->
    <div>
        <div class="page-title">Players</div>
        <div class="subtitle">{{ $players->total() }} total players</div>
    </div>

    <!-- FILTERS -->
    <form method="GET" class="filters">

        <input type="text" name="search" placeholder="Search player or club" value="{{ request('search') }}">

        <select name="position">
            <option value="">All Positions</option>
            @foreach($positions as $position)
                <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>
                    {{ $position }}
                </option>
            @endforeach
        </select>

        <select name="recommendation">
            <option value="">All Decisions</option>
            <option value="Sign">Sign</option>
            <option value="Monitor">Monitor</option>
            <option value="Reject">Reject</option>
        </select>

        <select name="min_score">
            <option value="">Any Score</option>
            <option value="5">5+</option>
            <option value="6">6+</option>
            <option value="7">7+</option>
            <option value="8">8+</option>
        </select>

        <button type="submit">Apply Filters</button>
    </form>

    <!-- TABLE -->
    <table class="table">

        <thead>
            <tr>
                <th>Player</th>
                <th>Pos</th>
                <th>Age</th>
                <th>Score</th>
                <th>Decision</th>
                <th>Scouted</th>
            </tr>
        </thead>

        <tbody>

        @forelse($players as $player)

            <tr onclick="window.location='/players/{{ $player->id }}'">

                <td>
                    <div style="font-weight:600;">{{ $player->name }}</div>
                    <div style="color:#94a3b8; font-size:12px;">
                        {{ $player->club }}
                    </div>
                </td>

                <td style="color:#22c55e; font-family:monospace;">
                    {{ $player->position }}
                </td>

                <td>{{ $player->age ?? '-' }}</td>

                <td style="font-weight:700;">
                    {{ $player->score ?? '-' }}
                </td>

                <td>
                    @if($player->recommendation == 'Sign')
                        <span class="badge sign">Sign</span>
                    @elseif($player->recommendation == 'Monitor')
                        <span class="badge monitor">Monitor</span>
                    @elseif($player->recommendation == 'Reject')
                        <span class="badge reject">Reject</span>
                    @else
                        <span style="color:#94a3b8;">-</span>
                    @endif
                </td>

                <td style="color:#94a3b8;">
                    {{ $player->scouted_date ?? '-' }}
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6" class="empty">
                    No players found
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

    <!-- PAGINATION -->
    <div style="margin-top:15px;">
        {{ $players->withQueryString()->links() }}
    </div>

</div>

@endsection