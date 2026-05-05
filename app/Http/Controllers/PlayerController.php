<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $query = Player::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('club', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        $players = $query->latest()->paginate(15);

        $positions = Player::select('position')->distinct()->pluck('position');

        return view('players.index', compact('players', 'positions'));
    }

    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    public function create()
    {
        return view('players.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'date_of_birth' => 'nullable',
            'nationality' => 'nullable',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'preferred_foot' => 'nullable',
            'position' => 'required',
            'club' => 'nullable',

            'passing' => 'nullable|numeric',
            'dribbling' => 'nullable|numeric',
            'shooting' => 'nullable|numeric',
            'first_touch' => 'nullable|numeric',
            'crossing' => 'nullable|numeric',
            'heading' => 'nullable|numeric',
            'strength' => 'nullable|numeric',
            'speed' => 'nullable|numeric',
            'stamina' => 'nullable|numeric',
            'agility' => 'nullable|numeric',

            'composure' => 'nullable|numeric',
            'work_ethic' => 'nullable|numeric',
            'decision_making' => 'nullable|numeric',

            'technical_rating' => 'nullable|numeric',
            'physical_rating' => 'nullable|numeric',
            'overall_rating' => 'nullable|numeric',

            'comments' => 'nullable',
            'scouted_date' => 'nullable',
        ]);

        // HANDLE PHOTO PROPERLY
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('players', 'public');
        }

        Player::create($data);

        return redirect()->route('players.index');
    }

    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

    public function update(Request $request, Player $player)
    {
        $data = $request->validate([
            'name' => 'required',
            'date_of_birth' => 'nullable',
            'nationality' => 'nullable',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'preferred_foot' => 'nullable',
            'position' => 'required',
            'club' => 'nullable',

            'passing' => 'nullable|numeric',
            'dribbling' => 'nullable|numeric',
            'shooting' => 'nullable|numeric',
            'first_touch' => 'nullable|numeric',
            'crossing' => 'nullable|numeric',
            'heading' => 'nullable|numeric',
            'strength' => 'nullable|numeric',
            'speed' => 'nullable|numeric',
            'stamina' => 'nullable|numeric',
            'agility' => 'nullable|numeric',

            'composure' => 'nullable|numeric',
            'work_ethic' => 'nullable|numeric',
            'decision_making' => 'nullable|numeric',

            'technical_rating' => 'nullable|numeric',
            'physical_rating' => 'nullable|numeric',
            'overall_rating' => 'nullable|numeric',

            'comments' => 'nullable',
            'scouted_date' => 'nullable',
        ]);

        // PHOTO UPDATE FIX
        if ($request->hasFile('photo')) {

            // delete old photo if exists
            if ($player->photo) {
                Storage::disk('public')->delete($player->photo);
            }

            $data['photo'] = $request->file('photo')->store('players', 'public');
        }

        $player->update($data);

        return redirect()->route('players.show', $player->id);
    }
}