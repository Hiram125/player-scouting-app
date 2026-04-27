@extends('layouts.app')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color: white;
    font-family: 'Poppins', sans-serif;
}

.container {
    max-width: 1100px;
    margin: auto;
    padding: 40px 20px;
}

.title {
    text-align: center;
    font-size: 2.2rem;
    margin-bottom: 30px;
    font-weight: bold;
}

.compare-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

.card {
    background: rgba(255,255,255,0.06);
    border-radius: 20px;
    padding: 20px;
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

.player-name {
    text-align: center;
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: #00ffcc;
}

.stat {
    margin-bottom: 12px;
}

.stat label {
    display: block;
    font-size: 0.9rem;
    margin-bottom: 5px;
    color: #cbd5e1;
}

.bar {
    height: 10px;
    background: #1e293b;
    border-radius: 10px;
    overflow: hidden;
}

.fill {
    height: 100%;
    background: linear-gradient(90deg, #00c6ff, #0072ff);
    width: 0%;
    transition: 0.5s;
}

.winner {
    color: #22c55e;
    font-weight: bold;
    font-size: 0.85rem;
    margin-top: 3px;
}
</style>

<div class="container">

    <div class="title">⚖️ Player Comparison</div>

    <div class="compare-grid">

        @foreach($players as $player)
        <div class="card">

            <div class="player-name">
                {{ $player->name }}
            </div>

            @foreach([
                'pace' => 'Pace',
                'shooting' => 'Shooting',
                'passing' => 'Passing',
                'dribbling' => 'Dribbling',
                'strength' => 'Strength'
            ] as $field => $label)

                @php
                    $value = $player->{$field} ?? 0;
                    $max = $players->max($field);
                    $isWinner = $value == $max;
                @endphp

                <div class="stat">

                    <label>
                        {{ $label }}
                        @if($isWinner)
                            <span class="winner">BEST</span>
                        @endif
                    </label>

                    <div class="bar">
                        <div class="fill" style="width: {{ $value }}%;"></div>
                    </div>

                    <small>{{ $value }}</small>

                </div>

            @endforeach

        </div>
        @endforeach

    </div>

</div>

@endsection