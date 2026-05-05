<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $query = Player::with('latestReport');

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('club', 'like', '%'.$request->search.'%')
                  ->orWhere('position', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->has('position') && $request->position != '') {
            $query->where('position', $request->position);
        }

        $players = $query->get();

        return view('players.index', compact('players'));
    }

    public function create()
    {
        return view('players.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:50',
            'club' => 'nullable|string|max:255',
            'scouted_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'club' => $request->club,
            'scouted_date' => $request->scouted_date,

            'age' => null,
            'pace' => null,
            'shooting' => null,
            'passing' => null,
            'dribbling' => null,
            'strength' => null,
            'comments' => null,
            'matches' => null,
            'goals' => null,
            'assists' => null,
            'minutes_played' => null,
        ];

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = '/storage/' . $path;
        }

        Player::create($data);

        return redirect()->route('players.index')
            ->with('success', 'Player added successfully.');
    }

    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

    public function update(Request $request, Player $player)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:50',
            'club' => 'nullable|string|max:255',
            'scouted_date' => 'nullable|date',

            'age' => 'nullable|integer|min:10|max:50',
            'pace' => 'nullable|integer|min:0|max:100',
            'shooting' => 'nullable|integer|min:0|max:100',
            'passing' => 'nullable|integer|min:0|max:100',
            'dribbling' => 'nullable|integer|min:0|max:100',
            'strength' => 'nullable|integer|min:0|max:100',

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

        return redirect()->route('players.show', $player->id)
            ->with('success', 'Player updated successfully.');
    }

    public function destroy(Player $player)
    {
        if ($player->photo) {
            $oldPath = str_replace('/storage/', '', $player->photo);
            Storage::disk('public')->delete($oldPath);
        }

        $player->delete();

        return redirect()->route('players.index')
            ->with('success', 'Player deleted successfully.');
    }

    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $player = Player::where('name', $request->name)->first();

        if ($player) {
            return redirect()->route('players.show', $player->id);
        }

        return redirect()->back()->with('error', 'Player not found!');
    }

    public function statsChart()
    {
        $players = Player::select('name','goals','assists','matches','minutes_played')->get();

        return view('players.stats', compact('players'));
    }
}
