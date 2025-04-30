<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'numTelf' => 'required|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email', 'numTelf', 'direccion'));

        return redirect()->route('perfil')->with('success', 'Datos actualizados correctamente.');
    }
}
