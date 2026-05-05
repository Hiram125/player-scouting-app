@extends('layouts.app')

@section('content')

<div class="scout-wrapper">

    <div class="scout-card">

        @if($errors->any())
            <div style="color:red; margin-bottom:15px;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="hero-section">

                <div class="image-circle">
                    <img id="preview" src="https://via.placeholder.com/180" alt="Player Image">
                </div>

                <input type="file" name="photo" onchange="previewImage(event)" class="file-input">

                <input type="text" name="name" placeholder="Player Name" class="player-name" required>

            </div>

            <div class="info-grid">

                <div>
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth">
                </div>

                <div>
                    <label>Nationality</label>
                    <input type="text" name="nationality">
                </div>

                <div>
                    <label>Height (cm)</label>
                    <input type="number" step="0.1" name="height">
                </div>

                <div>
                    <label>Weight (kg)</label>
                    <input type="number" step="0.1" name="weight">
                </div>

                <div>
                    <label>Preferred Foot</label>
                    <select name="preferred_foot">
                        <option value="">Select</option>
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

                <!-- ✅ ADDED SCOUTED DATE HERE -->
                <div>
                    <label>Scouted Date</label>
                    <input type="date" name="scouted_date">
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