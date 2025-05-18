@extends('layouts.app')

@section('content')
<style>
    .cesta-container {
        max-width: 1200px;
        margin: 20px;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 8px;
    }

    .cesta-header,
    .cesta-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        margin-bottom: 10px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .cesta-header {
        font-weight: bold;
        background-color: #e0e0e0;
    }

    .cesta-col {
        width: 20%;
        text-align: center;
    }

    .cesta-info {
        width: 20%;
        text-align: left;
    }

    .cesta-info strong {
        display: block;
    }

    .cantidad-control {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .cantidad-control form {
        display: inline;
    }

    .cantidad-control button {
        padding: 4px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }

    .finalizar-btn {
        margin: 20px auto;
        background-color: #5cb85c;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }

    .precio-final {
        text-align: center;
        margin-top: 40px;
    }

    .precio-final h3 {
        margin-bottom: 10px;
    }

    .precio-final label {
        display: inline-block;
        margin-bottom: 15px;
    }

    .vaciar-btn-container {
        text-align: right;
        margin-top: 10px;
    }

    .vaciar-btn-container form {
        display: inline;
    }

    .vaciar-btn {
        background-color: #d9534f;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
    }

    html, body {
        overflow-x: hidden;
    }

</style>

<div class="cesta-container">
    <h2>Cesta de Compra</h2>

    <div class="cesta-header">
        <div class="cesta-info">Producto</div>
        <div class="cesta-col">Precio</div>
        <div class="cesta-col">Cantidad</div>
        <div class="cesta-col">Total</div>
        <div class="cesta-col">Acción</div>
    </div>

    @forelse ($cartasEnCesta as $item)
        <div class="cesta-item">
            <div class="cesta-info">
                <strong>{{ $item->carta->nombre_carta_api }}</strong>
                Código: {{ $item->carta->id_carta_api }}
            </div>
            <div class="cesta-col">{{ number_format($item->precio_unitario, 2) }} €</div>
            <div class="cesta-col cantidad-control">
                <form method="POST" action="{{ route('cesta.decrementar', $item->id) }}">
                    @csrf
                    <button type="submit">−</button>
                </form>
                {{ $item->cantidad }}
                <form method="POST" action="{{ route('cesta.incrementar', $item->id) }}">
                    @csrf
                    <button type="submit">+</button>
                </form>
            </div>
            <div class="cesta-col">{{ number_format($item->cantidad * $item->precio_unitario, 2) }} €</div>
            <div class="cesta-col">
                <form method="POST" action="{{ route('cesta.eliminar', $item->id) }}">
                    @csrf
                    <button type="submit">Eliminar</button>
                </form>
            </div>
        </div>
    @empty
        <p style="text-align: center;">No hay cartas en la cesta.</p>
    @endforelse

    @if (!$cartasEnCesta->isEmpty())
        <div class="precio-final">
            <h3>PRECIO TOTAL (21% IVA): {{ number_format($precioTotal * 1.21, 2) }} EUROS</h3>

            <form method="POST" action="{{ route('cesta.comprar') }}">
                @csrf
                <label>
                    <input type="checkbox" required>
                    He leído y acepto los <a href="#">términos y condiciones</a> de venta de PokeMarket TCG
                </label>
                <br>
                <button type="submit" class="finalizar-btn">Finalizar Compra</button>
            </form>

            <div class="vaciar-btn-container">
                <form action="{{ route('cesta.vaciar') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres vaciar la cesta?');">
                    @csrf
                    <button type="submit" class="vaciar-btn">Vaciar Cesta</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection