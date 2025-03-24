<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carta;



class AdminController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.index', compact('usuarios'));
    }
    public function destroy($id)
{
    $usuario = User::findOrFail($id);
    $usuario->delete();

    return redirect()->route('admin.index')->with('success', 'Usuario eliminado correctamente.');
}
public function adminCartas()
{
    $cartas = Carta::all(); // Todas las cartas del sistema
    return view('cartas.admin', compact('cartas'));
}



    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'contraseña' => 'required|min:6'
        ],[
            'contraseña.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);
        

        User::create([
            'name' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('contraseña')),
        ]);

        return redirect()->route('admin.index')->with('success', 'Usuario creado correctamente.');
    }
}

