@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de administración</h1>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 20px;">
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <button type="submit">Crear usuario</button>
        </form>

        <!-- Botón para mostrar/ocultar filtros -->
        <button onclick="toggleFiltro()" style="padding: 8px 12px; background-color: #17a2b8; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Filtrar
        </button>
    </div>

    <!-- Contenedor del filtro desplegable -->
    <div id="filtro-container" style="display: none; border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
        <form action="{{ route('admin.index') }}" method="GET">
            <label for="orden">Ordenar por:</label>
            <select name="orden" id="orden">
                <option value="nombre_asc">Nombre (A-Z)</option>
                <option value="nombre_desc">Nombre (Z-A)</option>
                <option value="fecha_asc">Fecha (Menos reciente → Más reciente)</option>
                <option value="fecha_desc">Fecha (Más reciente → Menos reciente)</option>
            </select>
            <button type="submit" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
                Aplicar
            </button>
        </form>
    </div>


    <h2>Usuarios existentes:</h2>
    @foreach($usuarios as $usuario)
        <div style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <strong>Nombre:</strong> {{ $usuario->name }} <br>
                <strong>Email:</strong> {{ $usuario->email }} <br>
            </div>

            <form action="{{ route('user.destroy', ['id' => $usuario->id]) }}" method="POST" style="margin-left: auto;">
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

<script>
    function toggleFiltro() {
        var filtro = document.getElementById("filtro-container");
        filtro.style.display = (filtro.style.display === "none" || filtro.style.display === "") ? "block" : "none";
    }
</script>


@endsection
