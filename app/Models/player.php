<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    // Show all players in your Blade
    public function index()
    {
        $players = Player::all(); // fetch all players
        return view('players.index', compact('players')); // existing Blade
    }

    // NEW: Stats for Chart.js
    public function statsChart()
    {
        // fetch only the fields needed for the graph
        $players = Player::select(
            'name', 
            'goals', 
            'assists', 
            'matches', 
            'minutes_played'
        )->get();

        // pass data to a Blade view (resources/views/players/stats.blade.php)
        return view('players.stats', compact('players'));
    }
}