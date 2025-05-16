@extends('layouts.app')

@section('content')

<style>
    .section-bar {
        background-color: #ddd;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
        max-width: 1221px;
        display: flex;
        align-items: center;
        justify-content: start;
        margin-top: 5px;
        margin-left: 5px;
    }

    .carta-main {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: flex-start;
        padding: 20px;
        margin-left: 5px;
        gap: 30px;
    }

    .carta-imagen img {
        width: 220px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    .vendedores-section {
        flex: 1;
        min-width: 300px;
        max-width: 950px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .vendedores-titulo {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    thead {
        background-color: #f3f3f3;
    }

    th, td {
        padding: 10px 15px;
        text-align: left;
        border-bottom: 1px solid #000; /* Línea negra */
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:nth-child(even) {
        background-color: #fafafa;
    }

    td:last-child {
        text-align: center;
    }

    .text-center {
        text-align: center;
    }

    .carrito-btn {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }

    .carrito-btn img {
        width: 24px;
        height: auto;
    }

    html, body {
        overflow-x: hidden;
    }
</style>

<div class="section-bar">Detalle de la Carta</div>

<div class="carta-main">
    <div class="carta-imagen">
        @if($imagenCarta)
            <img src="{{ $imagenCarta }}" alt="Imagen de la carta {{ $carta->nombre_carta_api }}">
        @else
            <p>Imagen no disponible</p>
        @endif
    </div>

    <div class="vendedores-section">
        <div class="vendedores-titulo">Vendedores disponibles</div>

        @if($vendedores->isEmpty())
            <p class="text-center text-gray-500">No hay vendedores disponibles.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Vendedor</th>
                        <th>Estado</th>
                        <th>Precio</th>
                        <th>Añadir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendedores as $v)
                        <tr>
                            <td>{{ $v->vendedor }}</td>
                            <td>{{ ucfirst($v->estado) }}</td>
                            <td>{{ number_format($v->precio, 2) }} €</td>
                            <td>
                                <form method="POST" action="{{ route('cesta.agregar') }}">
                                    @csrf
                                    <input type="hidden" name="carta_id" value="{{ $carta->id }}">
                                    <input type="hidden" name="precio_unitario" value="{{ $v->precio }}">

                                    <button type="submit" class="carrito-btn">
                                        <img src="{{ asset('imagenes/carrito.png') }}" alt="Añadir a la cesta">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
