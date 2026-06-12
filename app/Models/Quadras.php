<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quadras extends Model
{
    public function arena()
    {
        return $this->belongsTo(Arena::class);
    }
}
