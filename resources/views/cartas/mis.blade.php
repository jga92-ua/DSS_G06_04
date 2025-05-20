@extends('layouts.app')

@section('content')

<div style="max-width: 1200px; margin-left: 10px; padding: 20px;">
    <h1 style="text-align: center;">Mis cartas subidas</h1>

    @if(session('success'))
        <div style="color: green; text-align: center; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif

    <!-- Contenedor con Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 10px;">

    @foreach($cartas as $carta)
        <div style="border: 1px solid #ccc; padding: 12px; border-radius: 6px; box-shadow: 1px 1px 6px rgba(0,0,0,0.08); background: #fff; display: flex; flex-direction: column; justify-content: space-between; height: 100%; font-size: 14px;">
            <p style="margin: 4px 0;"><strong>Nombre:</strong> {{ $carta['nombre'] }}</p>
            <p style="margin: 4px 0;"><strong>Rareza:</strong> {{ $carta['rareza'] }}</p>
            <p style="margin: 4px 0;"><strong>Estado:</strong> {{ $carta['estado'] }}</p>
            <p style="margin: 4px 0;"><strong>Precio:</strong> {{ $carta['precio'] }} €</p>
            <p style="margin: 4px 0;"><strong>Fecha:</strong> {{ $carta['fecha_adquisicion'] }}</p>

            <div style="display: flex; justify-content: space-between; margin-top: 8px;">
                <a href="{{ route('cartas.edit', $carta['id']) }}" 
                    style="background-color: #007bff; color: white; padding: 6px 10px; text-decoration: none; border-radius: 4px;">
                    Editar
                </a>

                <form action="{{ route('cartas.destroy', $carta['id']) }}" method="POST" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer;">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    @endforeach

</div>

    <div style="position: fixed; bottom: 40px; left: 50%; transform: translateX(-50%);">
        <a href="{{ url('/cartas/buscar') }}" 
        style="background-color: #007bff; color: white; padding: 14px 20px; border-radius: 6px; text-decoration: none; font-size: 18px; font-weight: bold;">
            + Subir nueva carta
        </a>
    </div>

</div>
@endsection
