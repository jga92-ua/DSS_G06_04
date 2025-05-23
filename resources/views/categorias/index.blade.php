@extends('layouts.app')

@section('content')
<div>
    <h1 class="titulo">Categorías</h1>
</div>

<div class="catalogo">
    @foreach ($categorias as $categoria)
        <a href="{{ route('categorias.create', $categoria->id) }}" class="categoria-card">
            <h3>{{ $categoria->nombre }}</h3>
            <p>{{ $categoria->descripcion }}</p>
        </a>
    @endforeach
</div>

<a href="{{ route('categorias.create') }}" class="btn-subir-categoria">
    Nueva categoría
</a>

<style>
    .titulo {
        width: 93%;
        text-align: left;
        font-size: 22px;
        font-weight: bold;
        color: white;
        padding: 10px 20px;
        background-color: #606060;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .catalogo {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 0 20px;
    }

    .categoria-card {
        flex: 1 1 calc(33.33% - 40px);
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        text-decoration: none;
        color: black;
        transition: background-color 0.2s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .categoria-card:hover {
        background-color: #e0e0e0;
    }

    .btn-subir-categoria {
        position: fixed;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #606060;
        color: white;
        padding: 14px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 18px;
        font-weight: bold;
    }

    .btn-subir-categoria:hover {
        background-color: #505050;
    }
</style>
@endsection
