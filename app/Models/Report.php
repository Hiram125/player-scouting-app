<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

 protected $fillable = [
    'player_id',
    'scout_name',
    'match_context',
    'report_date',
    'position',
    'club',
    'age',
    'technical_rating',
    'physical_rating',
    'passing',
    'dribbling',
    'strength',
    'strengths',
    'weaknesses',
    'comments',
    'recommendation',
    'status',
];
    

    // Link report back to player
    public function player()
{
  return $this->belongsTo(Player::class);
}
}
