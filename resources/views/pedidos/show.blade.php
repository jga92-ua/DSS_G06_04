@extends('layouts.app')

@section('content')

<style>
    .pedido-container {
        max-width: 1200px;
        margin: 30px auto 60px;
        padding: 0 15px;
    }

    .pedido-header {
        background-color: #333;
        color: white;
        padding: 12px 20px;
        font-weight: bold;
        display: grid;
        grid-template-columns: 100px 1fr 100px 80px 150px;
        gap: 15px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .pedido-items {
        display: flex;
        flex-direction: column;
        gap: 10px;
        background-color: #f9f9f9;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
        overflow-x: auto;
    }

    .pedido-item {
        display: grid;
        grid-template-columns: 100px 1fr 100px 80px 150px;
        gap: 15px;
        align-items: center;
        background-color: white;
        padding: 12px 20px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }

    .pedido-item img {
        width: 100%;
        border-radius: 6px;
    }

    .item-text {
        font-size: 15px;
    }

    html, body {
        overflow-x: hidden;
    }

</style>

<div class="container mt-5">
    <h2>Detalles del Pedido #{{ $pedido->id }}</h2>
    <p><strong>Dirección:</strong> {{ $pedido->direccion_envio }}</p>
    <p><strong>Fecha:</strong> {{ $pedido->fecha_pedido }}</p>

    <div class="pedido-container">
        <div class="pedido-header">
            <div>Imagen</div>
            <div>Nombre</div>
            <div>Precio</div>
            <div>Cantidad</div>
            <div>Vendedor</div>
        </div>

        <div class="pedido-items">
            @foreach ($pedido->items as $item)
                @php
                    $parts = explode('-', $item->carta->id_carta_api);
                    $set = $parts[0] ?? '';
                    $number = $parts[1] ?? '';
                @endphp
                <div class="pedido-item">
                    <img src="https://images.pokemontcg.io/{{ $set }}/{{ $number }}_hires.png" alt="{{ $item->carta->nombre_carta_api }}">
                    <div class="item-text">{{ $item->carta->nombre_carta_api }}</div>
                    <div class="item-text">{{ number_format($item->precio_unitario, 2) }} €</div>
                    <div class="item-text">{{ $item->cantidad }}</div>
                    <div class="item-text">{{ $item->carta->usuario->name ?? 'Desconocido' }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
