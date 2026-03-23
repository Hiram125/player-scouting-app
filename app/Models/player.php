<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    // Existing method(s) you might already have can stay here
    // For example, listing players in your Blade
    public function index()
    {
        $players = Player::all(); // fetch all players
        return view('players.index', compact('players')); // existing Blade
    }

    // NEW Step 3: method for Chart.js stats
    public function statsChart()
    {
        // fetch only fields needed for the graph
        $players = Player::select(
            'name', 
            'goals', 
            'assists', 
            'matches', 
            'minutes_played'
        )->get();

        // pass to Blade (create players.stats or use existing)
        return view('players.stats', compact('players'));
    }
}