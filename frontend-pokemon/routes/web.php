<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/', [PokemonController::class, 'index']);



// Route::get('/', function () {
//     Route::get('/pokemon', [PokemonController::class, 'index']);
//     Route::get('/pokemon/{name}', [PokemonController::class, 'show']);
//     return view('welcome');
// });
