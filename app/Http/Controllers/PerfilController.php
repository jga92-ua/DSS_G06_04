<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil');
    }

    public function actualizarContraseña(Request $request){
        $request->validate([
            'actual' => 'required|string|min:8',
            'nueva' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->actual, Auth::user()->password)) {
            return back()->withErrors(['actual' => 'Contraseña actual incorrecta.']);
        }

        Auth::user()->update(['password' => Hash::make($request->nueva)]);
        return back()->with('status', 'Contraseña actualizada');
    }

    public function actualizarUsuario(Request $request) {
        $request->validate([
            'nuevo_usuario' => 'required',
        ]);

        Auth::user()->update(['name' => $request->nuevo_usuario]);
        return back()->with('status', 'Usuario actualizado');
    }

    public function actualizarDireccion(Request $request) {
        // Aquí puedes validar y guardar los campos
        return back()->with('status', 'Dirección actualizada');
    }

    public function actualizarFoto(Request $request) {
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('perfiles', 'public');
            Auth::user()->update(['foto' => $path]);
        }

        return back()->with('status', 'Foto actualizada');
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
