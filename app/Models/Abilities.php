<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abilities extends Model
{
    use HasFactory;
    protected $table = 'abilities';
    public $incrementing = false;
    protected $primaryKey = 'abt_id';
    protected $fillable = [
        'abt_id',
        'abt_name',
        'abt_url',
    ];

    public function pokemons()
    {
        return $this->belongsToMany(
            Pokemon::class,
            'pokemon_abilities',
            'pkm_abt_abilities',
            'pkm_abt_pokemon'
        );
    }
}
