@extends('layouts.app')

@section('content')

<div class="scout-wrapper">

    <div class="scout-card">

        <h2 class="floating">✏️ Edit Player</h2>

        @if($errors->any())
            <div style="color:red; margin-bottom:15px;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('players.update', $player->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="hero-section">

                <div class="image-circle">
                    <img id="preview"
                         src="{{ $player->photo ? asset('storage/'.$player->photo) : 'https://via.placeholder.com/180' }}"
                         alt="Player Image">
                </div>

                <input type="file" name="photo" onchange="previewImage(event)" class="file-input">

                <input type="text" name="name" value="{{ old('name', $player->name) }}" class="player-name" required>

            </div>

            <div class="info-grid">

                <div>
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $player->date_of_birth) }}">
                </div>

                <div>
                    <label>Nationality</label>
                    <input type="text" name="nationality" value="{{ old('nationality', $player->nationality) }}">
                </div>

                <div>
                    <label>Height (cm)</label>
                    <input type="number" name="height" step="0.1" value="{{ old('height', $player->height) }}">
                </div>

                <div>
                    <label>Weight (kg)</label>
                    <input type="number" name="weight" step="0.1" value="{{ old('weight', $player->weight) }}">
                </div>

                <div>
                    <label>Preferred Foot</label>
                    <select name="preferred_foot">
                        <option value="">Select</option>
                        <option value="Right" {{ $player->preferred_foot == 'Right' ? 'selected' : '' }}>Right</option>
                        <option value="Left" {{ $player->preferred_foot == 'Left' ? 'selected' : '' }}>Left</option>
                        <option value="Both" {{ $player->preferred_foot == 'Both' ? 'selected' : '' }}>Both</option>
                    </select>
                </div>

                <div>
                    <label>Position</label>
                    <input type="text" name="position" value="{{ old('position', $player->position) }}">
                </div>

                <div>
                    <label>Club</label>
                    <input type="text" name="club" value="{{ old('club', $player->club) }}">
                </div>

                <div>
                    <label>Overall Rating</label>
                    <input type="number" name="overall_rating" value="{{ old('overall_rating', $player->overall_rating) }}">
                </div>

            </div>

            <button type="submit">Update Player</button>

        </form>

    </div>

</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<style>
body {
    background: radial-gradient(circle at top, #0f172a, #020617);
    font-family: 'Segoe UI', sans-serif;
    color: white;
    margin: 0;
}

.scout-wrapper {
    display: flex;
    justify-content: center;
    padding: 40px;
}

.scout-card {
    width: 100%;
    max-width: 600px;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 30px;
    text-align: center;
}

.floating {
    font-size: 26px;
    margin-bottom: 20px;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
    100% { transform: translateY(0px); }
}

.image-circle {
    width: 180px;
    height: 180px;
    margin: auto;
    border-radius: 50%;
    border: 4px solid #00d4ff;
    overflow: hidden;
    box-shadow: 0 0 25px #00d4ff;
}

.image-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.file-input {
    margin-top: 10px;
}

.player-name {
    margin-top: 15px;
    font-size: 22px;
    text-align: center;
    border: none;
    background: transparent;
    color: white;
    border-bottom: 2px solid #00d4ff;
    outline: none;
    width: 100%;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-top: 25px;
}

label {
    font-size: 12px;
    opacity: 0.7;
    display: block;
    margin-bottom: 5px;
}

input, select {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: none;
    background: rgba(255,255,255,0.08);
    color: white;
    outline: none;
}

button {
    margin-top: 25px;
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 30px;
    background: linear-gradient(45deg, #00d4ff, #0072ff);
    color: white;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    transform: scale(1.03);
}
</style>

@endsection