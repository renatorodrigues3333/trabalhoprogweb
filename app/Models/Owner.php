<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'tax_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function arenas()
    {
        return $this->hasMany(Arena::class);
    }
}
