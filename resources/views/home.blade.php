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
    padding: 50px 20px;
    text-align: center;
}

h1 {
    font-size: 3rem;
    margin-bottom: 10px;
}

.sub {
    color: #d1d1d1;
    margin-bottom: 40px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 25px;
}

.card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    border-radius: 18px;
    padding: 25px;
    transition: 0.4s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

.card:hover {
    transform: translateY(-8px);
}

.icon {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.btn {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
    color: white;
}

.btn-blue { background: linear-gradient(45deg, #00c6ff, #0072ff); }
.btn-green { background: linear-gradient(45deg, #00ff87, #00c853); }
.btn-orange { background: linear-gradient(45deg, #ffb347, #ffcc33); color: black; }
.btn-dark { background: linear-gradient(45deg, #232526, #414345); }

.btn:hover {
    transform: scale(1.08);
}
</style>

<div class="container">

    <h1>⚽ Scouting System</h1>
    <p class="sub">Manage players, analyze performance, and compare talent</p>

    <div class="cards">

        <div class="card">
            <div class="icon">👟</div>
            <h3>Players</h3>
            <p>View and manage all player profiles</p>
            <a href="{{ route('players.index') }}" class="btn btn-blue">Open</a>
        </div>

        <div class="card">
            <div class="icon">➕</div>
            <h3>Add Player</h3>
            <p>Create new player profiles</p>
            <a href="{{ route('players.create') }}" class="btn btn-green">Add</a>
        </div>

        <div class="card">
            <div class="icon">📊</div>
            <h3>Reports</h3>
            <p>Performance scouting reports</p>
            <a href="{{ route('reports.index') }}" class="btn btn-orange">View</a>
        </div>

        <div class="card">
            <div class="icon">📅</div>
            <h3>Fixtures</h3>
            <p>Match schedules and games</p>
            <a href="{{ route('fixtures.index') }}" class="btn btn-dark">Open</a>
        </div>

        <div class="card">
            <div class="icon">⚖️</div>
            <h3>Compare</h3>
            <p>Compare up to 4 players side-by-side</p>
            <a href="{{ route('compare.index') }}" class="btn btn-blue">Compare</a>
        </div>

    </div>

</div>

@endsection