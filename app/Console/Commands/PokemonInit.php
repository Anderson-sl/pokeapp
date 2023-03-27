<?php

namespace App\Console\Commands;

use App\Jobs\JobCreatePokemon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class PokemonInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:pokemon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa lista de pokemons para a base de dados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "Iniciando processo de importação de pokemons\n";
        $pks_urls = (object) Http::get('https://pokeapi.co/api/v2/pokemon/?offset=0&limit=10')->json();
        $pks_base = $pks_urls ? $pks_urls->results : [];
        array_map(function($pokeInfo) {
            $pk = Http::get($pokeInfo['url']);
            $pokemon_response = (array) $pk->json();
            $pokemon_response['url'] = $pokeInfo['url'];
            JobCreatePokemon::dispatch($pokemon_response);
        }, $pks_base);
        echo "Solicitaçao de importação de pokemons enviada\n";
    }
}
