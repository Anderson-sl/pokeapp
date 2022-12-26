<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->bigInteger('pkm_id')->primary();
            $table->string('pkm_name');
            $table->string('pkm_species');
            $table->integer('pkm_base_experience');
            $table->integer('pkm_height');
            $table->integer('pkm_weight');
            $table->string('pkm_image');
            $table->string('pkm_url');
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
        Schema::dropIfExists('pokemons');
    }
}
