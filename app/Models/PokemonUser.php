<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonUser extends Model
{
    use HasFactory;
    protected $table = 'pokemons_users';
    protected $primaryKey = 'pokemon_id';
    protected $fillable = [
        'pokemon_id',
        'user_id'
    ];
}
