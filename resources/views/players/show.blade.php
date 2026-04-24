<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

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
            color: #ffffff;
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

        .extra-info {
            background: #1f4068;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .comments {
            background: #1f4068;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
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
</head>

<body>

<div class="container">

    <h1>👤 Player Profile</h1>

    <div class="card">

        <div class="player-header">
            @if($player->photo)
                <img src="{{ asset('storage/'.$player->photo) }}" alt="Player photo">
            @else
                <img src="https://via.placeholder.com/150" alt="No photo">
            @endif

            <div class="player-info">
                <h2>{{ $player->name }}</h2>
                <p>{{ $player->position }} | {{ $player->club ?? 'No Club' }}</p>
                <p>⭐ Overall Rating: {{ $player->overall_rating ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- 📊 Reports --}}
        <div class="reports-count">
            📊 Reports Available: {{ $player->reports->count() ?? 0 }}
        </div>

        {{-- 🧍 PLAYER PROFILE INFO --}}
        <div class="extra-info">
            <p><strong>Date of Birth:</strong> {{ $player->date_of_birth ?? 'N/A' }}</p>
            <p><strong>Nationality:</strong> {{ $player->nationality ?? 'N/A' }}</p>
            <p><strong>Height:</strong> {{ $player->height ? $player->height . ' cm' : 'N/A' }}</p>
            <p><strong>Weight:</strong> {{ $player->weight ? $player->weight . ' kg' : 'N/A' }}</p>
            <p><strong>Preferred Foot:</strong> {{ $player->preferred_foot ?? 'N/A' }}</p>
        </div>

        {{-- 📝 COMMENTS --}}
        <div class="comments">
            📝 {{ $player->comments ?? 'No comments' }}
        </div>

        {{-- 🔘 BUTTONS --}}
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

</body>
</html>
=======
@extends('layouts.app')

@section('content')
<div class="container my-5">

    <!-- Player Profile Header -->
    <div class="row mb-4">
        <div class="col-md-12 d-flex flex-column justify-content-center text-center">
            <!-- Styled Player Name -->
            <h1 class="display-4 fw-bold player-name">{{ $player->name }}</h1>
            <h4 class="text-muted">{{ $player->position }}</h4>
            <p class="mt-3"><strong>Age:</strong> {{ $player->age }} | <strong>Club:</strong> {{ $player->club ?? 'N/A' }}</p>
            
            <!-- Action Buttons -->
            <div class="mt-3">
                <a href="{{ route('players.edit', $player->id) }}" class="btn btn-primary btn-lg me-2">
                    ✏️ Edit Player
                </a>
                <a href="{{ route('players.index') }}" class="btn btn-secondary btn-lg">
                    ⬅ Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Player Ratings Section -->
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Player Ratings</h4>
        </div>
        <div class="card-body">

            @php
                $technical = round(($player->passing + $player->dribbling + $player->shooting)/3);
                $physical = round(($player->pace + $player->strength)/2);
                $overall = round(($technical + $physical)/2);

                if ($overall >= 80) {
                    $classification = 'Elite';
                } elseif ($overall >= 60) {
                    $classification = 'Pro';
                } elseif ($overall >= 40) {
                    $classification = 'Intermediate';
                } else {
                    $classification = 'Beginner';
                }
            @endphp

            <!-- Ratings badges -->
            <ul class="list-group mb-4">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Technical
                    <span class="badge bg-primary fs-6">{{ $technical }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Physical
                    <span class="badge bg-success fs-6">{{ $physical }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Overall
                    <span class="badge bg-dark fs-6">{{ $overall }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Classification
                    <span class="badge bg-warning text-dark fs-6">{{ $classification }}</span>
                </li>
            </ul>

            <!-- Ability Breakdown -->
            <h5 class="mb-3">Ability Breakdown</h5>
            @foreach(['Passing'=>'passing','Dribbling'=>'dribbling','Shooting'=>'shooting','Pace'=>'pace','Strength'=>'strength'] as $label=>$field)
                <div class="mb-2">
                    <label class="fw-bold">{{ $label }}</label>
                    <div class="progress">
                        <div class="progress-bar 
                                    @if($label=='Passing') bg-info 
                                    @elseif($label=='Dribbling') bg-success 
                                    @elseif($label=='Shooting') bg-danger 
                                    @elseif($label=='Pace') bg-warning 
                                    @else bg-secondary @endif" 
                             role="progressbar" 
                             style="width: {{ $player->$field }}%">
                            {{ $player->$field }}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Match Statistics Section -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Match Statistics</h4>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3 mb-2">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <h5>{{ $player->matches ?? 0 }}</h5>
                        <p class="mb-0">Matches Played</p>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <h5>{{ $player->goals ?? 0 }}</h5>
                        <p class="mb-0">Goals</p>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <h5>{{ $player->assists ?? 0 }}</h5>
                        <p class="mb-0">Assists</p>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <h5>{{ $player->minutes_played ?? 0 }}</h5>
                        <p class="mb-0">Minutes Played</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Comments</h4>
        </div>
        <div class="card-body">
            <p>{{ $player->comments ?? 'No comments provided' }}</p>
        </div>
    </div>

</div>

<!-- Custom Styles -->
<style>
/* Page background */
body {
    background: #f0f8f5; /* soft minty shade */
}

/* Player name styling */
.player-name {
    font-family: 'Poppins', 'Segoe UI', sans-serif;
    background: linear-gradient(90deg, #34ace0, #33d9b2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

/* Cards styling */
.card {
    border-radius: 1rem;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
</style>
@endsection
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
