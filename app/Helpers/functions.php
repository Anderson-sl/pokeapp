<?php

use App\Models\Abilities;
use App\Models\Pokemon;
use App\Models\PokemonType;

function getUrlBasePokemon()
{
    return 'https://pokeapi.co/api/v2/';
}

function httpGet($url = ''){
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

    $result = json_decode(curl_exec($ch));

    if (json_last_error()) {
        return false;
    }

    return $result;
}

function getPokemonApi($name = '')
{
    return httpGet('https://pokeapi.co/api/v2/pokemon/'.$name);
}

function createPokemon($object)
{
    try {
        $pokemon_field = createPokemonByApi($object);
        $pokemon = Pokemon::firstOrCreate($pokemon_field);
        createAbilitiesByApi($pokemon, $object['abilities']);
        createTypesByApi($pokemon, $object['types']);
        return $pokemon;
    } catch(\Exception $err) {
        dd($err);
        throw new Error($err);
    }
}

function createPokemonByApi($object)
{
    return [
        'pkm_id' => (int) $object['id'],
        'pkm_name' => $object['name'],
        'pkm_species' => $object['species']['name'],
        'pkm_base_experience' => $object['base_experience'],
        'pkm_height' => $object['height'],
        'pkm_weight' => $object['weight'],
        'pkm_image' => $object['sprites']['other']['dream_world']['front_default'],
        'pkm_url' => $object['url'],
    ];
}

function createTypesByApi($pokemon, $types = [])
{
    $list_abilities = [];
    foreach ($types as $item) {
        $arr = explode('/', $item['type']['url']);
        $last_index = count($arr) - 1;
        $id_types = $arr[$last_index-1];
        PokemonType::firstOrCreate([
            'pkm_typ_id' => $id_types,
            'pkm_typ_name' => $item['type']['name'],
            'pkm_typ_url' => $item['type']['url'],
        ]);

        $list_abilities[] = $id_types;
    }

    $pokemon
        ->types()
        ->sync($list_abilities);
}

function createAbilitiesByApi($pokemon, $abilities = [])
{
    $list_abilities = [];
    foreach ($abilities as $item) {
        $arr = explode('/', $item['ability']['url']);
        $last_index = count($arr) - 1;
        $id_abilities = $arr[$last_index-1];
        Abilities::firstOrCreate([
            'abt_id' => $id_abilities,
            'abt_name' => $item['ability']['name'],
            'abt_url' => $item['ability']['url'],
        ]);
        $list_abilities[] = $id_abilities;
    }

    $pokemon
        ->abilities()
        ->sync($list_abilities);
}
