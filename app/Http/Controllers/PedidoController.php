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

        // Verificar datos antes del insert
        $vendedorId = $cesta->items->first()->carta->usuario_id ?? null;

        $datosPedido = [
            'cliente_id'      => $user->id,
            'cesta_id'        => $cesta->id,
            'direccion_envio' => $user->direccion,
            'nombre_cliente'  => $user->name,
            'metodo_pago'     => $request->input('metodo_pago', 'Tarjeta'),
            'fecha_pedido'    => now(),
            'comprador_id'    => $vendedorId,
        ];

        // Debug para verificar datos (puedes comentarlo después)
        // dd($datosPedido);

        try {
            Pedido::create($datosPedido);
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
