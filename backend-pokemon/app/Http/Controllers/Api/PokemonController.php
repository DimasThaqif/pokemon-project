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
        $limit = $request->get('limit', 20);
        $page  = $request->get('page', 1);

        $data = $this->pokemonService->getList($limit, $page);

        return response()->json(
            collect($data)->map(fn ($p) => [
                'name' => $p['name'],
                'url'  => $p['url']
            ])
        );
    }

    public function show(string $name)
    {
        $data = $this->pokemonService->getDetail($name);

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
    }

    public function byType(string $type)
    {
        return response()->json(
            $this->pokemonService->getByType($type)
        );
    }
}
