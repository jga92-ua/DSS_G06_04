@extends('layouts.app')

@section('content')

<!-- Barra superior fija con botones -->
<div style="position: fixed; top: 0; left: 0; width: 100%; background: #f9f9f9; padding: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); z-index: 999;">
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <a href="{{ route('inicio') }}" style="background-color: #007bff; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Inicio</a>
        <a href="{{ route('admin.index') }}" style="background-color: #343a40; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Admin</a>
        <a href="{{ url('/cartas/buscar') }}" style="background-color: #17a2b8; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Buscar carta</a>
        <a href="{{ route('cartas.mis') }}" style="background-color: #6f42c1; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Mis cartas</a>
        <a href="{{ route('cartas.index') }}" style="background-color: #ffc107; color: #212529; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Ver todas las cartas</a>

    </div>
</div>

<!-- Espacio para evitar que el contenido quede oculto por la barra -->
<div style="height: 65px;"></div>


<div class="container">
    <h1>Editar Categoría</h1>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="{{ $categoria->nombre }}" required>
        </div>

        <div>
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" value="{{ $categoria->descripcion }}">
        </div>

        <button type="submit" style="margin-top: 10px;">Actualizar categoría</button>
    </form>
</div>
@endsection
