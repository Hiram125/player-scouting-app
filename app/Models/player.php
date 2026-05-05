<?php

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
        'photo',
        'scouted_date'
    ];

    protected $casts = [
        'scouted_date' => 'date',
        'date_of_birth' => 'date',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class, 'player_id');
    }

    public function latestReport()
    {
        return $this->hasOne(Report::class)->latestOfMany('created_at');
    }
}