@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de administración</h1>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <div style="display: flex; gap: 30px; align-items: flex-start;">

        <!-- 🧍 Usuarios (columna izquierda) -->
        <div style="flex: 1;">
            <h2>Usuarios</h2>

            <form action="{{ route('admin.store') }}" method="POST" style="margin-bottom: 20px;">
                @csrf
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                <button type="submit">Crear usuario</button>
            </form>

            @foreach($usuarios as $usuario)
                <div style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
                    <strong>Nombre:</strong> {{ $usuario->name }}<br>
                    <strong>Email:</strong> {{ $usuario->email }}<br>

                    <form action="{{ route('user.destroy', ['id' => $usuario->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color: #dc3545; color: white; padding: 5px 10px; border: none; border-radius: 4px;">
                            Eliminar
                        </button>
                    </form>


                </div>
            @endforeach
        </div>

        <!-- 🗂 Categorías (columna derecha) -->
        <div style="flex: 1;">
            <h2>Categorías</h2>

            <form action="{{ route('admin.categorias.store') }}" method="POST" style="margin-bottom: 20px;">
                @csrf
                <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
                <input type="text" name="descripcion" placeholder="Descripcion" required>
                <button type="submit">Crear categoría</button>
            </form>

            @foreach($categorias as $categoria)
                <div style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
                    {{ $categoria->nombre }}

                    <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color: #dc3545; color: white; padding: 5px 10px; border: none; border-radius: 4px;">
                            Eliminar
                        </button>
                    </form>
                    <a href="{{ route('categorias.edit', $categoria->id) }}"
           style="flex: 1; background-color: rgb(63, 133, 90); color: white; text-align: center;
                  text-decoration: none; padding: 6px; border-radius: 4px; font-size: 12px;">
            Editar
        </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
