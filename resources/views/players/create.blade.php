@extends('layouts.app')

@section('content')

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #141e30, #243b55);
    color: white;
}

.wrapper {
    display: flex;
    justify-content: center;
    padding: 40px;
}

.card {
    width: 100%;
    max-width: 900px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
}

.hero {
    text-align: center;
    margin-bottom: 25px;
}

.image-circle {
    width: 140px;
    height: 140px;
    margin: auto;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #00ffcc;
    box-shadow: 0 0 20px rgba(0,255,204,0.3);
}

.image-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.name {
    margin-top: 15px;
    font-size: 26px;
    font-weight: bold;
}

.sub {
    color: #cbd5e1;
    margin-top: 5px;
}

.badge {
    display: inline-block;
    margin-top: 10px;
    padding: 6px 14px;
    border-radius: 20px;
    background: #00ffcc;
    color: #0f172a;
    font-weight: bold;
}

.section {
    margin-top: 25px;
}

.section-title {
    color: #00ffcc;
    font-weight: bold;
    margin-bottom: 12px;
    font-size: 16px;
}

.grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.item {
    background: rgba(255,255,255,0.06);
    padding: 12px;
    border-radius: 12px;
}

.label {
    font-size: 12px;
    color: #94a3b8;
}

.value {
    font-size: 16px;
    font-weight: 600;
    margin-top: 4px;
}

.comment-box {
    background: rgba(255,255,255,0.06);
    padding: 15px;
    border-radius: 12px;
    line-height: 1.6;
    color: #e2e8f0;
}

.buttons {
    margin-top: 30px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: center;
}

.btn {
    padding: 12px 22px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.btn:hover {
    transform: scale(1.05);
}

.back { background: #00ffcc; color: #0f172a; }
.edit { background: #3b82f6; color: white; }
.home { background: #f59e0b; color: white; }

</style>

<div class="wrapper">

    <div class="card">

        <div class="hero">

            <div class="image-circle">
                <img src="{{ $player->photo ? asset('storage/'.$player->photo) : 'https://via.placeholder.com/150' }}">
            </div>

            <div class="name">{{ $player->name }}</div>
            <div class="sub">{{ $player->position }} • {{ $player->club ?? 'No Club' }}</div>

            <div class="badge">⭐ {{ $player->overall_rating ?? 'N/A' }}</div>

        </div>

        <!-- BASIC -->
        <div class="section">
            <div class="section-title">Basic Info</div>
            <div class="grid">

                <div class="item">
                    <div class="label">DOB</div>
                    <div class="value">{{ $player->date_of_birth ?? 'N/A' }}</div>
                </div>

                <div class="item">
                    <div class="label">Nationality</div>
                    <div class="value">{{ $player->nationality ?? 'N/A' }}</div>
                </div>

                <div class="item">
                    <div class="label">Height</div>
                    <div class="value">{{ $player->height ?? 'N/A' }} cm</div>
                </div>

                <div class="item">
                    <div class="label">Weight</div>
                    <div class="value">{{ $player->weight ?? 'N/A' }} kg</div>
                </div>

                <div class="item">
                    <div class="label">Preferred Foot</div>
                    <div class="value">{{ $player->preferred_foot ?? 'N/A' }}</div>
                </div>

            </div>
        </div>

        <!-- TECH -->
        <div class="section">
            <div class="section-title">Technical</div>
            <div class="grid">

                <div class="item"><div class="label">Passing</div><div class="value">{{ $player->passing ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Dribbling</div><div class="value">{{ $player->dribbling ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Shooting</div><div class="value">{{ $player->shooting ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">First Touch</div><div class="value">{{ $player->first_touch ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Crossing</div><div class="value">{{ $player->crossing ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Heading</div><div class="value">{{ $player->heading ?? 'N/A' }}</div></div>

            </div>
        </div>

        <!-- PHYSICAL -->
        <div class="section">
            <div class="section-title">Physical & Mental</div>
            <div class="grid">

                <div class="item"><div class="label">Speed</div><div class="value">{{ $player->speed ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Stamina</div><div class="value">{{ $player->stamina ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Strength</div><div class="value">{{ $player->strength ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Agility</div><div class="value">{{ $player->agility ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Composure</div><div class="value">{{ $player->composure ?? 'N/A' }}</div></div>
                <div class="item"><div class="label">Decision Making</div><div class="value">{{ $player->decision_making ?? 'N/A' }}</div></div>

            </div>
        </div>

        <!-- COMMENTS -->
        <div class="section">
            <div class="section-title">Scout Notes</div>
            <div class="comment-box">
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