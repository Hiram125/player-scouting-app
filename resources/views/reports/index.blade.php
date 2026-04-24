<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1f1c2c, #928dab);
            color: white;
        }

        .container {
            padding: 40px;
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #ffeb3b;
        }

        .top-bar {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            margin: 5px;
        }

        .btn-home {
            background: #00c6ff;
            color: white;
        }

        .btn-create {
            background: #00ff87;
            color: black;
        }

        .search-bar {
            text-align: center;
            margin-bottom: 30px;
        }

        .search-bar input {
            padding: 10px;
            width: 300px;
            border-radius: 8px;
            border: none;
            outline: none;
        }

        .search-bar button {
            padding: 10px 15px;
            border: none;
            background: #3490dc;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            margin-left: 5px;
        }

        .search-bar a {
            margin-left: 10px;
            color: #ffeb3b;
            text-decoration: none;
            font-weight: bold;
        }

        .card {
            background: rgba(255,255,255,0.08);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .player-name {
            font-size: 1.3rem;
            color: #00ffcc;
            margin-bottom: 10px;
        }

        .report {
            background: rgba(255,255,255,0.05);
            padding: 10px;
            margin-top: 10px;
            border-radius: 10px;
        }

        .delete-btn {
            background: #e43f5a;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 10px;
        }

        .delete-btn:hover {
            opacity: 0.85;
            transform: scale(1.03);
        }
    </style>
</head>

<body>

<div class="container">

    <h1>📊 Reports Dashboard</h1>

    <div class="top-bar">
        <a href="{{ route('home') }}" class="btn btn-home">🏠 Home</a>
        <a href="{{ route('reports.create') }}" class="btn btn-create">➕ Create Report</a>
    </div>

    <!-- 🔍 SEARCH BAR ADDED HERE -->
    <div class="search-bar">
        <form method="GET" action="{{ route('reports.index') }}">
            <input 
                type="text" 
                name="search" 
                placeholder="Search by player, scout, or match..." 
                value="{{ $search ?? '' }}"
            >

            <button type="submit">Search</button>

            <!-- Reset -->
            <a href="{{ route('reports.index') }}">Reset</a>
        </form>
    </div>

    @foreach($players as $player)

        <div class="card">

            <div class="player-name">
                ⚽ {{ $player->name }}
            </div>

            <p>{{ $player->position }} | {{ $player->club ?? 'N/A' }}</p>

            @if($player->reports->count())

                @foreach($player->reports as $report)

                    <div class="report">
                        <p><strong>Scout:</strong> {{ $report->scout_name }}</p>
                        <p><strong>Match:</strong> {{ $report->match_context }}</p>
                        <p><strong>Date:</strong> {{ $report->report_date }}</p>
                        <p><strong>Recommendation:</strong> {{ $report->recommendation ?? 'N/A' }}</p>

                        <!-- View button -->
                        <a href="{{ route('reports.show', $report->id) }}" class="btn btn-home">
                            View Report
                        </a>

                        <!-- DELETE BUTTON -->
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this report?')"
                              style="display:inline-block; margin-left:10px;">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-btn">
                                🗑 Delete
                            </button>
                        </form>

                    </div>

                @endforeach

            @else
                <p>No reports yet.</p>
            @endif

        </div>

    @endforeach

</div>

</body>
</html>