<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quadras extends Model
{
    protected $fillable = [
        'arena_id',
        'nome',
        'descricao',
        'preco',
        'disponibilidade',
    ];

    public function arena()
    {
        return $this->belongsTo(Arena::class);
    }
}
