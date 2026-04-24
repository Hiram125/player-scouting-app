<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = [
        'home_team',
        'away_team',
        'fixture_date',
        'competition',
        'venue',
    ];
}
