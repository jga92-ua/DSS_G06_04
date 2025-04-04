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

<div class="container">
    <h1>Buscar cartas Pokémon</h1>

    <form method="GET" action="{{ route('cartas.buscar') }}">
    <input type="text" name="query" placeholder="Nombre o tipo" required>
    <button type="submit">Buscar</button>
</form>


    @if(isset($cartas))
        <h2>Resultados:</h2>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
            @foreach($cartas as $carta)
                <div style="border: 1px solid #ccc; padding: 10px; text-align: center; border-radius: 8px; display: flex; flex-direction: column; align-items: center;">
                    <img src="{{ $carta['images']['small'] }}" alt="Carta" width="120">
                    <p><strong>Nombre:</strong> {{ $carta['name'] }}</p>

                    <div style="margin-top: auto; padding-top: 10px; width: 100%; display: flex; justify-content: center;">
                        <form method="GET" action="{{ route('cartas.create') }}">
                            <input type="hidden" name="id_carta_api" value="{{ $carta['id'] }}">
                            <input type="hidden" name="nombre_carta_api" value="{{ $carta['name'] }}">
                            <button type="submit" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
                                Seleccionar esta carta
                            </button>

                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
