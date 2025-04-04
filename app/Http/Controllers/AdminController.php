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
    $orden = $request->query('orden', 'fecha_desc');

    $usuariosQuery = User::query();

    if ($orden == 'nombre_asc') {
        $usuariosQuery->orderBy('name', 'asc');
    } elseif ($orden == 'nombre_desc') {
        $usuariosQuery->orderBy('name', 'desc');
    } elseif ($orden == 'fecha_asc') {
        $usuariosQuery->orderBy('created_at', 'asc');
    } elseif ($orden == 'fecha_desc') {
        $usuariosQuery->orderBy('created_at', 'desc');
    }

    $usuarios = $usuariosQuery->get();
    $categorias = Categoria::all(); // ✅ Añade esta línea

    // ✅ Devuelve ambas variables a la vista
    return view('admin.index', compact('usuarios', 'categorias'));
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
        ]);

        return redirect()->route('admin.index')->with('success', 'Usuario creado correctamente.');
    }
}

