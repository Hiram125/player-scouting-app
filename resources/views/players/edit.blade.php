@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="floating">✏️ Edit Player</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">

        <div class="text-center mb-4">
            @if($player->photo)
                <img src="{{ asset('storage/'.$player->photo) }}" class="player-img">
            @else
                <img src="https://via.placeholder.com/150" class="player-img">
            @endif
        </div>

        <form action="{{ route('players.update', $player->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-3">
                <label class="form-label text-white">Name</label>
                <input type="text" name="name" value="{{ old('name', $player->name) }}" class="form-control">
            </div>

            {{-- Date of Birth --}}
            <div class="mb-3">
                <label class="form-label text-white">Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $player->date_of_birth) }}" class="form-control">
            </div>

            {{-- Nationality --}}
            <div class="mb-3">
                <label class="form-label text-white">Nationality</label>
                <input type="text" name="nationality" value="{{ old('nationality', $player->nationality) }}" class="form-control">
            </div>

            {{-- Height --}}
            <div class="mb-3">
                <label class="form-label text-white">Height (cm)</label>
                <input type="number" step="0.1" name="height" value="{{ old('height', $player->height) }}" class="form-control">
            </div>

            {{-- Weight --}}
            <div class="mb-3">
                <label class="form-label text-white">Weight (kg)</label>
                <input type="number" step="0.1" name="weight" value="{{ old('weight', $player->weight) }}" class="form-control">
            </div>

            {{-- Preferred Foot --}}
            <div class="mb-3">
                <label class="form-label text-white">Preferred Foot</label>
                <select name="preferred_foot" class="form-control">
                    <option value="">Preferred Foot</option>
                    <option value="Right" {{ old('preferred_foot', $player->preferred_foot) == 'Right' ? 'selected' : '' }}>Right</option>
                    <option value="Left" {{ old('preferred_foot', $player->preferred_foot) == 'Left' ? 'selected' : '' }}>Left</option>
                    <option value="Both" {{ old('preferred_foot', $player->preferred_foot) == 'Both' ? 'selected' : '' }}>Both</option>
                </select>
            </div>

            {{-- Position --}}
            <div class="mb-3">
                <label class="form-label text-white">Position</label>
                <input type="text" name="position" value="{{ old('position', $player->position) }}" class="form-control">
            </div>

            {{-- Club --}}
            <div class="mb-3">
                <label class="form-label text-white">Club</label>
                <input type="text" name="club" value="{{ old('club', $player->club) }}" class="form-control">
            </div>

            {{-- Age --}}
            <div class="mb-3">
                <label class="form-label text-white">Age</label>
                <input type="number" name="age" value="{{ old('age', $player->age) }}" class="form-control">
            </div>

            {{-- Stats --}}
            <div class="mb-3">
                <label class="form-label text-white">Technical Rating</label>
                <input type="number" name="technical_rating" value="{{ old('technical_rating', $player->technical_rating) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Physical Rating</label>
                <input type="number" name="physical_rating" value="{{ old('physical_rating', $player->physical_rating) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Passing</label>
                <input type="number" name="passing" value="{{ old('passing', $player->passing) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Dribbling</label>
                <input type="number" name="dribbling" value="{{ old('dribbling', $player->dribbling) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Strength</label>
                <input type="number" name="strength" value="{{ old('strength', $player->strength) }}" class="form-control">
            </div>

            {{-- Strengths --}}
            <div class="mb-3">
                <label class="form-label text-white">Strengths</label>
                <textarea name="strengths" class="form-control">{{ old('strengths', $player->strengths) }}</textarea>
            </div>

            {{-- Weaknesses --}}
            <div class="mb-3">
                <label class="form-label text-white">Weaknesses</label>
                <textarea name="weaknesses" class="form-control">{{ old('weaknesses', $player->weaknesses) }}</textarea>
            </div>

            {{-- Comments --}}
            <div class="mb-3">
                <label class="form-label text-white">Comments</label>
                <textarea name="comments" class="form-control">{{ old('comments', $player->comments) }}</textarea>
            </div>

            {{-- Photo --}}
            <div class="mb-3">
                <label class="form-label text-white">Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>

            {{-- Buttons --}}
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-edit">💾 Update Player</button>
                <a href="{{ route('players.show', $player->id) }}" class="btn btn-back">⬅ Cancel</a>
            </div>

        </form>

    </div>
</div>

<style>
body {
    background: linear-gradient(135deg, #141e30, #243b55);
    font-family: 'Poppins', sans-serif;
    color: white;
}

.floating {
    text-align: center;
    font-size: 2.5rem;
    font-weight: bold;
    margin: 30px 0;
    color: #ffffff;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
    100% { transform: translateY(0px); }
}

.card {
    max-width: 700px;
    margin: auto;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    transition: 0.4s;
}

.card:hover { transform: scale(1.02); }

.player-img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid white;
    margin-bottom: 20px;
}

input.form-control, textarea.form-control, select.form-control {
    background: rgba(255,255,255,0.05);
    border: none;
    color: white;
    border-radius: 10px;
    padding: 10px;
}

input.form-control:focus, textarea.form-control:focus, select.form-control:focus {
    background: rgba(255,255,255,0.12);
    outline: none;
    box-shadow: 0 0 10px rgba(0,198,255,0.5);
}

.btn {
    display: inline-block;
    padding: 12px 25px;
    margin: 5px;
    border-radius: 30px;
    text-decoration: none;
    color: white;
    font-weight: bold;
    transition: 0.4s;
}

.btn-edit {
    background: linear-gradient(45deg, #00c6ff, #0072ff);
}

.btn-back {
    background: linear-gradient(45deg, #00ff87, #60efff);
    color: black;
}

.btn:hover {
    transform: scale(1.1);
    box-shadow: 0 0 15px rgba(255,255,255,0.6);
}
</style>
@endsection