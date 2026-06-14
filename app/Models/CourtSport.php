<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtSport extends Model
{
    protected $table = 'court_sports';

    // A tabela court_sports só tem created_at (sem updated_at).
    public $timestamps = false;

    protected $fillable = [
        'court_id',
        'sport',
    ];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }
}
