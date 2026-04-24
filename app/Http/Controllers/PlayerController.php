<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::all();
        return view('players.index', compact('players'));
    }

    public function create()
    {
        return view('players.create');
    }

    private function calculateRating($player)
    {
        $player->overall_rating = round(
            ($player->technical_rating +
             $player->physical_rating +
             $player->dribbling +
             $player->strength +
             $player->passing) / 5
        );

        if ($player->overall_rating >= 85) {
            $player->classification = 'Elite';
        } elseif ($player->overall_rating >= 70) {
            $player->classification = 'Pro';
        } elseif ($player->overall_rating >= 50) {
            $player->classification = 'Amateur';
        } else {
            $player->classification = 'Beginner';
        }

        return $player;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'preferred_foot' => 'nullable|string',

            'position' => 'nullable|string|max:255',
            'club' => 'nullable|string|max:255',
            'overall_rating' => 'nullable|integer|min:0|max:100',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $player = new Player();

        $player->name = $request->name;
        $player->date_of_birth = $request->date_of_birth;
        $player->nationality = $request->nationality;
        $player->height = $request->height;
        $player->weight = $request->weight;
        $player->preferred_foot = $request->preferred_foot;

        $player->position = $request->position;
        $player->club = $request->club;
        $player->overall_rating = $request->overall_rating;

        if ($request->hasFile('photo')) {
            $player->photo = $request->file('photo')->store('players', 'public');
        }

        $player->save();

        return redirect()->route('players.show', $player->id)
            ->with('success', 'Player created successfully!');
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
            'date_of_birth' => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'preferred_foot' => 'nullable|string',

            'position' => 'nullable|string|max:255',
            'club' => 'nullable|string|max:255',

            'technical_rating' => 'nullable|integer|min:0|max:100',
            'physical_rating' => 'nullable|integer|min:0|max:100',
            'dribbling' => 'nullable|integer|min:0|max:100',
            'strength' => 'nullable|integer|min:0|max:100',
            'passing' => 'nullable|integer|min:0|max:100',

            'comments' => 'nullable|string|max:500',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $player->fill($request->only([
            'name',
            'date_of_birth',
            'nationality',
            'height',
            'weight',
            'preferred_foot',
            'position',
            'club',
            'technical_rating',
            'physical_rating',
            'dribbling',
            'strength',
            'passing',
            'comments'
        ]));

        if ($request->hasFile('photo')) {
            if ($player->photo && Storage::disk('public')->exists($player->photo)) {
                Storage::disk('public')->delete($player->photo);
            }

            $player->photo = $request->file('photo')->store('players', 'public');
        }

        $player = $this->calculateRating($player);

        $player->save();

        return redirect()->route('players.show', $player->id)
            ->with('success', 'Player updated successfully!');
    }

    public function destroy(Player $player)
    {
        if ($player->photo && Storage::disk('public')->exists($player->photo)) {
            Storage::disk('public')->delete($player->photo);
        }

        $player->delete();

        return redirect()->route('players.index')
            ->with('success', 'Player deleted successfully!');
    }
}