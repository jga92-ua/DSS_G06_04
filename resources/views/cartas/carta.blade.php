@extends('layouts.app')

@section('content')

<style>
    .container {
        max-width: 1200px;
        margin-left: 5px;
        margin-right: auto;
        padding: 20px;
        text-align: center;
    }

    .carta-container {
        max-width: 1000px;
        margin: 30px auto;
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: center;
    }

    .carta-imagen img {
        width: 300px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .vendedores {
        flex: 1;
        min-width: 300px;
    }

    .content-section {
        display: flex;
        margin-top: 20px;
        gap: 15px;
        margin-left: 5px;
    }

    .vendedor {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
    }

    .vendedor h4 {
        margin: 0 0 5px;
    }

    html, body {
        overflow-x: hidden;
        overflow-y: auto;
    }

</style>

<div class="carta-container">
    <div class="carta-imagen">
        @if($imagenCarta)
            <img src="{{ $imagenCarta }}" alt="Imagen de la carta {{ $carta->nombre_carta_api }}">
        @else
            <p>Imagen no disponible</p>
        @endif
    </div>

    <div class="vendedores">
        <h3>Vendedores:</h3>
        @forelse($vendedores as $item)
            <div class="vendedor">
                <h4>{{ $item->cesta->user->name }}</h4>
                <p>Precio: {{ $item->precio_unitario }} €</p>
                <p>Cantidad disponible: {{ $item->cantidad }}</p>
            </div>
        @empty
            <p>No hay vendedores para esta carta.</p>
        @endforelse
    </div>
</div>

@endsection
