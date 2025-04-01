@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: auto; padding: 20px;">
    <h1 style="text-align: center;">Mis cartas subidas</h1>

    @if(session('success'))
        <div style="color: green; text-align: center;">{{ session('success') }}</div>
    @endif

    <!-- Contenedor con Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 15px;">

        @foreach($cartas as $carta)
            <div style="border: 1px solid #ccc; padding: 10px; border-radius: 8px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); background: #fff;">
                <p><strong>Nombre:</strong> {{ $carta['nombre'] }}</p>
                <p><strong>Rareza:</strong> {{ $carta['rareza'] }}</p>
                <p><strong>Estado:</strong> {{ $carta['estado'] }}</p>
                <p><strong>Precio:</strong> {{ $carta['precio'] }} €</p>
                <p><strong>Fecha:</strong> {{ $carta['fecha_adquisicion'] }}</p>

                <form action="{{ route('cartas.destroy', $carta['id']) }}" method="POST" style="margin-top: 10px; text-align: center;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">
                        Eliminar
                    </button>
                </form>
            </div>
        @endforeach

    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ url('/cartas/buscar') }}" 
           style="background-color: #007bff; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">
            + Subir nueva carta
        </a>
    </div>
</div>
@endsection
