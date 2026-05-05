@extends('layouts.app')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #1f2c34, #3a4f63);
    font-family: 'Poppins', sans-serif;
    color: white;
}

.container {
    max-width: 1000px;
    margin: auto;
    padding: 40px 20px;
    text-align: center;
}

h1 {
    margin-bottom: 10px;
}

.sub {
    color: #cfd8dc;
    margin-bottom: 30px;
}

.grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

.slot {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

.slot-title {
    font-weight: bold;
    margin-bottom: 10px;
    color: #00ffcc;
}

select {
    width: 100%;
    padding: 10px;
    border-radius: 12px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.15);
    color: white;
    font-weight: bold;
}

select option {
    color: black;
}

.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 25px;
    border-radius: 30px;
    background: linear-gradient(45deg, #00c6ff, #0072ff);
    color: white;
    text-decoration: none;
    font-weight: bold;
    border: none;
    cursor: pointer;
}

.btn:hover {
    transform: scale(1.05);
}

/* comparison section */
.compare-box {
    display: flex;
    gap: 20px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.player-card {
    flex: 1;
    min-width: 300px;
    background: rgba(255,255,255,0.08);
    padding: 20px;
    border-radius: 18px;
}

.player-card h2 {
    color: #00ffcc;
}

.stat {
    display: flex;
    justify-content: space-between;
    margin: 5px 0;
    padding: 5px 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
</style>

<div class="container">

    <h1>⚖️ Compare Players</h1>
    <p class="sub">Select 2 players for detailed comparison</p>

    <form method="POST" action="{{ route('compare.compare') }}">
        @csrf

        <div class="grid">

            <div class="slot">
                <div class="slot-title">Player 1</div>
                <select name="player1_id" required>
                    <option value="">Select player...</option>
                    @foreach($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }} ({{ $player->position }})</option>
                    @endforeach
                </select>
            </div>

            <div class="slot">
                <div class="slot-title">Player 2</div>
                <select name="player2_id" required>
                    <option value="">Select player...</option>
                    @foreach($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }} ({{ $player->position }})</option>
                    @endforeach
                </select>
            </div>

        </div>

        <button type="submit" class="btn">Compare Players</button>
    </form>

    @if(isset($player1) && isset($player2))

    <div class="compare-box">

        <div class="player-card">
            <h2>{{ $player1->name }}</h2>

            <div class="stat"><span>Passing</span><span>{{ $player1->passing }}</span></div>
            <div class="stat"><span>Dribbling</span><span>{{ $player1->dribbling }}</span></div>
            <div class="stat"><span>Shooting</span><span>{{ $player1->shooting }}</span></div>
            <div class="stat"><span>Speed</span><span>{{ $player1->speed }}</span></div>
            <div class="stat"><span>Stamina</span><span>{{ $player1->stamina }}</span></div>
            <div class="stat"><span>Strength</span><span>{{ $player1->strength }}</span></div>
        </div>

        <div class="player-card">
            <h2>{{ $player2->name }}</h2>

            <div class="stat"><span>Passing</span><span>{{ $player2->passing }}</span></div>
            <div class="stat"><span>Dribbling</span><span>{{ $player2->dribbling }}</span></div>
            <div class="stat"><span>Shooting</span><span>{{ $player2->shooting }}</span></div>
            <div class="stat"><span>Speed</span><span>{{ $player2->speed }}</span></div>
            <div class="stat"><span>Stamina</span><span>{{ $player2->stamina }}</span></div>
            <div class="stat"><span>Strength</span><span>{{ $player2->strength }}</span></div>
        </div>

    </div>

    @endif

</div>

@endsection