<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonBKP extends Model
{
    use HasFactory;
    protected $table = 'tbpokemons';


	public static function showAll(int $offset = 0,int $limit = 0)
	{ 	 
		if(gettype($offset) != 'integer'){
			$offset = 0;
		}

		if(gettype($limit) != 'integer'){
			$limit = 0;
		}

		$return = [];

		$response = httpGet("https://pokeapi.co/api/v2/pokemon?offset=".$offset."&limit=".$limit);
		
		foreach ($response->results as $result) {
			$return[] = httpGet($result->url);
		}

		return $return;
	}

	public static function find(string $param)
	{
		try{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://pokeapi.co/api/v2/pokemon/{$param}");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
			$return = curl_exec($ch);		

			return is_null(json_decode($return)) ? false : array(json_decode($return));
		}catch(\Exception $e){
			return false;
		}
	}

}