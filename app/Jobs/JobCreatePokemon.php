<?php

namespace App\Jobs;

use App\Models\Pokemon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class JobCreatePokemon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $pokemon;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pokemon)
    {
        $this->onQueue('pokemon');
        $this->pokemon = $pokemon;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo "-------------- START ------------------>\n";
        echo "Iniciando Importação do pokemon {$this->pokemon['name']}\n";
        createPokemon($this->pokemon);
        echo "{$this->pokemon['name']} importado com sucesso\n";
        echo "-------------- END ------------------>\n";
    }
}
