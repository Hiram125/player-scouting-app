@extends('layouts.app')

@section('content')

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #141e30, #243b55);
    color: white;
}

.container {
    max-width: 900px;
    margin: 50px auto;
    padding: 20px;
}

h1 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 30px;
}

.card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    transition: 0.4s;
}

.card:hover {
    transform: scale(1.02);
}

.player-header {
    display: flex;
    align-items: center;
    gap: 30px;
    margin-bottom: 25px;
}

.player-header img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid white;
}

.player-info h2 {
    margin: 0;
    font-size: 2rem;
    color: #00ffcc;
}

.player-info p {
    margin: 5px 0;
    font-size: 1.1rem;
    color: #ccc;
}

.extra-info,
.comments {
    background: rgba(31, 64, 104, 0.8);
    border-radius: 15px;
    padding: 15px;
    margin-bottom: 20px;
    line-height: 1.8;
}

.btns {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

.btn {
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
}

.btn-back { background: #00ff87; color: black; }
.btn-home { background: #ffd700; color: #1a1a2e; }
.btn-edit { background: #00bfff; color: white; }
.btn-reports { background: #ff7b00; color: white; }

.btn:hover {
    transform: scale(1.1);
}

.reports-count {
    text-align: center;
    margin-bottom: 15px;
    font-size: 1.1rem;
    color: #00ffcc;
}
</style>

<div class="container">

    <h1>👤 Player Profile</h1>

    <div class="card">

        <div class="player-header">
            @if($player->photo)
                <img src="{{ asset('storage/'.$player->photo) }}">
            @else
                <img src="https://via.placeholder.com/150">
            @endif

            <div class="player-info">
                <h2>{{ $player->name }}</h2>
                <p>{{ $player->position }} | {{ $player->club ?? 'No Club' }}</p>
                <p>⭐ Rating: {{ $player->overall_rating ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="reports-count">
            📊 Reports Available: {{ $player->reports->count() ?? 0 }}
        </div>

        <div class="extra-info">
            <p><strong>Date of Birth:</strong> {{ $player->date_of_birth ?? 'N/A' }}</p>
            <p><strong>Nationality:</strong> {{ $player->nationality ?? 'N/A' }}</p>
            <p><strong>Height:</strong> {{ $player->height ? $player->height.' cm' : 'N/A' }}</p>
            <p><strong>Weight:</strong> {{ $player->weight ? $player->weight.' kg' : 'N/A' }}</p>
            <p><strong>Preferred Foot:</strong> {{ $player->preferred_foot ?? 'N/A' }}</p>
        </div>

        <div class="comments">
            📝 {{ $player->comments ?? 'No comments' }}
        </div>

        <div class="btns">
            <a href="{{ route('players.index') }}" class="btn btn-back">⬅ Back</a>
            <a href="{{ route('players.edit', $player->id) }}" class="btn btn-edit">✏️ Edit</a>

            @if($player->reports->count() > 0)
                <a href="{{ route('reports.show', $player->reports->first()->id) }}" class="btn btn-reports">
                    📄 View Report
                </a>
            @else
                <a href="{{ route('reports.create', ['player_id' => $player->id]) }}" class="btn btn-edit">
                    ➕ Create Report
                </a>
            @endif

            <a href="{{ route('home') }}" class="btn btn-home">🏠 Home</a>
        </div>

    </div>
</div>

@endsection
