<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Reports</title>

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
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #ffeb3b;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 30px;
            opacity: 0.8;
        }

        .card {
            background: rgba(255,255,255,0.08);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.02);
            background: rgba(255,255,255,0.12);
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .label {
            font-weight: bold;
            color: #ffeb3b;
        }

        .btn-back {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            background: linear-gradient(45deg, #00ff87, #60efff);
            color: black;
            transition: 0.4s;
        }

        .btn-back:hover {
            transform: scale(1.05);
        }

        .no-data {
            text-align: center;
            opacity: 0.7;
            margin-top: 20px;
        }

        .rating-box {
            margin-top: 10px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .badge {
            background: rgba(0,0,0,0.3);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>📊 {{ $player->name }} Reports</h1>

    <div class="subtitle">
        Position: {{ $player->position ?? 'N/A' }} |
        Club: {{ $player->club ?? 'N/A' }}
    </div>

    @if($reports->count() > 0)

        @foreach($reports->sortByDesc('created_at') as $report)

            <div class="card">

                <div class="grid">
                    <div><span class="label">Scout:</span> {{ $report->scout_name }}</div>
                    <div><span class="label">Date:</span> {{ $report->report_date }}</div>
                    <div><span class="label">Match:</span> {{ $report->match_context }}</div>
                    <div><span class="label">Status:</span> {{ $report->status ?? 'N/A' }}</div>
                </div>

                <div class="rating-box">
                    <span class="badge">⚙️ Technical: {{ $report->technical_rating ?? 'N/A' }}</span>
                    <span class="badge">💪 Physical: {{ $report->physical_rating ?? 'N/A' }}</span>
                    <span class="badge">🎯 Passing: {{ $report->passing ?? 'N/A' }}</span>
                    <span class="badge">🕺 Dribbling: {{ $report->dribbling ?? 'N/A' }}</span>
                    <span class="badge">🏋️ Strength: {{ $report->strength ?? 'N/A' }}</span>
                </div>

                <p style="margin-top:10px;">
                    <span class="label">Comments:</span>
                    {{ $report->comments ?? 'No comments' }}
                </p>

            </div>

        @endforeach

    @else
        <div class="no-data">No reports found for this player.</div>
    @endif

    {{-- NAVIGATION FIX --}}
    <a href="{{ route('players.show', $player->id) }}" class="btn-back">⬅ Back to Player Profile</a>

</div>

</body>
</html>