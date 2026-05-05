@extends('layouts.app')

@section('content')

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #141e30, #243b55);
    color: white;
}

.page {
    display: flex;
    justify-content: center;
    padding: 40px 20px;
}

.card {
    width: 100%;
    max-width: 850px;
    background: rgba(255,255,255,0.07);
    backdrop-filter: blur(18px);
    border-radius: 26px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0,0,0,0.45);
}

/* HEADER */
.header {
    text-align: center;
    padding: 30px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.avatar {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #00ffcc;
    box-shadow: 0 0 18px rgba(0,255,204,0.25);
}

.name {
    margin-top: 12px;
    font-size: 24px;
    font-weight: 700;
}

.meta {
    font-size: 14px;
    color: #cbd5e1;
    margin-top: 4px;
}

.rating {
    display: inline-block;
    margin-top: 10px;
    background: #00ffcc;
    color: #0f172a;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: bold;
}

/* SECTION */
.section {
    padding: 22px;
}

.title {
    font-size: 14px;
    color: #00ffcc;
    margin-bottom: 12px;
    font-weight: 600;
}

/* GRID CARDS */
.grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.item {
    background: rgba(255,255,255,0.06);
    border-radius: 14px;
    padding: 12px;
    transition: 0.2s ease;
}

.item:hover {
    transform: translateY(-3px);
    background: rgba(255,255,255,0.1);
}

.label {
    font-size: 12px;
    color: #94a3b8;
}

.value {
    margin-top: 4px;
    font-size: 15px;
    font-weight: 600;
}

/* COMMENTS */
.comment {
    background: rgba(255,255,255,0.06);
    padding: 14px;
    border-radius: 14px;
    line-height: 1.6;
    color: #e2e8f0;
}

/* BUTTONS */
.buttons {
    display: flex;
    justify-content: center;
    gap: 12px;
    padding: 20px;
    flex-wrap: wrap;
}

.btn {
    padding: 12px 20px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.25s;
}

.btn:hover {
    transform: scale(1.05);
}

.back { background: #00ffcc; color: #0f172a; }
.edit { background: #3b82f6; color: white; }
.home { background: #f59e0b; color: white; }

</style>

<div class="page">

    <div class="card">

        <!-- HEADER -->
        <div class="header">

            <img class="avatar"
                src="{{ $player->photo ? asset('storage/'.$player->photo) : 'https://via.placeholder.com/150' }}">

            <div class="name">{{ $player->name }}</div>
            <div class="meta">{{ $player->position }} • {{ $player->club ?? 'No Club' }}</div>

            <div class="rating">⭐ {{ $player->overall_rating ?? 'N/A' }}</div>

        </div>

        <!-- BASIC INFO -->
        <div class="section">
            <div class="title">Basic Info</div>

            <div class="grid">
                <div class="item"><div class="label">DOB</div><div class="value">{{ $player->date_of_birth ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Nationality</div><div class="value">{{ $player->nationality ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Height</div><div class="value">{{ $player->height ?? 'N/A' }} cm</div></div>
                <div class="item"><div class="label">Weight</div><div class="value">{{ $player->weight ?? 'N/A' }} kg</div></div>
                <div class="item"><div class="label">Foot</div><div class="value">{{ $player->preferred_foot ?? 'N/A' }}</div></div>
            </div>
        </div>

        <!-- TECHNICAL -->
        <div class="section">
            <div class="title">Technical</div>

            <div class="grid">
                <div class="item"><div class="label">Passing</div><div class="value">{{ $player->passing ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Dribbling</div><div class="value">{{ $player->dribbling ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Shooting</div><div class="value">{{ $player->shooting ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">First Touch</div><div class="value">{{ $player->first_touch ?? 'N/A' }}</div></div>
            </div>
        </div>

        <!-- PHYSICAL -->
        <div class="section">
            <div class="title">Physical & Mental</div>

            <div class="grid">
                <div class="item"><div class="label">Speed</div><div class="value">{{ $player->speed ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Stamina</div><div class="value">{{ $player->stamina ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Strength</div><div class="value">{{ $player->strength ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Agility</div><div class="value">{{ $player->agility ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Composure</div><div class="value">{{ $player->composure ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Decision</div><div class="value">{{ $player->decision_making ?? 'N/A' }}</div></div>
            </div>
        </div>

        <!-- COMMENTS -->
        <div class="section">
            <div class="title">Scout Notes</div>
            <div class="comment">
                {{ $player->comments ?? 'No comments available.' }}
            </div>
        </div>

        <!-- BUTTONS -->
        <div class="buttons">
            <a href="{{ route('players.index') }}" class="btn back">Back</a>
            <a href="{{ route('players.edit', $player->id) }}" class="btn edit">Edit</a>
            <a href="{{ route('home') }}" class="btn home">Home</a>
        </div>

    </div>

</div>

@endsection
