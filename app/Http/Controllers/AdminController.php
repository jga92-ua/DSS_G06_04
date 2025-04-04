<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carta;
use App\Models\Categoria;





class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el orden para usuarios y categorías
        $ordenUsuarios = $request->input('orden_usuarios', 'asc'); // Por defecto ascendente
        $ordenCategorias = $request->input('orden_categorias', 'asc'); // Por defecto ascendente
    
        // Obtener usuarios con filtrado y ordenación
        $usuarios = User::query()
            ->when($request->input('nombre'), function ($query, $nombre) {
                $query->where('name', 'like', "%{$nombre}%");
            })
            ->when($request->input('numTelf'), function ($query, $numTelf) {
                $query->where('numTelf', 'like', "%{$numTelf}%");
            })
            ->orderBy('name', $ordenUsuarios) // Aseguramos que se ordene correctamente
            ->get();
    
        // Obtener categorías con filtrado y ordenación
        $categorias = Categoria::query()
            ->when($request->input('nombre_categoria'), function ($query, $nombre) {
                $query->where('nombre', 'like', "%{$nombre}%");
            })
            ->orderBy('nombre', $ordenCategorias)
            ->get();
    
        return view('admin.index', compact('usuarios', 'categorias', 'ordenUsuarios', 'ordenCategorias'));
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

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.editUser.edit', compact('usuario'));
    }

        public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
        ]);

        $usuario = User::findOrFail($id);
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.index')->with('success', 'Usuario actualizado');
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
            'direccion' => $request->input('direccion'),
            'numTelf' => $request->input('numTelf'),
        ]);
        

        return redirect()->route('admin.index')->with('success', 'Usuario creado correctamente.');
    }
}

