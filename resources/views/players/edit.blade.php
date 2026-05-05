@extends('layouts.app')

@section('content')

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #141e30, #243b55);
    color: white;
}

.scout-wrapper {
    display: flex;
    justify-content: center;
    padding: 40px;
}

.scout-card {
    width: 100%;
    max-width: 750px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
}

.floating {
    text-align: center;
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: #00ffcc;
}

.hero-section {
    text-align: center;
    margin-bottom: 20px;
}

.image-circle {
    width: 140px;
    height: 140px;
    margin: auto;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid white;
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
    width: 100%;
    margin-top: 10px;
    padding: 10px;
    border-radius: 10px;
    border: none;
    text-align: center;
    font-size: 18px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-top: 20px;
}

.info-grid input,
.info-grid select {
    padding: 10px;
    border-radius: 10px;
    border: none;
    background: rgba(255,255,255,0.1);
    color: white;
    outline: none;
}

.info-grid input::placeholder {
    color: #ccc;
}

button {
    margin-top: 25px;
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 25px;
    background: linear-gradient(45deg, #00ffcc, #0072ff);
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: scale(1.03);
}
</style>

<div class="scout-wrapper">

    <div class="scout-card">

        <h2 class="floating">✏️ Edit Player</h2>

        @if($errors->any())
            <div style="color:red; margin-bottom:10px;">
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
                         src="{{ $player->photo ? asset('storage/'.$player->photo) : 'https://via.placeholder.com/180' }}">
                </div>

                <input type="file" name="photo" onchange="previewImage(event)" class="file-input">

                <input type="text" name="name"
                       value="{{ old('name', $player->name) }}"
                       class="player-name" required>

            </div>

            <div class="info-grid">

                <!-- BASIC INFO -->
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $player->date_of_birth) }}">
                <input type="text" name="nationality" value="{{ old('nationality', $player->nationality) }}" placeholder="Nationality">
                <input type="number" name="height" value="{{ old('height', $player->height) }}" placeholder="Height">
                <input type="number" name="weight" value="{{ old('weight', $player->weight) }}" placeholder="Weight">

                <input type="text" name="preferred_foot" value="{{ old('preferred_foot', $player->preferred_foot) }}" placeholder="Preferred Foot">
                <input type="text" name="position" value="{{ old('position', $player->position) }}" placeholder="Position">
                <input type="text" name="club" value="{{ old('club', $player->club) }}" placeholder="Club">

                <!-- RATINGS -->
                <input type="number" name="technical_rating" value="{{ old('technical_rating', $player->technical_rating) }}" placeholder="Technical Rating">
                <input type="number" name="physical_rating" value="{{ old('physical_rating', $player->physical_rating) }}" placeholder="Physical Rating">
                <input type="number" name="overall_rating" value="{{ old('overall_rating', $player->overall_rating) }}" placeholder="Overall Rating">

                <!-- TECHNICAL -->
                <input type="number" name="passing" value="{{ old('passing', $player->passing) }}" placeholder="Passing">
                <input type="number" name="dribbling" value="{{ old('dribbling', $player->dribbling) }}" placeholder="Dribbling">
                <input type="number" name="shooting" value="{{ old('shooting', $player->shooting) }}" placeholder="Shooting">
                <input type="number" name="first_touch" value="{{ old('first_touch', $player->first_touch) }}" placeholder="First Touch">
                <input type="number" name="crossing" value="{{ old('crossing', $player->crossing) }}" placeholder="Crossing">
                <input type="number" name="heading" value="{{ old('heading', $player->heading) }}" placeholder="Heading">

                <!-- PHYSICAL -->
                <input type="number" name="speed" value="{{ old('speed', $player->speed) }}" placeholder="Speed">
                <input type="number" name="stamina" value="{{ old('stamina', $player->stamina) }}" placeholder="Stamina">
                <input type="number" name="strength" value="{{ old('strength', $player->strength) }}" placeholder="Strength">
                <input type="number" name="agility" value="{{ old('agility', $player->agility) }}" placeholder="Agility">

                <!-- MENTAL -->
                <input type="number" name="composure" value="{{ old('composure', $player->composure) }}" placeholder="Composure">
                <input type="number" name="work_ethic" value="{{ old('work_ethic', $player->work_ethic) }}" placeholder="Work Ethic">
                <input type="number" name="decision_making" value="{{ old('decision_making', $player->decision_making) }}" placeholder="Decision Making">

                <!-- EXTRA -->
                <input type="date" name="scouted_date" value="{{ old('scouted_date', $player->scouted_date) }}">

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

@endsection