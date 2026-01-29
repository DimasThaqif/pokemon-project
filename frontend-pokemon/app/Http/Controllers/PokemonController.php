<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index()
    {
        // ambil data dari backend API
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=20');

        $pokemons = $response->json()['results'];

        return view('pokemon.index', compact('pokemons'));
    }

    public function show($name)
    {
        $response = Http::get("http://127.0.0.1:8000/api/pokemon/{$name}");

        $pokemon = $response->json();

        return view('pokemon.show', compact('pokemon'));
    }
}
