<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonTypesPokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemon_types_pokemons', function (Blueprint $table) {
            $table->bigInteger('typ_pkm_id')->autoIncrement();
            $table->bigInteger('typ_pkm_pokemon');
                $table->foreign('typ_pkm_pokemon')->references('pkm_id')->on('pokemons');
            $table->bigInteger('typ_pkm_type');
                $table->foreign('typ_pkm_type')->references('pkm_typ_id')->on('pokemon_types');
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
        Schema::dropIfExists('pokemon_types_pokemons');
    }
}
