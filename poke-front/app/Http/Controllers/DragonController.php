<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DragonController extends Controller
{
    public function index($character_id)
    {
        // URL de tu API de FastAPI, puedes cambiarla si estás usando un puerto diferente
        $apiUrl = env('API_DRAGONBALL_URL');
        $response = Http::get("$apiUrl/characters/$character_id");
        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            $characterData  = $response->json(); // Convertir la respuesta a un array
            $character = (object) $characterData;
            return view('dragon.index', compact('character'));
        } else {
            return view('dragon.index', ['error' => 'No se pudo obtener el Pokémon']);
        }
    }

    public function all()
    {
        // URL de tu API de FastAPI, puedes cambiarla si estás usando un puerto diferente
        $apiUrl = env('API_DRAGONBALL_URL');
        $response = Http::get("$apiUrl/characters");
        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            $characterData  = $response->json(); // Convertir la respuesta a un array
            // dd($characterData);
            return view('dragon.all', compact('characterData'));
        } else {
            return view('dragon.all', ['error' => 'No se pudo obtener el Pokémon']);
        }
    }
}
