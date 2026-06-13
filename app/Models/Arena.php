<?php
namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
class Arena extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'description',
        'address_rua',
        'address_bairro',
        'address_numero',
        'phone',
        'contact_email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
