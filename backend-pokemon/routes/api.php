<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PokemonController;

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/pokemon', [PokemonController::class, 'index']);
    Route::get('/pokemon/{name}', [PokemonController::class, 'show']);
    Route::get('/pokemon/type/{type}', [PokemonController::class, 'byType']);
});

// Route::get('/pokemon', function (){
//     return response()->json([
//         'status' => 'api pokemon oke'
//     ]);
// });

