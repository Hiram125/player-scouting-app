@extends('layouts.app')

@section('content')

<style>
.wrapper {
    padding: 24px;
}

.header h1 {
    font-size: 28px;
    font-weight: 800;
    color: #f9fafb;
}

.header p {
    color: #9ca3af;
    font-size: 14px;
}

.filters input,
.filters select {
    background: #111827;
    border: 1px solid #1f2937;
    color: #e5e7eb;
    padding: 12px;
    border-radius: 10px;
}

.count {
    color: #9ca3af;
}

.btn {
    background: linear-gradient(45deg, #2563eb, #1d4ed8);
    color: white;
    padding: 10px 18px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
    transition: all 0.25s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(37, 99, 235, 0.6);
}

.card {
    background: #111827;
    border: 1px solid #1f2937;
    border-radius: 14px;
    overflow: hidden;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #0f172a;
}

th {
    color: #9ca3af;
    padding: 14px;
    text-align: left;
    font-size: 12px;
    text-transform: uppercase;
}

td {
    padding: 14px;
    border-top: 1px solid #1f2937;
    color: #e5e7eb;
}

tr:hover {
    background: #0f172a;
}

.name {
    color: white;
    font-weight: 700;
}

.meta {
    color: #9ca3af;
    font-size: 12px;
}

.badge {
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    border: 1px solid transparent;
}

.bg-green {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
    border-color: rgba(34, 197, 94, 0.4);
}

.bg-yellow {
    background: rgba(234, 179, 8, 0.2);
    color: #eab308;
    border-color: rgba(234, 179, 8, 0.4);
}

.bg-red {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
    border-color: rgba(239, 68, 68, 0.4);
}

.bg-gray {
    background: rgba(148, 163, 184, 0.2);
    color: #94a3b8;
    border-color: rgba(148, 163, 184, 0.4);
}

.action-btn {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
    display: inline-block;
}

.view-btn {
    background: rgba(96, 165, 250, 0.15);
    color: #60a5fa;
}

.view-btn:hover {
    background: #60a5fa;
    color: #0b0f19;
}

.edit-btn {
    background: rgba(251, 191, 36, 0.15);
    color: #fbbf24;
}

.edit-btn:hover {
    background: #fbbf24;
    color: #0b0f19;
}

.delete-btn {
    background: rgba(248, 113, 113, 0.15);
    color: #f87171;
    border: none;
    cursor: pointer;
}

.delete-btn:hover {
    background: #f87171;
    color: #0b0f19;
}
</style>

<div class="wrapper">

    <div class="header">
        <h1>Scouting Intelligence Dashboard</h1>
        <p>Player evaluation & recruitment overview</p>
    </div>

    <div class="filters" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:10px;margin:20px 0;">
        <input type="text" placeholder="Search player or club...">

        <select>
            <option>All Positions</option>
            <option>ST</option>
            <option>CM</option>
            <option>CB</option>
            <option>LW</option>
        </select>

        <select>
            <option>All Recommendations</option>
            <option>reject</option>
            <option>continue scouting</option>
            <option>sign immediately</option>
        </select>
    </div>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;">
        <div class="count">
            Total Players: {{ count($players) }}
        </div>

        <a href="{{ route('players.create') }}" class="btn">
            ➕ Add Player
        </a>
    </div>

    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>Player</th>
                    <th>Pos</th>
                    <th>Recommendation</th>
                    <th>Scouted</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($players as $player)

                <tr>

                    <td>
                        <div class="name">{{ $player->name }}</div>
                        <div class="meta">{{ $player->club }} · {{ $player->nationality }}</div>
                    </td>

                    <td>{{ $player->position }}</td>

                    <td>
                        @php
                            $rec = strtolower(trim(optional($player->latestReport)->recommendation));
                        @endphp

                        <span class="badge
                            @if($rec === 'sign immediately') bg-green
                            @elseif($rec === 'continue scouting') bg-yellow
                            @elseif($rec === 'reject') bg-red
                            @else bg-gray
                            @endif
                        ">
                            {{ optional($player->latestReport)->recommendation ?? 'No Report' }}
                        </span>
                    </td>

                    <td class="meta">
                        {{ $player->scouted_date }}
                    </td>

                    <td style="display:flex; gap:8px;">

                        <a href="{{ route('players.show', $player->id) }}" class="action-btn view-btn">
                            View
                        </a>

                        <a href="{{ route('players.edit', $player->id) }}" class="action-btn edit-btn">
                            Edit
                        </a>

                        <form action="{{ route('players.destroy', $player->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete player?')" class="action-btn delete-btn">
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection