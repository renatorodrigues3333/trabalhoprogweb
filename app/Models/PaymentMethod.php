<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    // A tabela payment_methods não tem colunas de timestamps.
    public $timestamps = false;

    protected $fillable = [
        'type',
        'label',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function arenas()
    {
        return $this->belongsToMany(Arena::class, 'arena_payment_methods');
    }
}
