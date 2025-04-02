<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Carta;

class CartaController extends Controller
{
    //
    public function buscar(Request $request)
{
    $nombre = $request->input('nombre');

    $response = Http::get("https://api.pokemontcg.io/v2/cards", [
        'q' => "name:$nombre"
    ]);

    $cartas = $response->json()['data'] ?? [];

    return view('cartas.buscar', compact('cartas'));
}
    // Mostrar el formulario para crear la carta seleccionada
    public function create(Request $request)
    {
        $id_carta_api = $request->input('id_carta_api');
        return view('cartas.crear', compact('id_carta_api'));
    }
    public function misCartas()
    {
        $usuario_id = 1; // o el ID del usuario autenticado
        $cartas = Carta::where('usuario_id', $usuario_id)->get();
    
        $cartasConInfo = $cartas->map(function ($carta) {
            $idApi = $carta->id_carta_api;
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
            $datosApi = $apiResponse->json();
    
            return [
                'id' => $carta->id, // 👈 IMPORTANTE: este es el id para eliminar
                'id_carta_api' => $idApi,
                'nombre' => $datosApi['data']['name'] ?? 'Desconocido',
                'imagen' => $datosApi['data']['images']['small'] ?? null,
                'rareza' => $carta->rareza,
                'estado' => $carta->estado,
                'precio' => $carta->precio,
                'fecha_adquisicion' => $carta->fecha_adquisicion,
            ];
        });
    
        return view('cartas.mis', ['cartas' => $cartasConInfo]);
    }

    public function inicio()
    {
        // Obtener 4 cartas aleatorias para Trending
        $cartasTrending = Carta::inRandomOrder()->limit(4)->get();

        // Obtener 3 cartas aleatorias del catálogo
        $cartasCatalogo = Carta::inRandomOrder()->limit(3)->get();

        // Obtener información desde la API para Trending
        $cartasTrending = $cartasTrending->map(function ($carta) {
            $idApi = $carta->id_carta_api;
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
            $datosApi = $apiResponse->json();

            return [
                'id' => $carta->id,
                'nombre' => $datosApi['data']['name'] ?? 'Desconocido',
                'imagen' => $datosApi['data']['images']['small'] ?? asset('imagenes/default-card.png'),
            ];
        });

        // Obtener información desde la API para el Catálogo (solo 3 cartas)
        $cartasCatalogo = $cartasCatalogo->map(function ($carta) {
            $idApi = $carta->id_carta_api;
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
            $datosApi = $apiResponse->json();

            return [
                'id' => $carta->id,
                'nombre' => $datosApi['data']['name'] ?? 'Desconocido',
                'imagen' => $datosApi['data']['images']['small'] ?? asset('imagenes/default-card.png'),
            ];
        });

        return view('home.inicio', compact('cartasTrending', 'cartasCatalogo'));
    }

    public function catalogo()
    {
        $cartas = Carta::all(); // Obtiene todas las cartas de la base de datos

        // Obtener imÃ¡genes desde la API
        $cartasConImagenes = $cartas->map(function ($carta) {
            $idApi = $carta->id_carta_api;
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
            $datosApi = $apiResponse->json();

            return [
                'id' => $carta->id,
                'imagen' => $datosApi['data']['images']['small'] ?? asset('imagenes/default-card.png'),
            ];
        });

        return view('catalogo.catalogo', ['cartas' => $cartasConImagenes]);
    }

    private function obtenerInfoDesdeApi($cartas)
    {
        return $cartas->map(function ($carta) {
            $idApi = $carta->id_carta_api;
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
            $datosApi = $apiResponse->json();

            return [
                'id' => $carta->id,
                'nombre' => $datosApi['data']['name'] ?? 'Desconocido',
                'imagen' => $datosApi['data']['images']['small'] ?? asset('imagenes/default-card.png'),
            ];
        });
    }
    
    public function adminCartas()
{
    $cartas = \App\Models\Carta::all(); // Muestra todas las cartas
    return view('cartas.admin', compact('cartas'));
}

    

    public function store(Request $request)
{
    // Validar datos del formulario
    $request->validate([
        'id_carta_api' => 'required|string',
        'rareza' => 'required|string',
        'estado' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'fecha_adquisicion' => 'required|date',
    ]);

    // Crear nueva carta
    \App\Models\Carta::create([
        'id_carta_api' => $request->input('id_carta_api'),
        // 'usuario_id' => auth()->id(), // Solo si tienes login
        'usuario_id' => 1,
        'rareza' => $request->input('rareza'),
        'estado' => $request->input('estado'),
        'precio' => $request->input('precio'),
        'fecha_adquisicion' => $request->input('fecha_adquisicion'),
    ]);

    return redirect()->route('cartas.mis')->with('success', 'Carta subida correctamente');
}

public function destroy($id)
{
    $carta = Carta::findOrFail($id);
    $carta->delete();

    return redirect()->route('cartas.mis')->with('success', 'Carta eliminada correctamente');
}





}
