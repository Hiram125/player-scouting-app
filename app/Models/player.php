<?php

<<<<<<< HEAD
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Report;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
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
    'passing',
    'dribbling',
    'strength',
    'overall_rating',
    'comments',
    'photo'
    ];

    public function reports()
    {
        return $this->hasMany(Report::class, 'player_id');
=======
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
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
    }
}