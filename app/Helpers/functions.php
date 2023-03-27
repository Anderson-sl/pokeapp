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
    $pokemon = Pokemon::firstOrCreate($object->attributes);

    createAbilitiesByApi($pokemon, $object->abilities);
    createTypesByApi($pokemon, $object->types);

    return $pokemon;
}

function createTypesByApi($pokemon, $types = [])
{
    foreach ($types as $item) {
        $arr = explode('/', $item->type->url);
        $last_index = count($arr) - 1;
        $id_types = $arr[$last_index-1];
        PokemonType::firstOrCreate([
            'pkm_typ_id' => $id_types,
            'pkm_typ_name' => $item->type->name,
            'pkm_typ_url' => $item->type->url,
        ]);

        $pokemon
        ->types()
        ->attach([
            'typ_pkm_type' => $id_types
        ]);
    }
}

function createAbilitiesByApi($pokemon, $abilities = [])
{
    foreach ($abilities as $item) {
        $arr = explode('/', $item->ability->url);
        $last_index = count($arr) - 1;
        $id_abilities = $arr[$last_index-1];
        Abilities::firstOrCreate([
            'abt_id' => $id_abilities,
            'abt_name' => $item->ability->name,
            'abt_url' => $item->ability->url,
        ]);

        $pokemon
        ->abilities()
        ->attach([
            'pkm_abt_abilities' => $id_abilities
        ]);
    }
}
