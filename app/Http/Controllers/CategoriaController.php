<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function show(){
        return view('categoria.index');
    }

    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.index.blade.php', compact('categorias'));
    }

    public function create()
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

        public function adminIndex()
        {
            $categorias = Categoria::all();
            return view('admin.categorias', compact('categorias'));

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

        return redirect()->route('admin.index')->with('success', 'Categoría actualizada');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->back()->with('success', 'Categoría eliminada');
    }
}
