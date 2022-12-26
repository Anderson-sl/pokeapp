<?php

namespace App\Jobs;

use App\Models\Pokemon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class jobCreatePokemon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pokemon $pokemon)
    {
        $this->pokemon = $pokemon;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        createPokemon($this->pokemon);
    }
}
