<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index()
    {
        $response = Http::timeout(10)
            ->get('http://127.0.0.1:8000/api/pokemon');

        if ($response->failed()) {
            abort(500, 'Gagal mengambil data Pokémon');
        }

        $pokemons = $response->json();

        return view('pokemon.index', compact('pokemons'));
    }
}
