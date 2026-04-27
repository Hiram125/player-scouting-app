@extends('layouts.app')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #1f2c34, #3a4f63);
    font-family: 'Poppins', sans-serif;
    color: white;
}

.container {
    max-width: 1200px;
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
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.slot {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    transition: 0.3s;
}

.slot:hover {
    transform: translateY(-5px);
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

.note {
    margin-top: 20px;
    color: #cfd8dc;
    font-size: 0.95rem;
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
    transition: 0.3s;
    border: none;
}

.btn:hover {
    transform: scale(1.08);
}
</style>

<div class="container">

    <h1>⚖️ Compare Players</h1>
    <p class="sub">Select up to 4 players and compare their attributes side-by-side</p>

    <form method="POST" action="{{ route('compare.compare') }}">
        @csrf

        <div class="grid">
            @for($i = 1; $i <= 4; $i++)
                <div class="slot">
                    <div class="slot-title">Slot {{ $i }}</div>

                    <select name="players[]">
                        <option value="">Select player...</option>
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">
                                {{ $player->name }} ({{ $player->position }})
                            </option>
                        @endforeach
                    </select>

                </div>
            @endfor
        </div>

        <button type="submit" class="btn">
            Compare Players
        </button>

    </form>

    <div class="note">
        Select at least 2 players to see comparison results
    </div>

</div>

@endsection