<?php

<<<<<<< HEAD
namespace App\Http\Controllers;
=======
namespace App\Http\Controllers; // plural "Controllers"
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
<<<<<<< HEAD
    public function index()
    {
        $players = Player::all();
        return view('players.index', compact('players'));
    }

=======
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
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
    public function create()
    {
        return view('players.create');
    }

<<<<<<< HEAD
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

=======
    // Save new player
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
<<<<<<< HEAD
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

=======
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
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

<<<<<<< HEAD
=======
    // Show form to edit a player
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

<<<<<<< HEAD
=======
    // Update player
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
    public function update(Request $request, Player $player)
    {
        $request->validate([
            'name' => 'required|string|max:255',
<<<<<<< HEAD
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
=======
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

    // Stats for Chart.js
    public function statsChart()
    {
        $players = Player::select(
            'name', 
            'goals', 
            'assists', 
            'matches', 
            'minutes_played'
        )->get();

        return view('players.stats', compact('players'));
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
    }
}