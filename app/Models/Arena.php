<?php
namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
class Arena extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'endereco',
        'telefone',
        'descricao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
