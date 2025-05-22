@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Detalles del Pedido #{{ $pedido->id }}</h2>
    <p><strong>Dirección:</strong> {{ $pedido->direccion_envio }}</p>
    <p><strong>Fecha:</strong> {{ $pedido->fecha_pedido }}</p>

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
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
                <tr>
                    @php
                        $parts = explode('-', $item->carta->id_carta_api);
                        $set = $parts[0] ?? '';
                        $number = $parts[1] ?? '';
                    @endphp
                    <td>
                        <img src="https://images.pokemontcg.io/{{ $set }}/{{ $number }}_hires.png" width="80" alt="{{ $item->carta->nombre_carta_api }}">
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
@endsection
