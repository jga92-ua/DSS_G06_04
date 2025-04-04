@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buscar cartas Pokémon</h1>

    <form method="GET" action="{{ route('cartas.buscar') }}" style="margin-bottom: 20px;">
        <input type="text" name="nombre" placeholder="Nombre de la carta" required>
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

                            <button class="boton-fluor-rosa">Subir Carta</button>

                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
