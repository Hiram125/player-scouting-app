<!DOCTYPE html>
<html>
<head>
    <title>Fixtures</title>

    <style>
        body {
            background: #0f172a;
            color: white;
            font-family: Arial;
        }

        .container {
            width: 800px;
            margin: auto;
            padding: 20px;
        }

        .card {
            background: #1e293b;
            padding: 15px;
            margin: 10px 0;
            border-radius: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px;
            background: green;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>📅 Fixtures</h1>

    <!-- 🏠 BACK TO HOME BUTTON -->
    <div style="margin-bottom:20px;">
        <a href="{{ route('home') }}" style="
            display:inline-block;
            padding:10px 18px;
            background:#00c6ff;
            color:white;
            border-radius:20px;
            text-decoration:none;
            font-weight:bold;
        ">
            🏠 Back to Home
        </a>
    </div>

    <a href="{{ route('fixtures.create') }}" class="btn">➕ Create Fixture</a>

    @foreach($fixtures as $fixture)

        <div class="card">

            <h3>{{ $fixture->home_team }} vs {{ $fixture->away_team }}</h3>

            <p>Date: {{ $fixture->fixture_date }}</p>
            <p>Competition: {{ $fixture->competition ?? 'N/A' }}</p>
            <p>Venue: {{ $fixture->venue ?? 'N/A' }}</p>

            <p>
                Score:
                {{ $fixture->home_score ?? '-' }}
                -
                {{ $fixture->away_score ?? '-' }}
            </p>

            <!-- 🗑 DELETE BUTTON -->
            <form action="{{ route('fixtures.destroy', $fixture->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this fixture?')">

                @csrf
                @method('DELETE')

                <button type="submit" style="
                    margin-top:10px;
                    background:#e43f5a;
                    color:white;
                    padding:10px 15px;
                    border:none;
                    border-radius:8px;
                    cursor:pointer;
                    font-weight:bold;
                ">
                    🗑 Delete Fixture
                </button>

            </form>

        </div>

    @endforeach

</div>

</body>
</html>