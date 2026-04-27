@extends('layouts.app')

@section('content')

<style>
.page-title {
    text-align: center;
    font-size: 2.2rem;
    margin-bottom: 10px;
    color: #00ffcc;
}

.sub-text {
    text-align: center;
    margin-bottom: 30px;
    color: #94a3b8;
}

.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}

/* PLAYER CARD */
.player-card {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(15px);
    border-radius: 18px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    transition: 0.3s;
}

.player-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.6);
}

.player-img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #00ffcc;
    margin-bottom: 15px;
}

.player-name {
    font-size: 1.2rem;
    font-weight: bold;
    color: white;
}

.player-meta {
    font-size: 0.9rem;
    color: #94a3b8;
    margin-bottom: 10px;
}

.rating {
    font-size: 1.3rem;
    color: #00ffcc;
    margin-bottom: 10px;
}

/* BUTTONS */
.btn-group {
    display: flex;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
}

.btn {
    padding: 8px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    text-decoration: none;
    color: white;
    transition: 0.3s;
}

.btn-view {
    background: linear-gradient(45deg, #00c6ff, #0072ff);
}

.btn-edit {
    background: linear-gradient(45deg, #ffb347, #ffcc33);
    color: black;
}

.btn-delete {
    background: linear-gradient(45deg, #ff416c, #ff4b2b);
}

.btn:hover {
    transform: scale(1.05);
}
</style>

<!-- PAGE HEADER -->
<h1 class="page-title">⚽ Players Dashboard</h1>
<p class="sub-text">View and manage all player profiles</p>

<!-- ADD BUTTON -->
<div style="text-align:center; margin-bottom: 25px;">
    <a href="{{ route('players.create') }}" class="btn btn-view">
        ➕ Add New Player
    </a>
</div>

<!-- PLAYERS GRID -->
<div class="cards-grid">

    @foreach($players as $player)

        <div class="player-card">

            @if($player->photo)
                <img src="{{ asset('storage/'.$player->photo) }}" class="player-img">
            @else
                <img src="https://via.placeholder.com/110" class="player-img">
            @endif

            <div class="player-name">{{ $player->name }}</div>

            <div class="player-meta">
                {{ $player->position }} • {{ $player->club ?? 'No Club' }}
            </div>

            <div class="rating">
                ⭐ {{ $player->overall_rating ?? 'N/A' }}
            </div>

            <div class="btn-group">
                <a href="{{ route('players.show', $player->id) }}" class="btn btn-view">View</a>
                <a href="{{ route('players.edit', $player->id) }}" class="btn btn-edit">Edit</a>

                <form action="{{ route('players.destroy', $player->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-delete" onclick="return confirm('Delete player?')">
                        Delete
                    </button>
                </form>
            </div>

        </div>

    @endforeach

</div>

@endsection