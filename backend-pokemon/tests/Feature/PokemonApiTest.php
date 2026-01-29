<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PokemonApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_api_pokemon_returns_data()
    {
        $response = $this->getJson('/api/pokemon');
        $response->dump();

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'name',
                    'url'
                ]
            ]);
    }
}
