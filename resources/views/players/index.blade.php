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