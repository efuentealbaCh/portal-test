<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index($pokemon)
    {
        // URL de tu API de FastAPI, puedes cambiarla si estás usando un puerto diferente
        $apiUrl = env('API_URL');
        $response = Http::get("$apiUrl/pokemon/$pokemon");
        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            $pokemon = $response->json(); // Convertir la respuesta a un array
            return view('pokemons.index', compact('pokemon'));
        } else {
            return view('pokemons.index', ['error' => 'No se pudo obtener el Pokémon']);
        }
    }

    public function all()
    {
        // URL de tu API de FastAPI, puedes cambiarla si estás usando un puerto diferente
        $apiUrl = env('API_URL');
        $response = Http::get("$apiUrl/pokemon");
        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            $pokemons = $response->json()['pokemons']; // Convertir la respuesta a un array
            // dd($pokemons);
            return view('pokemons.all', compact('pokemons'));
        } else {
            return view('pokemons.all', ['error' => 'No se pudo obtener el Pokémon']);
        }
    }


}
