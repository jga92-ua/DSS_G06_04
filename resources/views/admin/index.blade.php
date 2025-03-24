@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de administración</h1>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.store') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="contraseña" placeholder="Contraseña" required>
        <button type="submit">Crear usuario</button>
    </form>

    <h2>Usuarios existentes:</h2>
    @foreach($usuarios as $usuario)
        <div style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
            <strong>Nombre:</strong> {{ $usuario->name }}<br>
            <strong>Email:</strong> {{ $usuario->email }}
            <form action="{{ route('user.destroy', ['id' => $usuario->id]) }}" method="POST" style="margin-top: 10px;">
             @csrf
                @method('DELETE')
                <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 4px;">
                    Eliminar
                </button>
            </form>
        </div>

    @endforeach
</div>
<a href="{{ route('cartas.buscar') }}" 
   style="background-color: #007bff; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">
    + Subir carta como admin
</a>


@error('contraseña')
    <div style="color: red; font-size: 14px;">
        {{ $message }}
    </div>
@enderror
@endsection
