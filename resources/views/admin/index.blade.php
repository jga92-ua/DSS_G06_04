@extends('layouts.app')

@section('content')

<style>
    .container {
        max-width: 1200px;
        margin-left: 5px;
        margin-right: auto;
        padding: 20px;
    }

    .top-bar {
        background-color: #ddd;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: start;
        margin-top: 10px;
    }

    .admin-panel {
        display: flex;
        gap: 30px;
        align-items: flex-start;
        margin-top: 20px;
    }

    .admin-column {
        flex: 1;
    }

    .form-group {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .form-group input, .form-group select, .form-group button {
        flex: 1;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #aaa;
        font-size: 14px;
    }

    .admin-item {
        background-color: white;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .admin-buttons {
        margin-top: 10px;
    }

    .admin-buttons a, .admin-buttons button {
        margin-right: 5px;
    }

    .section-title {
        margin: 20px 0 10px;
        background-color: white;
        padding: 8px;
        border: 2px solid black;
        border-radius: 5px;
        font-size: 18px;
        text-align: center;
    }
</style>

<div class="container">
    <div class="top-bar">Panel de administración</div>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <div class="admin-panel">

        <!-- 🧍 Usuarios (columna izquierda) -->
        <div class="admin-column">
            <!-- Formulario de Crear Usuario -->
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Nombre" required>
                    <input type="email" name="email" placeholder="Correo" required>
                    <input type="password" name="contraseña" placeholder="Contraseña" required>
                </div>

                <div class="form-group">
                    <input type="text" name="direccion" placeholder="Dirección">
                    <input type="text" name="numTelf" placeholder="Número de teléfono">
                    <button type="submit" style="background-color: #eee;">Crear Usuario</button>
                </div>
            </form>

            <!-- Filtro de Usuarios -->
            <form method="GET" action="{{ route('admin.index') }}">
                <div class="form-group">
                    <input type="text" name="nombre_usuario" placeholder="Buscar nombre..." value="{{ request('nombre_usuario') }}">
                    <select name="orden_usuarios">
                        <option value="asc" {{ request('orden_usuarios') == 'asc' ? 'selected' : '' }}>Nombre (A-Z)</option>
                        <option value="desc" {{ request('orden_usuarios') == 'desc' ? 'selected' : '' }}>Nombre (Z-A)</option>
                    </select>
                    <button type="submit" style="background-color: #007bff; color: white;">Filtrar</button>
                </div>
            </form>

            <!-- Usuarios Existentes -->
            <div class="section-title">Usuarios Existentes:</div>

            @foreach($usuarios as $usuario)
                <div class="admin-item">
                    <strong>Nombre:</strong> {{ $usuario->name }}<br>
                    <strong>Email:</strong> {{ $usuario->email }}<br>
                    <strong>Teléfono:</strong> {{ $usuario->numTelf }}<br>

                    <div class="admin-buttons">
                        <a href="{{ route('admin.usuarios.edit', $usuario->id) }}"
                        style="background-color: #ffc107; color: black; padding: 5px 10px; border-radius: 4px; text-decoration: none;">Editar</a>

                        <form action="{{ route('user.destroy', ['id' => $usuario->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 4px;">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 🗂 Categorías (columna derecha) -->
        <div class="admin-column">
            <!-- Formulario Crear Categoría -->
            <form action="{{ route('admin.categorias.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
                    <input type="text" name="descripcion" placeholder="Descripción" required>
                    <button type="submit" style="background-color: #eee;">Crear Categoría</button>
                </div>
            </form>

            <!-- Filtro de Categorías -->
            <form method="GET" action="{{ route('admin.index') }}">
                <div class="form-group">
                    <select name="orden_categorias">
                        <option value="asc" {{ request('orden_categorias') == 'asc' ? 'selected' : '' }}>Nombre (A-Z)</option>
                        <option value="desc" {{ request('orden_categorias') == 'desc' ? 'selected' : '' }}>Nombre (Z-A)</option>
                    </select>
                    <button type="submit" style="background-color: #007bff; color: white;">Filtrar</button>
                </div>
                <div class="form-group">
                    <input type="text" name="nombre_categoria" placeholder="Buscar categoría..." value="{{ request('nombre_categoria') }}">
                    <button type="submit" style="background-color: #007bff; color: white;">Buscar</button>
                </div>
            </form>

            <!-- Categorías Existentes -->
            <div class="section-title">Categorías Existentes:</div>

            @foreach($categorias as $categoria)
                <div class="admin-item">
                    <strong>Nombre:</strong> {{ $categoria->nombre }}<br>
                    <strong>Descripción:</strong> {{ $categoria->descripcion }}<br>

                    <div class="admin-buttons">
                        <a href="{{ route('categorias.edit', $categoria->id) }}"
                        style="background-color: #ffc107; color: black; padding: 5px 10px; border-radius: 4px; text-decoration: none;">Editar</a>

                        <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 4px;">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
