<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function realizar(Request $request)
{
    $user = Auth::user();

    // Obtener la cesta ACTUAL del usuario (más reciente con productos)
    $cesta = Cesta::with('items.carta')
        ->where('user_id', $user->id)
        ->orderByDesc('id')
        ->first();

    if (!$cesta || $cesta->items->isEmpty()) {
        return redirect()->route('cesta.index')->with('error', 'La cesta está vacía.');
    }

    // Guardar el ID de la cesta usada en el pedido
    $cestaAnteriorId = $cesta->id;

    $vendedorId = $cesta->items->first()->carta->usuario_id ?? null;

    $datosPedido = [
        'cliente_id'      => $user->id,
        'cesta_id'        => $cestaAnteriorId,
        'direccion_envio' => $user->direccion ?? 'no_aplica',
        'nombre_cliente'  => $user->name ?? 'Desconocido',
        'metodo_pago'     => $request->input('metodo_pago', 'Tarjeta'),
        'fecha_pedido'    => now(),
        'comprador_id'    => $vendedorId,
        'id_carta_api'    => $cesta->items->first()->carta->id_carta_api ?? null,
    ];

    try {
        // 1. Guardar el pedido con la cesta actual
        Pedido::create($datosPedido);

        // 2. Crear nueva cesta vacía para próximas compras
        Cesta::create(['user_id' => $user->id]);

    } catch (\Exception $e) {
        dd('Error al crear el pedido: ' . $e->getMessage());
    }

    return redirect()->route('cesta.index')->with('success', 'Pedido registrado correctamente.');
}


    public function show($id)
    {
        $pedido = Pedido::with('items.carta.usuario')->findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    public function index()
    {
        $usuarioId = Auth::id();
        $pedidos = Pedido::where('cliente_id', $usuarioId)->get();

        return view('pedidos.index', compact('pedidos'));
    }
}
