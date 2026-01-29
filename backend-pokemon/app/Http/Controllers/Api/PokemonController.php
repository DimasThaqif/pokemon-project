<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * GET /api/pokemon
     * Pagination + Cache
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', 20);
        $page  = $request->get('page', 1);
        $offset = ($page - 1) * $limit;

        $cacheKey = "pokemon_list_{$limit}_{$page}";

        return Cache::remember($cacheKey, 3600, function () use ($limit, $offset) {
            $response = Http::get(
                "https://pokeapi.co/api/v2/pokemon?limit={$limit}&offset={$offset}"
            );

            if ($response->failed()) {
                return response()->json([
                    'message' => 'Gagal mengambil data Pokémon'
                ], 500);
            }

            return response()->json(
                collect($response->json()['results'])->map(fn ($p) => [
                    'name' => $p['name'],
                    'url'  => $p['url']
                ])
            );
        });
    }

    /**
     * GET /api/pokemon/{name}
     * Cache detail Pokémon
     */
    public function show(string $name)
    {
        return Cache::remember("pokemon_detail_{$name}", 3600, function () use ($name) {
            $response = Http::get(
                "https://pokeapi.co/api/v2/pokemon/{$name}"
            );

            if ($response->failed()) {
                return response()->json([
                    'message' => 'Pokemon tidak ditemukan'
                ], 404);
            }

            $data = $response->json();

            return response()->json([
                'id'     => $data['id'],
                'name'   => $data['name'],
                'height' => $data['height'],
                'weight' => $data['weight'],
                'types'  => collect($data['types'])->map(
                    fn ($t) => $t['type']['name']
                ),
                'sprite' => $data['sprites']['front_default'],
            ]);
        });
    }

    /**
     * GET /api/pokemon/type/{type}
     * Filter Pokémon by type
     */
    public function byType(string $type)
    {
        return Cache::remember("pokemon_type_{$type}", 3600, function () use ($type) {
            $response = Http::get(
                "https://pokeapi.co/api/v2/type/{$type}"
            );

            if ($response->failed()) {
                return response()->json([
                    'message' => 'Type tidak ditemukan'
                ], 404);
            }

            return response()->json(
                collect($response->json()['pokemon'])->map(
                    fn ($p) => $p['pokemon']['name']
                )
            );
        });
    }
}
