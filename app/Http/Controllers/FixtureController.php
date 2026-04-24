<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixture;

class FixtureController extends Controller
{
    public function index()
    {
        $fixtures = Fixture::latest()->get();
        return view('fixtures.index', compact('fixtures'));
    }

    public function create()
    {
        return view('fixtures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_team' => 'required|string|max:255',
            'away_team' => 'required|string|max:255',
            'fixture_date' => 'required|date',
            'competition' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'home_score' => 'nullable|integer',
            'away_score' => 'nullable|integer',
        ]);

        Fixture::create($validated);

        return redirect()->route('fixtures.index')
            ->with('success', 'Fixture created successfully!');
    }

    // 🗑 DELETE FIXTURE (ADDED)
    public function destroy(Fixture $fixture)
    {
        $fixture->delete();

        return redirect()->route('fixtures.index')
            ->with('success', 'Fixture deleted successfully!');
    }
}