@extends('layouts.app')

@section('content')
<<<<<<< HEAD

<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #1f2c34, #3a4f63);
        color: white;
    }

    .container {
        max-width: 1200px;
        margin: auto;
        padding: 40px 20px;
        text-align: center;
    }

    h1 {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .floating {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .card {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 30px 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        transition: 0.4s;
        text-align: center;
    }

    .card:hover {
        transform: translateY(-5px) scale(1.03);
        box-shadow: 0 15px 40px rgba(0,0,0,0.5);
    }

    .card-icon {
        font-size: 3rem;
        margin-bottom: 15px;
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .card-desc {
        font-size: 1rem;
        margin-bottom: 20px;
        color: #d1d1d1;
    }

    .btn-card {
        display: inline-block;
        padding: 12px 25px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: bold;
        transition: 0.4s;
        color: white;
    }

    .btn-players {
        background: linear-gradient(135deg, #00c6ff, #0072ff);
    }

    .btn-players:hover {
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(0,198,255,0.6);
    }

    .btn-reports {
        background: none;
        color: #ff4b2b;
        border: 2px solid #ff4b2b;
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        transition: 0.5s;
    }

    .btn-reports::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: #ff758c;
        z-index: 0;
        transition: 0.5s;
    }

    .btn-reports:hover::before {
        left: 0;
    }

    .btn-reports:hover {
        color: white;
    }

    .btn-reports span {
        position: relative;
        z-index: 1;
    }
</style>

<div class="container">

    <h1 class="floating">Welcome to Player Management ⚽</h1>

    <p style="color:#d1d1d1; font-size:1.2rem;">
        Manage your players, view reports, and track performance easily.
    </p>

    <div class="cards">

        <!-- Players -->
        <div class="card">
            <div class="card-icon">👥</div>
            <div class="card-title">Players Dashboard</div>
            <div class="card-desc">
                View all players, manage profiles, and control your database.
            </div>
            <a href="{{ route('players.index') }}" class="btn-card btn-players">
                Go to Players
            </a>
        </div>

        <!-- Reports -->
        <div class="card">
            <div class="card-icon">📊</div>
            <div class="card-title">Reports</div>
            <div class="card-desc">
                Check detailed scouting reports and performance analysis.
            </div>
            <a href="{{ route('reports.index') }}" class="btn-card btn-reports">
                Go to Reports
            </a>
        </div>

        <!-- Fixtures (NEW) -->
        <div class="card">
            <div class="card-icon">📅</div>
            <div class="card-title">Fixtures</div>
            <div class="card-desc">
                Manage matches, schedules, and upcoming games.
            </div>
            <a href="{{ route('fixtures.index') }}" class="btn-card btn-players">
                View Fixtures
            </a>
        </div>

=======
<div class="container my-5">

    <!-- Hero Section -->
    <div class="text-center mb-4">
        <h1 class="display-3 fw-bold homepage-title">Welcome to Football Scout</h1>
        <p class="lead text-muted">Manage players, track stats, and view performance ratings all in one place.</p>

        <!-- Direct Player Search Form -->
        <form action="{{ route('players.search') }}" method="GET" class="d-flex gap-2 justify-content-center mt-3">
            <input type="text" name="name" class="form-control form-control-lg" 
                   placeholder="Enter player name..." required>
            <button type="submit" class="btn btn-success btn-lg">🔍 Search</button>
        </form>

        <!-- View Players Button -->
        <div class="mt-3">
            <a href="{{ route('players.index') }}" class="btn btn-success btn-lg">
                ⚽ View All Players
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row g-4">
        <!-- Player Management -->
        <div class="col-md-4">
            <div class="card h-100 shadow feature-card">
                <div class="card-body text-center">
                    <h4 class="card-title">Player Dashboard</h4>
                    <p class="card-text">See all players, edit stats, and track performance with ease.</p>
                    <a href="{{ route('players.index') }}" class="btn btn-primary">Go to Dashboard</a>
                </div>
            </div>
        </div>

        <!-- Add New Player -->
        <div class="col-md-4">
            <div class="card h-100 shadow feature-card">
                <div class="card-body text-center">
                    <h4 class="card-title">Add New Player</h4>
                    <p class="card-text">Quickly add new players and fill in their abilities and match stats.</p>
                    <a href="{{ route('players.create') }}" class="btn btn-success">Add Player</a>
                </div>
            </div>
        </div>

        <!-- Performance Ratings -->
        <div class="col-md-4">
            <div class="card h-100 shadow feature-card">
                <div class="card-body text-center">
                    <h4 class="card-title">Player Ratings</h4>
                    <p class="card-text">Track player technical and physical abilities with professional rating badges.</p>
                    <a href="{{ route('players.index') }}" class="btn btn-warning text-dark">View Ratings</a>
                </div>
            </div>
        </div>
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
    </div>

</div>

<<<<<<< HEAD
=======
<!-- Custom Styles -->
<style>
/* Page background */
body {
    background: #e0f7f2; /* soft minty teal */
}

/* Homepage title */
.homepage-title {
    font-family: 'Poppins', 'Segoe UI', sans-serif;
    background: linear-gradient(90deg, #34ace0, #33d9b2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

/* Cards styling */
.feature-card {
    border-radius: 1rem;
    transition: transform 0.2s, box-shadow 0.2s;
}
.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
}

/* Search input styling */
input.form-control-lg {
    border-radius: 0.5rem;
    max-width: 400px;
}
button.btn-success {
    border-radius: 0.5rem;
}
</style>
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
@endsection