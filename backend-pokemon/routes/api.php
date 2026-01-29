<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PokemonController;


Route::get('/pokemon', function (){
    Route::get('/pokemon', [PokemonController::class, 'index']);
    Route::get('/pokemon/{name}', [PokemonController::class, 'show']);
    return response()->json([
        'status' => 'api pokemon oke'
    ]);
});

