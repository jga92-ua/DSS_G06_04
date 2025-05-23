@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Crear nueva categoría</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
        </div>

        <button type="submit">Crear categoría</button>
    </form>

    <a href="{{ route('categorias.index') }}">← Volver al catálogo</a>
</div>

<style>
    .form-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"], textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    button {
        background-color: #606060;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
    }

    button:hover {
        background-color: #505050;
    }
</style>
@endsection
