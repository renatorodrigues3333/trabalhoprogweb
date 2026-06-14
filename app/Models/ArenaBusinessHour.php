<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArenaBusinessHour extends Model
{
    protected $table = 'arena_business_hours';

    protected $fillable = [
        'arena_id',
        'day_of_week',
        'opens_at',
        'closes_at',
    ];

    public function arena()
    {
        return $this->belongsTo(Arena::class);
    }
}
