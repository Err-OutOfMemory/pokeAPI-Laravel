<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;   

class PokemonController extends Controller
{
    public function index(Request $request)
    {

        $limit = 15;
        $offset = $request->get('offset', 0); 
    
        $cacheKey = "pokemons_{$limit}_{$offset}";
    
        // ตรวจสอบ Cache ว่ามีข้อมูลอยู่แล้วหรือไม่
        $pokemons = Cache::get($cacheKey);
    
        // ถ้าไม่มีข้อมูลใน Cache ให้เรียก API และเก็บใน Cache
        if (!$pokemons) {
            $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit={$limit}&offset={$offset}");
            $pokemons = $response->json()['results'];
    
            foreach ($pokemons as &$pokemon) {
                $pokemon['image'] = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/" . 
                    explode('/', rtrim($pokemon['url'], '/'))[6] . ".png";
            }
    
            // เก็บข้อมูลใน Cache เป็นเวลา 10 นาที (600 วินาที)
            Cache::put($cacheKey, $pokemons, 600);
        }
    
        return view('index', compact('pokemons', 'offset', 'limit'));
    }
}