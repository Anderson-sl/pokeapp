<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
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
        $id_pokemon = (explode(',', $request->id_pokemon));
        $ar = $this->model->find($id_pokemon[0]);

        $this->model->index = intval($id_pokemon[0]);
        $this->model->id_user = (Session::get('user'))->id;

        $result = $this->model->save() ? 
            json_encode(
                [
                    "status"=>true,
                    "message"=>"O pokemon {$id_pokemon[1]} foi capturado com sucesso"
                ], JSON_PRETTY_PRINT
            ) :
            json_encode(
                [
                    "status"=>true,
                    "message"=>"O pokemon {$id_pokemon[1]} não foi capturado"
                ], JSON_PRETTY_PRINT
            );
        echo $result;
        return;
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
        $result = $poke->delete();
        $arr = [];
        if(!$result || is_null($result)){
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
        $limit = $request->limit ?? 20;
        $pokemon = new Pokemon();
        return view('pokemons',[
            'pokemons' => $pokemon->random($limit)
        ]);
    }

    public function findByName(Request $request)
    {
        $pokemons = $request->pokemon == '' ? 
            $this->model->pokemonsRandom() :
            $this->model->where('pkm_name', $request->pokemon)->get();

        if ($pokemons->count() > 0) {
            return view('pokemons',[
                'pokemons'=> $pokemons
            ]);
        }

        $pokemons = getPokemonApi($request->pokemon);

        if (! $pokemons) {
            return view('pokemons',[
                'pokemons'=> []
            ]);
        }

        $pokemons = [createPokemon($pokemons)];
        
        return view('pokemons',[
            'pokemons'=> $pokemons
        ]);
    }
}
