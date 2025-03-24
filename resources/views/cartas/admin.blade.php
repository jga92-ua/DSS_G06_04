@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cartas subidas por todos los usuarios</h1>

        @foreach($cartas as $carta)
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px;">
                <p><strong>ID:</strong> {{ $carta->id }}</p>
                <p><strong>ID Usuario:</strong> {{ $carta->usuario_id }}</p>
                <p><strong>ID de carta API:</strong> {{ $carta->id_carta_api }}</p>
                <p><strong>Rareza:</strong> {{ $carta->rareza }}</p>
                <p><strong>Estado:</strong> {{ $carta->estado }}</p>
                <p><strong>Precio:</strong> {{ $carta->precio }} €</p>
                <p><strong>Fecha:</strong> {{ $carta->fecha_adquisicion }}</p>

                <form action="{{ route('cartas.destroy', $carta->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 6px 10px; border-radius: 4px;">
                        Eliminar
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
