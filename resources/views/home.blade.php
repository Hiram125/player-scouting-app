@extends('layouts.app')

@section('content')

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

    </div>

</div>

@endsection