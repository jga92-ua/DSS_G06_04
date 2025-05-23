@extends('layouts.app')

@section('content')
<div class="detalle-categoria">
    <h1>{{ $categoria->nombre }}</h1>
    <p>{{ $categoria->descripcion }}</p>

    <a href="{{ route('categorias.index') }}">← Volver a categorías</a>
</div>

<style>
    .detalle-categoria {
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 10px;
        margin: 20px;
    }

    .detalle-categoria h1 {
        font-size: 28px;
        color: #333;
    }

    .detalle-categoria p {
        font-size: 18px;
        color: #666;
    }
</style>
@endsection
