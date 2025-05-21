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

        $cesta = Cesta::with('items')->where('user_id', $user->id)->first();

        if (!$cesta || $cesta->items->isEmpty()) {
            return redirect()->route('cesta.index')->with('error', 'La cesta está vacía.');
        }

        Pedido::create([
            'cliente_id'      => $user->id,
            'cesta_id'        => $cesta->id,
            'direccion_envio' => 'no_aplica',
            'nombre_cliente'  => $user->name ?? 'Sin nombre',
            'metodo_pago'     => $request->input('metodo_pago', 'Tarjeta'),
            'fecha_pedido'    => now(),
            'comprador_id'    => null,
        ]);

        return redirect()->route('cesta.index')->with('success', 'Pedido registrado correctamente.');
    }
}
