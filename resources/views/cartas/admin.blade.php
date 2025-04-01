@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align: center;">Cartas subidas por todos los usuarios</h1>

        @foreach($cartas as $carta)
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px; border-radius: 8px; 
                        display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p><strong>ID:</strong> {{ $carta->id }}</p>
                    <p><strong>ID Usuario:</strong> {{ $carta->usuario_id }}</p>
                    <p><strong>Rareza:</strong> {{ $carta->rareza }}</p>
                    <p><strong>Estado:</strong> {{ $carta->estado }}</p>
                    <p><strong>Precio:</strong> {{ $carta->precio }} €</p>
                    <p><strong>Fecha:</strong> {{ $carta->fecha_adquisicion }}</p>
                </div>

                <form action="{{ route('cartas.destroy', $carta->id) }}" method="POST" style="margin-left: auto;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            style="background-color: #dc3545; color: white; border: none; padding: 8px 12px; 
                                   border-radius: 4px; cursor: pointer;">
                        Eliminar
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
