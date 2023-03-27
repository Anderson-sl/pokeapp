<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonUser extends Model
{
    use HasFactory;
    protected $table = 'tbpokemons';
    protected $fillable = [
        'index',
        'id_user'
    ];
}
