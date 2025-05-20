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
        // Obtener cartas únicas (máximo disponibles en DB) y barajarlas
        $cartasUnicas = Carta::all()->unique('id_carta_api')->shuffle();

        // Separar 7 para Trending y 4 para Catálogo (sin repetidas)
        $cartasTrending = $cartasUnicas->take(7);
        $cartasCatalogo = $cartasUnicas->slice(7)->take(4);

        // Obtener datos de la API para cada bloque
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

    public function catalogo(Request $request)
    {
        $expansion = $request->query('expansion');

        if ($expansion) {
            // Obtener cartas de la expansión especificada desde la API
            $response = Http::get("https://api.pokemontcg.io/v2/cards", [
                'q' => 'set.name:"' . $expansion . '"',
                'pageSize' => 14,
            ]);

            if ($response->successful()) {
                $cartas = collect($response->json()['data']);
            } else {
                $cartas = [];
            }

            return view('catalogo.catalogo', [
                'cartas' => $cartas,
                'expansion' => $expansion,
            ]);
        } else {
            // Lógica existente para mostrar el catálogo sin filtro
            $cartasOriginales = Carta::select('id_carta_api')
                ->distinct()
                ->paginate(14);

            $cartasConImagenes = $cartasOriginales->map(function ($carta) {
                $idApi = $carta->id_carta_api;
                $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$idApi}");
                $datosApi = $apiResponse->json();

                return [
                    'id' => $idApi,
                    'imagen' => $datosApi['data']['images']['small'] ?? asset('imagenes/default-card.png'),
                ];
            });

            return view('catalogo.catalogo', [
                'cartas' => $cartasConImagenes,
                'cartasOriginales' => $cartasOriginales,
            ]);
        }
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
        $cartas = Carta::with('usuario')->get();
        return view('cartas.admin', compact('cartas'));
    }


    public function edit($id)
    {
        $carta = Carta::findOrFail($id);

        // Guardamos en sesión la URL desde la que venimos
        session(['previous_url' => url()->previous()]);

        return view('cartas.editCarta', compact('carta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rareza'            => 'required|string',
            'estado'            => 'required|string',
            'precio'            => 'required|numeric',
            'fecha_adquisicion' => 'required|date',
        ]);

        $carta = Carta::findOrFail($id);
        $carta->update($request->only([
            'rareza', 'estado', 'precio', 'fecha_adquisicion'
        ]));

        // Recuperamos la URL que guardamos en edit(),
        // o caemos en la ruta 'cartas.mis' si no existe.
        $urlAnterior = session('previous_url', route('cartas.mis'));

        // Opcional: limpiamos la clave de sesión
        session()->forget('previous_url');

        return redirect($urlAnterior)
               ->with('success', 'Carta actualizada correctamente.');
    }

    // Mostrar formulario admin
    public function editAdmin($id)
    {
        $carta = Carta::findOrFail($id);
        session(['admin_previous_url' => url()->previous()]);
        return view('admin.editCarta', compact('carta'));
    }

    // Guardar cambios
    public function updateAdmin(Request $request, $id)
    {
        $carta = Carta::findOrFail($id);

        $carta->rareza = $request->input('rareza');
        $carta->estado = $request->input('estado');
        $carta->precio = $request->input('precio');
        $carta->fecha_adquisicion = $request->input('fecha_adquisicion');
        $carta->save();

        // híbrido: Laravel te guarda automáticamente la URL anterior en la sesión
        $urlAnterior = session('admin_previous_url', route('admin.index'));
        return redirect($urlAnterior)
                ->with('success', '¡Carta actualizada correctamente!');

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
        Carta::create([
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
    
    public function show($id_carta_api)
    {
        // Obtener la primera carta subida con ese id de la API
        $carta = Carta::where('id_carta_api', $id_carta_api)->firstOrFail();

        // Buscar imagen desde la API de PokéTCG
        $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$id_carta_api}");

        $imagenCarta = null;
        if ($apiResponse->successful() && isset($apiResponse['data']['images']['large'])) {
            $imagenCarta = $apiResponse['data']['images']['large'];
        }

        // Buscar vendedores (usuarios que subieron esa misma carta)
        $vendedores = Carta::where('id_carta_api', $id_carta_api)
            ->join('users', 'cartas.usuario_id', '=', 'users.id')
            ->select('cartas.estado', 'cartas.precio', 'users.name as vendedor')
            ->orderBy('cartas.precio', 'asc')
            ->get();

        return view('cartas.show', compact('carta', 'vendedores', 'imagenCarta'));
    }

}
