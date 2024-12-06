<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\DragonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/welcome', function () {return view('welcome');})->name('welcome');

Route::get('/pokemons/{pokemon}', [PokemonController::class, 'index'])->name('pokemonsID');
Route::get('/dragon/{character_id}', [DragonController::class, 'index'])->name('dragonID');

Route::get('/pokemons', [PokemonController::class, 'all'])->name('pokemons');
Route::get('/dragonBall', [DragonController::class, 'all'])->name('dragonBall');


