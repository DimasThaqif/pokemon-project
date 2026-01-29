<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index()
    {
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=20');

        return response()->json($response->json());
    }

    public function show($name)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");

        return response()->json($response->json());
    }
}
