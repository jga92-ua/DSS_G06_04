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
            'nuevo_usuario' => 'required|string|min:3|max:255',
            'password' => 'required|string',
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'La contraseña no es correcta.']);
        }

        Auth::user()->update(['name' => $request->nuevo_usuario]);
        return back()->with('status', 'Usuario actualizado');
    }



    public function actualizarDireccion(Request $request) {
        // Aquí puedes validar y guardar los campos
        return back()->with('status', 'Dirección actualizada');
    }

    public function actualizarFoto(Request $request) {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $usuario = Auth::user();

        // Borrar la foto anterior si no es la por defecto
        if ($usuario->foto && \Storage::disk('public')->exists($usuario->foto)) {
            \Storage::disk('public')->delete($usuario->foto);
        }

        // Guardar la nueva
        $path = $request->file('foto')->store('perfiles', 'public');
        $usuario->update(['foto' => $path]);

        return back()->with('success', 'Foto de perfil actualizada correctamente.');
    }
}
