@extends('layouts.app')

@section('content')
<<<<<<< HEAD

<div class="scout-wrapper">

    <div class="scout-card">

        <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- PLAYER IMAGE -->
            <div class="hero-section">

                <div class="image-circle">
                    <img id="preview" src="https://via.placeholder.com/180" alt="Player Image">
                </div>

                <input type="file" name="photo" onchange="previewImage(event)" class="file-input">

                <input type="text" name="name" placeholder="Player Name" class="player-name" required>

            </div>

            <!-- SIMPLE CORE INFO -->
            <div class="info-grid">

                <div>
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth">
                </div>

                <div>
                    <label>Nationality</label>
                    <input type="text" name="nationality" placeholder="Nationality">
                </div>

                <div>
                    <label>Height (cm)</label>
                    <input type="number" step="0.1" name="height" placeholder="Height">
                </div>

                <div>
                    <label>Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" placeholder="Weight">
                </div>

                <div>
                    <label>Preferred Foot</label>
                    <select name="preferred_foot">
                        <option value="">Preferred Foot</option>
                        <option value="Right">Right</option>
                        <option value="Left">Left</option>
                        <option value="Both">Both</option>
                    </select>
                </div>

                <div>
                    <label>Position</label>
                    <input type="text" name="position">
                </div>

                <div>
                    <label>Club</label>
                    <input type="text" name="club">
                </div>

                <div>
                    <label>Overall Rating</label>
                    <input type="number" name="overall_rating">
                </div>

            </div>

            <button type="submit">Save Player</button>

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

/* IMAGE */
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

/* NAME */
.player-name {
    margin-top: 15px;
    font-size: 22px;
    text-align: center;
    border: none;
    background: transparent;
    color: white;
    border-bottom: 2px solid #00d4ff;
    outline: none;
}

/* GRID */
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

=======
<div class="container my-5">
    <h1 class="mb-4">Add New Player</h1>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Player Info -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control" value="{{ old('age') }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Position</label>
                <select name="position" class="form-control" required>
                    <option value="">Select Position</option>
                    @foreach(['GK','CB','RB','LB','CM','RW','LW','ST'] as $pos)
                        <option value="{{ $pos }}" {{ old('position')==$pos ? 'selected' : '' }}>{{ $pos }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Club & Photo -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Club</label>
                <input type="text" name="club" class="form-control" value="{{ old('club') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Player Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>
        </div>

        <!-- Attributes (0-100) -->
        <div class="row mb-3">
            <div class="col-md-2">
                <label class="form-label">Pace</label>
                <input type="number" name="pace" class="form-control" min="0" max="100" value="{{ old('pace') }}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Shooting</label>
                <input type="number" name="shooting" class="form-control" min="0" max="100" value="{{ old('shooting') }}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Passing</label>
                <input type="number" name="passing" class="form-control" min="0" max="100" value="{{ old('passing') }}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Dribbling</label>
                <input type="number" name="dribbling" class="form-control" min="0" max="100" value="{{ old('dribbling') }}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Strength</label>
                <input type="number" name="strength" class="form-control" min="0" max="100" value="{{ old('strength') }}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Comments</label>
                <input type="text" name="comments" class="form-control" value="{{ old('comments') }}">
            </div>
        </div>

        <!-- Match Stats -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Matches Played</label>
                <input type="number" name="matches" class="form-control" min="0" value="{{ old('matches') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Goals</label>
                <input type="number" name="goals" class="form-control" min="0" value="{{ old('goals') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Assists</label>
                <input type="number" name="assists" class="form-control" min="0" value="{{ old('assists') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Minutes Played</label>
                <input type="number" name="minutes_played" class="form-control" min="0" value="{{ old('minutes_played') }}">
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="mb-3">
            <button type="submit" class="btn btn-success me-2">Add Player</button>
            <a href="{{ route('players.index') }}" class="btn btn-secondary">Back</a>
        </div>

    </form>
</div>
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
@endsection