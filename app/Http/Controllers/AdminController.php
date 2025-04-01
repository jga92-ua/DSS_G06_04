<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carta;



class AdminController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = User::all();
        $orden = $request->query('orden', 'fecha_desc'); // Por defecto, ordenamos por fecha descendente

        $usuarios = User::query();

        if ($orden == 'nombre_asc') {
            $usuarios->orderBy('name', 'asc');
        } elseif ($orden == 'nombre_desc') {
            $usuarios->orderBy('name', 'desc');
        } elseif ($orden == 'fecha_asc') {
            $usuarios->orderBy('created_at', 'asc');
        } elseif ($orden == 'fecha_desc') {
            $usuarios->orderBy('created_at', 'desc');
        }

        return view('admin.index', ['usuarios' => $usuarios->get()]);
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

