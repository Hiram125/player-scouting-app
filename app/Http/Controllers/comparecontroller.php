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
        $players = array_filter($request->players);

        if (count($players) < 2) {
            return back()->with('error', 'Please select at least 2 players.');
        }

        $players = Player::whereIn('id', $players)->get();

        return view('compare.results', compact('players'));
    }
}