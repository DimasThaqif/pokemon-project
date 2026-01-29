<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PokemonController;


Route::get('/', function (){
    Route::get('/pokemon', [PokemonController::class, 'index']);
    Route::get('/pokemon/{name}', [PokemonController::class, 'show']);
    return view('welcome');
});
