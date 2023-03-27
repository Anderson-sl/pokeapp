<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PokemonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*GET*/
Route::get('/',[UserController::class,'index'])->name('user.index');
Route::get('/cacar_pokemon',[PokemonController::class,'showPokemons'])->name('user.show.pokemons');
Route::get('/exit',[UserController::class,'exit'])->name('user.exit');
/*POST*/
Route::post('/usuario/cadastro/validaEmail',[UserController::class,'validaEmail'])->name('user.valida.email');
Route::post('/usuario/acessar',[UserController::class,'login'])->name('user.login');
Route::post('/pokemon/buscar',[PokemonController::class,'findByName'])->name('poke.find.name');

/*DELETE*/
Route::post('/pokemon/excluir/{poke}',[PokemonController::class,'destroy'])->name('poke.destroy');


/*RESOURCE*/
Route::resource('usuario',UserController::class)->names('user')->parameters(['usuario'=>'user'])->except(['index']);
Route::resource('pokemon',PokemonController::class)->names('poke')->parameters(['pokemon'=>'poke'])->except(['index']);
