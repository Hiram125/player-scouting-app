<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Players Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
            color: white;
        }

        .container {
            text-align: center;
            padding: 40px;
        }

        h1 {
            margin: 10px 0;
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }

        .search-bar {
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            padding: 10px 15px;
            border-radius: 25px;
            border: none;
            outline: none;
            font-size: 1rem;
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.4);
            transition: 0.4s;
            text-align: center;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .player-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            margin-bottom: 15px;
        }

        .rating {
            font-size: 1.5rem;
            margin: 10px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 30px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: 0.4s;
        }

        .btn-view { background: linear-gradient(45deg, #00c6ff, #0072ff); }
        .btn-edit { background: linear-gradient(45deg, #ffb347, #ffcc33); color: black; }
        .btn-delete { background: linear-gradient(45deg, #ff416c, #ff4b2b); }

        .btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(255,255,255,0.6);
        }
    </style>
</head>

<body>

<div class="container">

    <div style="margin-bottom: 20px;">
        <a href="{{ route('home') }}" class="btn btn-view">
            🏠 Back to Home
        </a>
    </div>

    <!-- ✅ ONLY PLACE TO CREATE PLAYER -->
    <div style="margin-bottom: 20px;">
        <a href="{{ route('players.create') }}" class="btn btn-view">
            ➕ Add New Player
        </a>
    </div>

    <h1 class="floating">⚽ Players Dashboard</h1>

    <input type="text" id="searchInput" class="search-bar" placeholder="Search by player name...">

    <div class="cards" id="playersContainer">

        @foreach($players as $player)

            @php
                $ratingColor = '#ff4b2b';

                if($player->overall_rating >= 80) {
                    $ratingColor = '#00ffcc';
                } elseif($player->overall_rating >= 60) {
                    $ratingColor = '#ffe066';
                }
            @endphp

            <div class="card">

                @if($player->photo)
                    <img src="{{ asset('storage/'.$player->photo) }}" class="player-img">
                @else
                    <img src="https://via.placeholder.com/120" class="player-img">
                @endif

                <h2>{{ $player->name }}</h2>
                <p>{{ $player->position }} | {{ $player->club ?? 'N/A' }}</p>

                <div class="rating" style="color: #00ffcc;">
                    ⭐ {{ $player->overall_rating ?? 'N/A' }}
                </div>

                <p>📊 {{ $player->classification ?? 'N/A' }}</p>

                <!-- ✅ ONLY PLAYER ACTIONS -->
                <div>
                    <a href="{{ route('players.show', $player->id) }}" class="btn btn-view">
                        View Player
                    </a>

                    <a href="{{ route('players.edit', $player->id) }}" class="btn btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('players.destroy', $player->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this player?')">
                            Delete
                        </button>
                    </form>
                </div>

            </div>

        @endforeach

    </div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('#playersContainer .card');

    searchInput.addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();

        cards.forEach(card => {
            const name = card.querySelector('h2').textContent.toLowerCase();
            card.style.display = name.includes(filter) ? '' : 'none';
        });
    });
</script>

</body>
</html>
=======
@extends('layouts.app')

@section('content')
<div class="container my-5">

    <!-- Dashboard Header: Title + Home Button -->
    <div class="card mb-4 shadow-sm p-3" style="background-color: #d8f0d8; border-radius: 1rem;">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="fw-bold mb-0" style="color: #2e7d32;">Players Dashboard</h1>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('home') }}" class="btn btn-success btn-lg shadow-sm">
                    🏠 Home
                </a>
                <a href="{{ route('players.create') }}" class="btn btn-primary btn-lg shadow-sm">
                    ➕ Add New Player
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($players as $player)
            @php
                $technical = round(($player->passing + $player->dribbling + $player->shooting)/3);
                $physical = round(($player->pace + $player->strength)/2);
                $overall = round(($technical + $physical)/2);

                if ($overall >= 80) $classification = 'Elite';
                elseif ($overall >= 60) $classification = 'Pro';
                elseif ($overall >= 40) $classification = 'Intermediate';
                else $classification = 'Beginner';
            @endphp

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0 hover-shadow">
                    <!-- Card Header: Name + Position + Club + Edit -->
                    <div class="position-relative text-center p-3" style="background-color: #f0fff0; border-bottom: 1px solid #cce5cc;">
                        <span class="badge bg-dark position-absolute top-0 end-0 m-2 fs-6">
                            {{ $overall }} ★
                        </span>
                        <h5 class="card-title mb-0">{{ $player->name }}</h5>
                        <p class="text-muted mb-1">{{ $player->position }}</p>
                        <p class="text-muted"><small>{{ $player->club ?? 'No Club' }}</small></p>

                        <!-- Edit Button -->
                        <a href="{{ route('players.edit', $player->id) }}" class="btn btn-sm btn-primary mt-2">
                            ✏️ Edit Player
                        </a>
                    </div>

                    <!-- Stats -->
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item">
                            <strong>Matches:</strong> {{ $player->matches ?? 0 }} |
                            <strong>Goals:</strong> {{ $player->goals ?? 0 }} |
                            <strong>Assists:</strong> {{ $player->assists ?? 0 }}
                        </li>
                    </ul>

                    <!-- Card Body: View + Delete -->
                    <div class="card-body text-center">
                        <a href="{{ route('players.show', $player->id) }}" 
                           class="btn btn-sm btn-info me-1 mb-1"
                           data-bs-toggle="tooltip" 
                           data-bs-placement="top" 
                           title="Rating: {{ $overall }} | Classification: {{ $classification }}">
                            👁 View
                        </a>

                        <div class="btn-group mb-1">
                            <button type="button" class="btn btn-sm btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                🗑 Delete
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="px-3 py-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Are you sure you want to delete this player?')">
                                            Confirm Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if($players->isEmpty())
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No players found. <a href="{{ route('players.create') }}" class="alert-link">Add a new player</a>.
                </div>
            </div>
        @endif
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});
</script>

<style>
/* Hover effect on player cards */
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    transition: all 0.3s ease-in-out;
}

/* Soft background for entire dashboard */
body {
    background: #f0f8f5; /* subtle minty green shade */
}

/* Header title */
h1.fw-bold {
    font-family: 'Poppins', 'Segoe UI', sans-serif;
}

/* Buttons hover */
.btn-lg:hover, .btn-sm:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    transition: all 0.2s ease-in-out;
}

/* Cards styling */
.card {
    border-radius: 1rem;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
</style>
@endsection
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
