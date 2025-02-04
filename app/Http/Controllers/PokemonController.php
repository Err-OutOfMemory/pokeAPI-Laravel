<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;    

class PokemonController extends Controller
{
    public function index(Request $request)
    {

        $limit = 15;
        $offset = $request->get('offset', 0); 
    
        $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit={$limit}&offset={$offset}");
        $pokemons = $response->json()['results'];
        foreach ($pokemons as &$pokemon) {
            $pokemon['image'] = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/" . 
                explode('/', rtrim($pokemon['url'], '/'))[6] . ".png";
        }

        return view('index', compact('pokemons', 'offset', 'limit'));

    }
}
