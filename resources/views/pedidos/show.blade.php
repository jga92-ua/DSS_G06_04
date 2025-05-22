@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="titulo-pedido">
            Detalles del Pedido #{{ $pedido->id }}
        </div>

        <div class="info-productos-container d-flex flex-wrap mt-4">
            <div class="info-box me-4 mb-4">
                <p><strong>Dirección</strong><br>{{ $pedido->direccion_envio }}</p>
                <p><strong>Fecha</strong><br>{{ $pedido->fecha_pedido }}</p>
            </div>

            <div class="tabla-box flex-grow-1">
                <table class="table tabla-productos w-100">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Vendedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->items as $item)
                            @php
                                $parts = explode('-', $item->carta->id_carta_api);
                                $set = $parts[0] ?? '';
                                $number = $parts[1] ?? '';
                            @endphp
                            <tr>
                                <td>
                                    <img src="https://images.pokemontcg.io/{{ $set }}/{{ $number }}_hires.png"
                                        width="80" alt="{{ $item->carta->nombre_carta_api }}">
                                </td>
                                <td>{{ $item->carta->nombre_carta_api }}</td>
                                <td>{{ number_format($item->precio_unitario, 2) }} €</td>
                                <td>{{ $item->cantidad }}</td>
                                <td>{{ $item->carta->usuario->name ?? 'Desconocido' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .titulo-pedido {
            background-color: #606060;
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 20px;
            max-width: 1221px;
        }

        .info-productos-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-start;
        }

        .info-box {
            background-color: #e9e9e9;
            padding: 20px;
            border-radius: 8px;
            min-width: 250px;
            max-width: 300px;
            flex-shrink: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .tabla-productos thead {
            background-color: #ddd;
            font-weight: bold;
        }

        .tabla-productos th, .tabla-productos td {
            text-align: center;
            vertical-align: middle;
        }

        @media (max-width: 768px) {
            .info-productos-container {
                flex-direction: column;
            }
        }
    </style>
@endsection

