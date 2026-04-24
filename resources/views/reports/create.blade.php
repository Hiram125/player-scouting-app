<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>New Scouting Report</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: radial-gradient(circle at top, #0f2027, #203a43, #2c5364);
    color: white;
}

/* CENTER LAYOUT */
.wrapper {
    max-width: 800px;
    margin: auto;
    padding: 40px 20px;
}

/* TITLE */
h1 {
    text-align: center;
    font-size: 2.2rem;
    margin-bottom: 25px;
    color: #00ffcc;
}

/* CARD FORM */
.card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
}

/* FORM FIELDS */
label {
    font-weight: 500;
    display: block;
    margin-top: 15px;
    margin-bottom: 5px;
    color: #cfe8ff;
}

input, select, textarea {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.08);
    color: white;
}

input:focus, textarea:focus, select:focus {
    box-shadow: 0 0 10px #00c6ff;
}

/* GRID FOR RATINGS */
.grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

/* BUTTONS */
.actions {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.btn {
    padding: 12px 20px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    text-align: center;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}

.btn-save {
    background: linear-gradient(45deg, #00c6ff, #0072ff);
    color: white;
    flex: 1;
}

.btn-cancel {
    background: #ff4b2b;
    color: white;
    flex: 1;
}

.btn:hover {
    transform: scale(1.05);
}

/* ERROR BOX */
.error {
    background: rgba(255,0,0,0.2);
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 15px;
    color: #ffb3b3;
}
</style>
</head>

<body>

<div class="wrapper">

<h1>📝 New Scouting Report</h1>

<div class="card">

@if ($errors->any())
    <div class="error">
        @foreach ($errors->all() as $error)
            ⚠ {{ $error }}<br>
        @endforeach
    </div>
@endif

<form action="{{ route('reports.store') }}" method="POST">
@csrf

<select name="player_id" required>
    @foreach($players as $player)
        <option value="{{ $player->id }}">
            {{ $player->name }}
        </option>
    @endforeach
</select>

<label>Scout Name</label>
<input type="text" name="scout_name" required>

<label>Match Context</label>
<input type="text" name="match_context" required>

<label>Date</label>
<input type="date" name="report_date" required>

<div class="grid">
    <div>
        <label>Technical</label>
        <input type="number" name="technical_rating">
    </div>

    <div>
        <label>Physical</label>
        <input type="number" name="physical_rating">
    </div>

    <div>
        <label>Passing</label>
        <input type="number" name="passing">
    </div>

    <div>
        <label>Dribbling</label>
        <input type="number" name="dribbling">
    </div>

    <div>
        <label>Strength</label>
        <input type="number" name="strength">
    </div>
</div>

<label>Strengths</label>
<textarea name="strengths"></textarea>

<label>Weaknesses</label>
<textarea name="weaknesses"></textarea>

<label>Comments</label>
<textarea name="comments"></textarea>

<label>Recommendation</label>
<select name="recommendation">
    <option value="">-- Choose --</option>
    <option value="Sign Immediately">Sign Immediately</option>
    <option value="Continue Scouting">Continue Scouting</option>
    <option value="Reject">Reject</option>
</select>

<div class="actions">
    <button type="submit" class="btn btn-save">💾 Save Report</button>
    <a href="{{ route('reports.index') }}" class="btn btn-cancel">Cancel</a>
</div>

</form>

</div>

</div>

</body>
</html>