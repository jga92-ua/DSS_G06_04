@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buscar cartas Pokémon</h1>

    <form method="GET" action="{{ route('cartas.buscar') }}">
        <input type="text" name="nombre" placeholder="Nombre de la carta" required>
        <button type="submit">Buscar</button>
    </form>

    @if(isset($cartas))
        <h2>Resultados:</h2>
        @foreach($cartas as $carta)
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <img src="{{ $carta['images']['small'] }}" alt="Carta" width="150">
                <p><strong>Nombre:</strong> {{ $carta['name'] }}</p>
                <p><strong>ID:</strong> {{ $carta['id'] }}</p>

                <form method="GET" action="{{ route('cartas.create') }}">
                    <input type="hidden" name="id_carta_api" value="{{ $carta['id'] }}">
                    <button type="submit">Seleccionar esta carta</button>
                </form>
            </div>
        @endforeach
    @endif
</div>
@endsection
