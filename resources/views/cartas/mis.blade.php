@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: auto; padding: 20px;">
    <h1>Mis cartas subidas</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @foreach($cartas as $carta)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px; border-radius: 8px;">
            <img src="{{ $carta['imagen'] }}" alt="Carta" width="120">
            <p><strong>Nombre:</strong> {{ $carta['nombre'] }}</p>
            <p><strong>ID de carta API:</strong> {{ $carta['id_carta_api'] ?? 'Sin ID' }}</p>
            <p><strong>Rareza:</strong> {{ $carta['rareza'] }}</p>
            <p><strong>Estado:</strong> {{ $carta['estado'] }}</p>
            <p><strong>Precio:</strong> {{ $carta['precio'] }} €</p>
            <p><strong>Fecha:</strong> {{ $carta['fecha_adquisicion'] }}</p>

            <form action="{{ route('cartas.destroy', $carta['id']) }}" method="POST" style="margin-top: 10px;">
                @csrf
                @method('DELETE')
                <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 4px;">
                    Eliminar
                </button>
            </form>
        </div>
    @endforeach

    <div style="text-align: right; margin-top: 20px;">
        <a href="{{ url('/cartas/buscar') }}" 
           style="background-color: #007bff; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">
            + Subir nueva carta
        </a>
    </div>
</div>
@endsection
