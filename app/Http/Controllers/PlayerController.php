<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    // Show all players
    public function index(Request $request)
    {
        $query = Player::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('club', 'like', '%'.$request->search.'%')
                  ->orWhere('position', 'like', '%'.$request->search.'%');
        }

        if ($request->has('position') && $request->position != '') {
            $query->where('position', $request->position);
        }

        $players = $query->get();

        return view('players.index', compact('players'));
    }

    // Show form to create a new player
    public function create()
    {
        return view('players.create');
    }

    // Save new player
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:10|max:50',
            'position' => 'required|string',
            'club' => 'nullable|string|max:255',
            'pace' => 'required|integer|min:0|max:100',
            'shooting' => 'required|integer|min:0|max:100',
            'passing' => 'required|integer|min:0|max:100',
            'dribbling' => 'required|integer|min:0|max:100',
            'strength' => 'required|integer|min:0|max:100',
            'comments' => 'nullable|string|max:500',
            'matches' => 'nullable|integer|min:0',
            'goals' => 'nullable|integer|min:0',
            'assists' => 'nullable|integer|min:0',
            'minutes_played' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = '/storage/' . $path;
        }

        Player::create($data);

        return redirect()->route('players.index')->with('success', 'Player added successfully.');
    }

    // Show single player
    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    // Show form to edit a player
    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

    // Update player
    public function update(Request $request, Player $player)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:10|max:50',
            'position' => 'required|string',
            'club' => 'nullable|string|max:255',
            'pace' => 'required|integer|min:0|max:100',
            'shooting' => 'required|integer|min:0|max:100',
            'passing' => 'required|integer|min:0|max:100',
            'dribbling' => 'required|integer|min:0|max:100',
            'strength' => 'required|integer|min:0|max:100',
            'comments' => 'nullable|string|max:500',
            'matches' => 'nullable|integer|min:0',
            'goals' => 'nullable|integer|min:0',
            'assists' => 'nullable|integer|min:0',
            'minutes_played' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($player->photo) {
                $oldPath = str_replace('/storage/', '', $player->photo);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = '/storage/' . $path;
        }

        $player->update($data);

        return redirect()->route('players.show', $player->id)->with('success', 'Player updated successfully.');
    }

    // Delete player
    public function destroy(Player $player)
    {
        if ($player->photo) {
            $oldPath = str_replace('/storage/', '', $player->photo);
            Storage::disk('public')->delete($oldPath);
        }

        $player->delete();
        return redirect()->route('players.index')->with('success', 'Player deleted successfully.');
    }

    // Search player by name (homepage search)
    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $name = $request->input('name');

        $player = Player::where('name', $name)->first();

        if ($player) {
            return redirect()->route('players.show', $player->id);
        } else {
            return redirect()->back()->with('error', 'Player not found!');
        }
    }

    // NEW: Stats for Chart.js (Step 3)
    public function statsChart()
    {
        // Fetch only fields needed for the graph
        $players = Player::select(
            'name', 
            'goals', 
            'assists', 
            'matches', 
            'minutes_played'
        )->get();

        // Pass to Blade (you can create players.stats or reuse existing Blade)
        return view('players.stats', compact('players'));
    }
}