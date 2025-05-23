<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Carta;

class CategoriaController extends Controller
{
    // Vista pública para los usuarios normales
    public function showPublic()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.show', compact('categoria'));
    }

    // Vista solo para administradores
    public function adminIndex()
    {
        $categorias = Categoria::all();
        return view('admin.categorias', compact('categorias'));
    }

    // Formulario de creación (solo admin)
    public function create()
    {
        return view('admin.createCat');
    }

    // Formulario de creación para usuario normal (si quieres permitirlo)
    public function createPublic()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        // Crear la categoría
        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        // Redirigir a la lista de categorías con mensaje de éxito (opcional)
        return redirect()->route('categorias.index')
                        ->with('success', 'Categoría creada correctamente.');
    }


    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.editCat', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.categorias')->with('success', 'Categoría actualizada');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->back()->with('success', 'Categoría eliminada');
    }

    // Mostrar una categoría concreta
    public function showCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.show', compact('categoria'));
    }

    public function editCartas($id)
    {
        $categoria = Categoria::findOrFail($id);
        $cartas = Carta::all();
        return view('categorias.select_cartas', compact('categoria', 'cartas'));
    }

    public function updateCartas(Request $request, $id)
    {
        $request->validate([
            'id_cartas' => 'required|array|min:1',
        ], [
            'id_cartas.required' => 'Debes seleccionar al menos una carta.',
            'id_cartas.min' => 'Debes seleccionar al menos una carta.',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->id_cartas = $request->input('id_cartas', []); // Asegúrate de tener $casts en el modelo
        $categoria->save();

        return redirect()->route('categorias.show', $id)->with('success', 'Cartas actualizadas correctamente.');
    }
}