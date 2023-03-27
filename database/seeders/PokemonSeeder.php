<?php

namespace Database\Seeders;

use App\Models\Abilities;
use App\Models\Pokemon;
use App\Models\PokemonType;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$response = httpGet('https://pokeapi.co/api/v2/pokemon?offset=0&limit=100');
		
		foreach ($response->results as $result) {
			$return = httpGet($result->url);
            $pokemon = Pokemon::firstOrCreate([
                'pkm_id' => $return->id,
                'pkm_name' => $return->name,
                'pkm_species' => $return->species->name,
                'pkm_base_experience' => $return->base_experience,
                'pkm_height' => $return->height,
                'pkm_weight' => $return->weight,
                'pkm_image' => @$return->sprites->other->dream_world->front_default ?? '',
                'pkm_url' => $result->url,
            ]);

            foreach ($return->abilities as $item) {
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
            
            foreach ($return->types as $item) {
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
    }
}
