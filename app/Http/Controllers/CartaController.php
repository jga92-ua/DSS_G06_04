<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Carta;
use App\Models\CestaItem;


class CartaController extends Controller
{
    //
    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $cartasNombre = [];
        $cartasTipo = [];
    
        // Buscar por nombre (nombre exacto o parcial)
        $responseNombre = Http::get("https://api.pokemontcg.io/v2/cards?q=name:$query");
        if ($responseNombre->successful()) {
            $cartasNombre = $responseNombre->json()['data'];
        }
    
        // Buscar por tipo (por ejemplo "Fire", "Water", "Grass"...)
        $responseTipo = Http::get("https://api.pokemontcg.io/v2/cards?q=types:$query");
        if ($responseTipo->successful()) {
            $cartasTipo = $responseTipo->json()['data'];
        }
    
        // Unir ambos resultados y eliminar duplicados por ID
        $todasCartas = collect($cartasNombre)
                        ->merge($cartasTipo)
                        ->unique('id')
                        ->values();
    
        return view('cartas.buscar', ['cartas' => $todasCartas]);
    }
    // Mostrar el formulario para crear la carta seleccionada
    public function create(Request $request)
    {
        $id_carta_api = $request->input('id_carta_api');
        $nombre_carta_api = $request->input('nombre_carta_api');
        return view('cartas.crear', compact(['id_carta_api', 'nombre_carta_api']));
    }
    public function misCartas()
    {
        $usuario_id = 1; // o el ID del usuario autenticado
        $cartas = \App\Models\Carta::where('usuario_id', auth()->id())->get();
    
        $cartasConInfo = $cartas->map(function ($carta) {
            $idApi = $carta->id_carta_api;
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
            $datosApi = $apiResponse->json();
    
            return [
                'id' => $carta->id, // IMPORTANTE: este es el id para eliminar
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
        $cartasTrending = Carta::inRandomOrder()->limit(7)->get();

        // Obtener 3 cartas aleatorias del catálogo
        $cartasCatalogo = Carta::inRandomOrder()->limit(4)->get();

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
        $cartas = \App\Models\Carta::paginate(14); // 14 cartas por página

        $cartasConImagenes = $cartas->map(function ($carta) {
            $idApi = $carta->id_carta_api;
            $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
            $datosApi = $apiResponse->json();

            return [
                'id' => $carta->id,
                'imagen' => $datosApi['data']['images']['small'] ?? asset('imagenes/default-card.png'),
            ];
        });

        return view('catalogo.catalogo', [
            'cartas' => $cartasConImagenes,
            'cartasOriginales' => $cartas // Para que los links de paginación funcionen
        ]);
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
    // Opcional: puedes añadir verificación de rol si tu sistema lo soporta
    $cartas = \App\Models\Carta::with('usuario')->get();
    return view('cartas.admin', compact('cartas'));
}


    public function edit($id)
    {
        $carta = Carta::findOrFail($id);
        return view('cartas.editCarta', compact('carta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rareza' => 'required|string',
            'estado' => 'required|string',
            'precio' => 'required|numeric',
            'fecha_adquisicion' => 'required|date',
        ]);

        $carta = Carta::findOrFail($id);
        $carta->update($request->only(['rareza', 'estado', 'precio', 'fecha_adquisicion']));

        return redirect()->route('cartas.admin')->with('success', 'Carta actualizada');
    }



    public function store(Request $request)
    {
        // Validar datos del formulario
        $request->validate([
            'id_carta_api' => 'required|string',
            'nombre_carta_api' => 'required|string',
            'rareza' => 'required|string',
            'estado' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'fecha_adquisicion' => 'required|date',
        ]);

        // Crear nueva carta
        \App\Models\Carta::create([
            'id_carta_api' => $request->input('id_carta_api'),
            // 'usuario_id' => auth()->id(), // Solo si tienes login
            'usuario_id'        => auth()->id(), // ID del usuario autenticado
            'nombre_carta_api' => $request->input('nombre_carta_api'),
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
    
    public function show($id)
    {
        $carta = Carta::findOrFail($id);

        // Buscar imagen desde la API de PokéTCG
        $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards", [
            'q' => 'name:"' . $carta->nombre_carta_api . '"'
        ]);

        $imagenCarta = null;
        if ($apiResponse->successful() && isset($apiResponse['data'][0]['images']['large'])) {
            $imagenCarta = $apiResponse['data'][0]['images']['large'];
        }

        $vendedores = CestaItem::with('cesta.user')
            ->where('carta_id', $id)
            ->get();

        return view('cartas.carta', compact('carta', 'imagenCarta', 'vendedores'));
    }

}
