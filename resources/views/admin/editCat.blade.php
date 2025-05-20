@extends('layouts.app')

@section('content')

<style>
    
    body, html {
        overflow-x: hidden;
    }

</style>

<!-- Espaciado para evitar solapamiento con la barra -->
<div style="height: 70px;"></div>

<!-- Contenedor principal -->
<div class="container" style="max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

    <h2 style="text-align: center; margin-bottom: 20px;">Editar Categoría</h2>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        @csrf
        @method('PUT')

        <div style="display: flex; flex-direction: column;">
            <label for="nombre" style="font-weight: bold; margin-bottom: 5px;">Nombre</label>
            <input type="text" name="nombre" value="{{ $categoria->nombre }}" required style="padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
        </div>

        <div style="display: flex; flex-direction: column;">
            <label for="descripcion" style="font-weight: bold; margin-bottom: 5px;">Descripción</label>
            <input type="text" name="descripcion" value="{{ $categoria->descripcion }}" style="padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
        </div>

        <button type="submit" style="padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 6px; font-size: 16px;">
            Actualizar categoría
        </button>
    </form>
</div>

@endsection