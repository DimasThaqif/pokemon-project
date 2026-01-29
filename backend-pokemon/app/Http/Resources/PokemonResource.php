<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PokemonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this['id'],
            'name'   => $this['name'],
            'height' => $this['height'],
            'weight' => $this['weight'],
            'types'  => collect($this['types'])->map(
                fn ($t) => $t['type']['name']
            ),
            'sprite' => $this['sprites']['front_default'],
        ];
    }
}
