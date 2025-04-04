@extends('layouts.app')

@section('content')
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
