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

    $cesta = Cesta::with('items.carta')->where('user_id', $user->id)->first();

    if (!$cesta || $cesta->items->isEmpty()) {
        return redirect()->route('cesta.index')->with('error', 'La cesta está vacía.');
    }

    // Suponemos que todos los ítems son del mismo vendedor (simplificación)
    $vendedorId = $cesta->items->first()->carta->usuario_id ?? null;

    Pedido::create([
        'cliente_id'      => $user->id,
        'cesta_id'        => $cesta->id,
        'direccion_envio' => $user->direccion,
        'nombre_cliente'  => $user->name,
        'metodo_pago'     => $request->input('metodo_pago', 'Tarjeta'),
        'fecha_pedido'    => now(),
        'comprador_id'    => $vendedorId,
    ]);

    return redirect()->route('cesta.index')->with('success', 'Pedido registrado correctamente.');
}


    public function index()
    {
        $usuarioId = Auth::id(); // ID del usuario autenticado

        // Filtrar pedidos solo del usuario actual
        $pedidos = Pedido::where('cliente_id', $usuarioId)->get();

        return view('pedidos.index', compact('pedidos'));
    }
}
