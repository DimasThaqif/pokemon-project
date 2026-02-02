<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PokemonService;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function __construct(
        protected PokemonService $pokemonService
    ) {}


    public function index(Request $request)
    {
        $limit = (int) $request->get('limit', 20);
        $page  = (int) $request->get('page', 1);

        $data = $this->pokemonService->getList($limit, $page);

        return response()->json([
            'page'  => $page,
            'limit' => $limit,
            'data'  => collect($data)->map(fn($p) => [
                'name' => $p['name'],
                'url'  => $p['url'],
            ]),
        ]);
    }

    public function show(string $name)
    {
        $result = $this->pokemonService->getDetail($name);

        return response()->json([
            'pokemon' => [
                'id'     => $result['data']['id'],
                'name'   => $result['data']['name'],
                'height' => $result['data']['height'],
                'weight' => $result['data']['weight'],
                'types'  => collect($result['data']['types'])
                    ->pluck('type.name'),
                'sprite' => $result['data']['sprites']['front_default'],
                'source' => $result['source'],
            ]
        ]);
    }



    public function byType(string $type)
    {
        return response()->json([
            'type' => $type,
            'data' => $this->pokemonService->getByType($type),
        ]);
    }
}
