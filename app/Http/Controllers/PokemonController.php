<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PokemonController extends Controller
{
    private $model;
    public function __construct($arg = null)
    {
        $this->model = new Pokemon();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $idPokemon = (explode(',', $request->id_pokemon));
            $user = User::find((Session::get('user'))->id);
            //$pokemonsSync = $user->pokemons()->sync([$idPokemon[0]]);
            $pokemonIds = collect($user->pokemons->modelKeys());
            if ($pokemonIds->contains($idPokemon[0])) {
                return json_encode(
                    [
                        "status"=>false,
                        "message"=>"O pokemon {$idPokemon[1]} já foi capturado"
                    ], JSON_PRETTY_PRINT
                );
            }
    
            $pokemonIds->push((int) $idPokemon[0]);
            $pokemonsSync = $user->pokemons()->sync($pokemonIds);
            
            if (count($pokemonsSync['attached'])|| count($pokemonsSync['updated'])) {
                return json_encode(
                    [
                        "status"=>true,
                        "message"=>"O pokemon {$idPokemon[1]} foi capturado com sucesso"
                    ], JSON_PRETTY_PRINT
                );
            }
        } catch(\Exception $err) {
            return json_encode(
                [
                    "status"=>false,
                    "message"=>"Falha ao tentar capturar o pokemon {$idPokemon[1]}"
                ], JSON_PRETTY_PRINT
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function show(Pokemon $pokemon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function edit(Pokemon $pokemon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pokemon $poke)
    {
        $result = (Session::get('user'))->pokemons()->detach($poke->primaryIndex);
        if(!$result){
            return back()->with('feedback','Não foi possivel excluir o registro');
        }
        return back()->with('feedback','Registro excluído com sucesso');
    }

    public function showPokemons(Request $request)
    {
        if(!$this->validateSession()){
            return view('index');
        }

        $offset = $request->offset ?? 0;
        $limit = $request->limit ?? 10;
        $pokemon = Pokemon::whereNotNull('pkm_url')
                        ->limit($limit)
                        ->get();
        return view('pokemons',[
            'pokemons' => $pokemon
        ]);
    }

    public function findByName(Request $request)
    {
        if (!$request->pokemon) {
            return view('pokemons',[
                'pokemons'=> $this->model->limit(10)->get()
            ]);
        }

        $pokemon = $this->model->getDataByName($request->pokemon);
        if (empty($pokemon)) {
            return view('pokemons',[
                'pokemons'=> $this->model->limit(10)->get()
            ]);
        }
        return view('pokemons',[
            'pokemons'=> [(object) $pokemon]
        ]);
    }
}
