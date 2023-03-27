<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $with = ['pokemons'];

    protected $fillable = [
        'name',
        'email',
        'login',
        'password'
    ];
    
    protected $hidden = [
        'password'
    ];

    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class, 'pokemons_users', 'user_id', 'pokemon_id', 'id', 'pkm_id');
    }

    public function findPokemons($arr = [])
    {
        $result = [];
        $ch = curl_init();
        foreach ($arr as $value) {
            curl_setopt($ch, CURLOPT_URL, "https://pokeapi.co/api/v2/pokemon/{$value->index}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
            $obj = json_decode(curl_exec($ch));
            $obj->id = $value->id;
             array_push($result, $obj);
        }
        return $result;
    }

}
