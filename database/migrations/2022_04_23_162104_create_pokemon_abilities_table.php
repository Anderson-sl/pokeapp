<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemon_abilities', function (Blueprint $table) {
            $table->bigInteger('pkm_abt_id')->autoIncrement();
            $table->bigInteger('pkm_abt_pokemon');
                $table->foreign('pkm_abt_pokemon')->references('pkm_id')->on('pokemons');
            $table->bigInteger('pkm_abt_abilities');
                $table->foreign('pkm_abt_abilities')->references('abt_id')->on('abilities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemon_abilities');
    }
}
