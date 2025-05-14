<?php
namespace App\Http\Controllers;

use App\Models\Cesta;
use App\Models\CestaItem;
use App\Models\Carta;
use Illuminate\Support\Facades\Auth;

class CestaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $cesta = Cesta::with('items.carta')->firstOrCreate(['user_id' => $user->id]);

        $cartasEnCesta = $cesta->items;
        $precioTotal = $cartasEnCesta->sum(fn($item) => $item->cantidad * $item->precio_unitario);

        return view('cesta.cesta', compact('cartasEnCesta', 'precioTotal'));
    }

   public function agregar(Request $request)
    {
        $request->validate([
            'carta_id' => 'required|exists:cartas,id',
            'precio_unitario' => 'required|numeric',
            'cesta_item_id' => 'required|exists:cesta_items,id'
        ]);

        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $cesta = Cesta::firstOrCreate(['user_id' => $user->id]);

        CestaItem::create([
            'cesta_id' => $cesta->id,
            'carta_id' => $request->carta_id,
            'precio_unitario' => $request->precio_unitario,
            'cantidad' => 1, // Puedes ajustar esto si permites múltiples cantidades
        ]);

        return back()->with('success', 'Carta añadida a la cesta');
    }

    public function eliminar($id)
    {
        CestaItem::destroy($id);
        return redirect()->route('cesta.index')->with('success', 'Carta eliminada');
    }

    public function comprar()
    {
        $user = Auth::user();
        $cesta = Cesta::where('user_id', $user->id)->first();

        if ($cesta) {
            $cesta->items()->delete();
        }

        return redirect()->route('inicio')->with('success', 'Compra realizada correctamente');
    }
    public function incrementar($id)
{
    $item = CestaItem::findOrFail($id);
    $item->cantidad += 1;
    $item->save();

    return redirect()->route('cesta.index');
}

public function decrementar($id)
{
    $item = CestaItem::findOrFail($id);
    $item->cantidad = max(1, $item->cantidad - 1); // No baja de 1
    $item->save();

    return redirect()->route('cesta.index');
}
public function vaciar()
{
    $user = Auth::user();
    $cesta = Cesta::where('user_id', $user->id)->first();

    if ($cesta) {
        $cesta->items()->delete(); // elimina todos los CestaItem
        $cesta->delete(); // elimina la propia cesta
    }

    return redirect()->route('cesta.index')->with('success', 'Cesta vaciada correctamente');
}


}
