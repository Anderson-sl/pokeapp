<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;
    protected $table = 'tbpokemons';


	public static function showAll(int $offset = 1,int $limit = 15)
	{
		$size = $offset + $limit;
		$return = [];
		$ch = curl_init();
		for ($i=$offset; $i < $size+1; $i++) { 
			curl_setopt($ch, CURLOPT_URL, "https://pokeapi.co/api/v2/pokemon/{$i}");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
			 array_push($return, json_decode(curl_exec($ch)));
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
		}catch(Exception $e){
			return false;
		}
	}

}