<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;

class Pokemon extends ModelBase
{

    use HasFactory;
    public $baseExternalUrl = '';
    protected $table = 'pokemons';
    protected $primaryKey = 'pkm_id';
    protected $fillable = [
        'pkm_id',
        'pkm_name',
        'pkm_species',
        'pkm_base_experience',
        'pkm_height',
        'pkm_weight',
        'pkm_image',
        'pkm_url',
    ];

    public function __construct(array $attributes = [])
    {
        $this->baseExternalUrl = getUrlBasePokemon().'pokemon/';
        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'pokemons_users', 'pokemon_id', 'user_id');
    }

    public function abilities()
    {
        return $this->belongsToMany(
            Abilities::class,
            'pokemon_abilities',
            'pkm_abt_pokemon',
            'pkm_abt_abilities'
        );
    }

    public function types()
    {
        return $this->belongsToMany(
            PokemonType::class,
            'pokemon_types_pokemons',
            'typ_pkm_pokemon',
            'typ_pkm_type'
        );
    }

    public function pokemonsRandom($limit = 10)
    {
        $total_pokemons = 100;
        $count_interation = 0;
        $ids_pokemons = [];
        $length_max = $limit;
        while (count($ids_pokemons) < $length_max && $count_interation < $total_pokemons) {
            $id = rand(1, 100); 
            if (! in_array($id, $ids_pokemons)) {
                $ids_pokemons[] = $id; 
            }
        }

        return $this->whereIn('pkm_id', $ids_pokemons)->get();
    }

    public function random($limit = 20)
    {
		if(gettype($limit) != 'integer'){
			$limit = 0;
		}

        $offset = 0;
		$return = [];
        //httpGet("https://pokeapi.co/api/v2/pokemon?offset=".$offset."&limit=".$limit);
		//$response = httpGet("https://pokeapi.co/api/v2/pokemon?offset=".$offset."&limit=".$limit);
        for ($interable = 1; $interable <= $limit ; $interable++) {
            $url = getUrlBasePokemon()."pokemon/$interable";
            $object = httpGet($url);
            $pokemon = (new Pokemon)->fill([
                'pkm_id' => $object->id,
                'pkm_name' => $object->name,
                'pkm_species' => $object->species->name,
                'pkm_base_experience' => $object->base_experience,
                'pkm_height' => $object->height,
                'pkm_weight' => $object->weight,
                'pkm_image' => @$object->sprites->other->dream_world->front_default ?? '',
                'pkm_url' => getUrlBasePokemon().'pokemon/'.$object->id,
            ]);
            //createPokemon($object);
            $return[] = $pokemon;
		}

		return $return;
        $total_pokemons = 100;
        $count_interation = 0;
        $ids_pokemons = [];
        $length_max = $limit;
        while (count($ids_pokemons) < $length_max && $count_interation < $total_pokemons) {
            $id = rand(1, 100); 
            if (! in_array($id, $ids_pokemons)) {
                $ids_pokemons[] = $id; 
            }
        }

        return $this->whereIn('pkm_id', $ids_pokemons)->get();
    }
}
