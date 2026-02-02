<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

class PokemonService
{
    public function getList(int $limit = 20, int $page = 1): array
    {
        $offset   = ($page - 1) * $limit;
        $cacheKey = "pokemon:list:{$limit}:{$page}";

        // 🔍 cek cache dulu
        $fromCache = Cache::has($cacheKey);

        $data = Cache::remember(
            $cacheKey,
            now()->addMinutes(60),
            function () use ($limit, $offset) {
                $response = Http::get(
                    'https://pokeapi.co/api/v2/pokemon',
                    [
                        'limit'  => $limit,
                        'offset' => $offset,
                    ]
                );

                if ($response->failed()) {
                    throw new Exception('Gagal mengambil list Pokémon');
                }

                return $response->json();
            }
        );

        return [
            'source' => $fromCache ? 'database' : 'api',
            'meta' => [
                'limit' => $limit,
                'page'  => $page,
                'count' => $data['count'],
            ],
            'data' => collect($data['results'])->map(fn ($p) => [
                'name' => $p['name'],
                'url'  => $p['url'],
            ])->values()
        ];
    }

    public function getDetail(string $name): array
    {
        $cacheKey  = "pokemon_detail_{$name}";
        $fromCache = Cache::has($cacheKey);

        $data = Cache::remember($cacheKey, 3600, function () use ($name) {
            $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");

            if ($response->failed()) {
                throw new NotFoundHttpException('Pokemon tidak ditemukan');
            }

            return $response->json();
        });

        return [
            'source' => $fromCache ? 'database' : 'api',
            'data'   => $data
        ];
    }

    public function getByType(string $type): array
    {
        $cacheKey  = "pokemon_type_{$type}";
        $fromCache = Cache::has($cacheKey);

        $data = Cache::remember($cacheKey, 3600, function () use ($type) {
            $response = Http::get("https://pokeapi.co/api/v2/type/{$type}");

            if ($response->failed()) {
                throw new NotFoundHttpException('Type tidak ditemukan');
            }

            return collect($response->json()['pokemon'])
                ->pluck('pokemon.name')
                ->values()
                ->toArray();
        });

        return [
            'source' => $fromCache ? 'database' : 'api',
            'data'   => $data
        ];
    }
}
