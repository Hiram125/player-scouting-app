@extends('layouts.app')

@section('content')

<style>
    .container {
        max-width: 700px;
        margin: 40px auto;
        padding: 30px;
        background: rgba(255,255,255,0.05);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #00ffcc;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #ddd;
    }

    input, select {
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        border: none;
        outline: none;
    }

    .btn-submit {
        margin-top: 20px;
        width: 100%;
        padding: 12px;
        border-radius: 20px;
        border: none;
        font-weight: bold;
        background: linear-gradient(135deg, #00c6ff, #0072ff);
        color: white;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-submit:hover {
        transform: scale(1.05);
    }

    .btn-back {
        display: inline-block;
        margin-top: 15px;
        text-decoration: none;
        color: #00ff87;
    }
</style>

<div class="container">

    <h2>📅 Create Fixture</h2>

    <form action="{{ route('fixtures.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Home Team</label>
            <input type="text" name="home_team" required>
        </div>

        <div class="form-group">
            <label>Away Team</label>
            <input type="text" name="away_team" required>
        </div>

        <div class="form-group">
            <label>Fixture Date</label>
            <input type="date" name="fixture_date" required>
        </div>

        <div class="form-group">
            <label>Competition</label>
            <input type="text" name="competition">
        </div>
        <div class="form-group">
        <label>Venue</label>
        <input type="text" name="venue" required>
</div>
        <button type="submit" class="btn-submit">
            ➕ Save Fixture
        </button>
    </form>

    <a href="{{ route('fixtures.index') }}" class="btn-back">
        ⬅ Back to Fixtures
    </a>

</div>

@endsection