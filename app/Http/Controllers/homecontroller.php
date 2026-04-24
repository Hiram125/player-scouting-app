<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class HomeController extends Controller
{
    public function index()
    {
        $totalPlayers = Player::count();
        $topPlayer = Player::orderBy('overall_rating', 'desc')->first();

        return view('home', compact('totalPlayers', 'topPlayer'));
    }
}