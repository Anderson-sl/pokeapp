<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonType extends Model
{
    use HasFactory;
    protected $table = 'pokemon_types';
    public $incrementing = false;
    protected $primaryKey = 'pkm_typ_id';
    protected $fillable = [
        'pkm_typ_id',
        'pkm_typ_name',
        'pkm_typ_url',
    ];

    public function pokemons()
    {
        return $this->belongsToMany(
            Pokemon::class,
            'pokemon_types_pokemons',
            'typ_pkm_type',
            'typ_pkm_pokemon'
        );
    }
}
