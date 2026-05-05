<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class CompareController extends Controller
{
    public function index()
    {
        $players = Player::all();
        return view('compare.index', compact('players'));
    }

    public function compare(Request $request)
    {
        $request->validate([
            'player1_id' => 'required|exists:players,id',
            'player2_id' => 'required|exists:players,id',
        ]);

        $player1 = Player::findOrFail($request->player1_id);
        $player2 = Player::findOrFail($request->player2_id);

        $players = [$player1, $player2];

        return view('compare.index', compact('player1', 'player2', 'players'));
    }
}