<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    // Vista pública para los usuarios normales
    public function showPublic()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
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
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->back()->with('success', 'Categoría creada correctamente');
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
}