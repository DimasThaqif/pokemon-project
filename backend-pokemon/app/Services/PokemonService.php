<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PokemonService
{
    public function getList(int $limit, int $page)
    {
        $offset = ($page - 1) * $limit;
        $cacheKey = "pokemon_list_{$limit}_{$page}";

        return Cache::remember($cacheKey, 3600, function () use ($limit, $offset) {
            $response = Http::get(
                "https://pokeapi.co/api/v2/pokemon?limit={$limit}&offset={$offset}"
            );

            return $response->json()['results'];
        });
    }

    public function getDetail(string $name)
    {
        return Cache::remember("pokemon_detail_{$name}", 3600, function () use ($name) {
            $response = Http::get(
                "https://pokeapi.co/api/v2/pokemon/{$name}"
            );

            if ($response->failed()) {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(
                    'Pokemon tidak ditemukan'
                );
            }

            return $response->json();
        });
    }

    public function getByType(string $type)
    {
        return Cache::remember("pokemon_type_{$type}", 3600, function () use ($type) {
            $response = Http::get(
                "https://pokeapi.co/api/v2/type/{$type}"
            );

            if ($response->failed()) {
                throw new \Exception("Type not found");
            }

            return collect($response->json()['pokemon'])
                ->pluck('pokemon.name');
        });
    }
}
