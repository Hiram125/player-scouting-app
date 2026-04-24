<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #1a1a2e;
            color: #eee;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #ffd700;
            margin-bottom: 30px;
        }

        .report-card {
            background: #162447;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.5);
        }

        .player-header {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 25px;
        }

        .player-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #ffd700;
            object-fit: cover;
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

        .section {
            background: #1f4068;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .section h3 {
            color: #ffd700;
            margin-bottom: 10px;
        }

        .btns {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-back, .btn-home {
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-back {
            background: #00ff87;
            color: black;
        }

        .btn-home {
            background: #ffd700;
            color: #1a1a2e;
        }

        .btn-back:hover, .btn-home:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>

<div class="container">

    <h1>📄 Player Report</h1>

    <div class="report-card">

        {{-- PLAYER HEADER --}}
        <div class="player-header">

            @if($report->player->photo)
                <img src="{{ asset('storage/'.$report->player->photo) }}" alt="Player photo">
            @else
                <img src="https://via.placeholder.com/120" alt="No photo">
            @endif

            <div class="player-info">
                <h2>{{ $report->player->name }}</h2>

                <p>
                    {{ $report->player->position }} |
                    {{ $report->player->club ?? 'No Club' }}
                </p>

                <p>
                    ⭐ Overall Rating: {{ $report->player->overall_rating ?? 'N/A' }}
                </p>

                <p>
                    🧑‍💼 Scout: {{ $report->scout_name }} |
                    📅 Date: {{ $report->report_date }}
                </p>
            </div>
        </div>

        {{-- 📊 SCOUT RATINGS --}}
        <div class="section">
            <h3>📊 Scout Ratings</h3>

            <p><strong>Technical Rating:</strong> {{ $report->technical_rating ?? 'N/A' }}</p>

            <p><strong>Physical Rating:</strong> {{ $report->physical_rating ?? 'N/A' }}</p>

            <p><strong>Passing:</strong> {{ $report->passing ?? 'N/A' }}</p>

            <p><strong>Dribbling:</strong> {{ $report->dribbling ?? 'N/A' }}</p>

            <p><strong>Strength:</strong> {{ $report->strength ?? 'N/A' }}</p>
        </div>

        {{-- 💪 STRENGTHS --}}
        <div class="section">
            <h3>💪 Strengths</h3>
            <p>{{ $report->strengths ?? 'N/A' }}</p>
        </div>

        {{-- ⚠️ WEAKNESSES --}}
        <div class="section">
            <h3>⚠️ Weaknesses</h3>
            <p>{{ $report->weaknesses ?? 'N/A' }}</p>
        </div>

        {{-- 📝 COMMENTS --}}
        <div class="section">
            <h3>📝 Comments</h3>
            <p>{{ $report->comments ?? 'N/A' }}</p>
        </div>

        {{-- 🔘 BUTTONS --}}
        <div class="btns">
            <a href="{{ route('reports.index') }}" class="btn-back">⬅ Back to Reports</a>
            <a href="{{ route('home') }}" class="btn-home">🏠 Home</a>
        </div>

    </div>
</div>

</body>
</html>