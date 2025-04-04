@extends('layouts.app')

@section('content')
<!-- Barra superior fija con botones -->
<div style="position: fixed; top: 0; left: 0; width: 100%; background: #f9f9f9; padding: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); z-index: 999;">
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <a href="{{ route('inicio') }}" style="background-color: #007bff; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Inicio</a>
        <a href="{{ url('/cartas/buscar') }}" style="background-color: #17a2b8; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Buscar carta</a>
        <a href="{{ route('cartas.mis') }}" style="background-color: #6f42c1; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Mis cartas</a>
    </div>
</div>

<!-- Espacio para evitar que el contenido quede oculto por la barra -->
<div style="height: 65px;"></div>


<div style="max-width: 1200px; margin: auto; padding: 20px;">
    <h1 style="text-align: center;">Mis cartas subidas</h1>

    @if(session('success'))
        <div style="color: green; text-align: center;">{{ session('success') }}</div>
    @endif

    <!-- Contenedor con Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 10px;">

    @foreach($cartas as $carta)
        <div style="border: 1px solid #ccc; padding: 8px; border-radius: 6px; box-shadow: 1px 1px 6px rgba(0,0,0,0.08); background: #fff;">
            <p><strong>Nombre:</strong> {{ $carta['nombre'] }}</p>
            <p><strong>Rareza:</strong> {{ $carta['rareza'] }}</p>
            <p><strong>Estado:</strong> {{ $carta['estado'] }}</p>
            <p><strong>Precio:</strong> {{ $carta['precio'] }} €</p>
            <p><strong>Fecha:</strong> {{ $carta['fecha_adquisicion'] }}</p>

            <a href="{{ route('cartas.edit', $carta['id']) }}" 
                style="background-color: blue; color: white; padding: 4px 8px; text-decoration: none; border-radius: 4px; display: inline-block; margin-top: 6px;">
                Editar
            </a>

            <form action="{{ route('cartas.destroy', $carta['id']) }}" method="POST" style="margin-top: 6px; text-align: center;">
                @csrf
                @method('DELETE')
                <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 4px 10px; border-radius: 4px; cursor: pointer;">
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
