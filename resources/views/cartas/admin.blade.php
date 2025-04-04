@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align: center;">Cartas subidas por todos los usuarios</h1>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; padding: 10px;">
            @foreach($cartas as $carta)
                <div style="border: 1px solid #ccc; padding: 8px; border-radius: 6px; background: #fff; font-size: 14px;">
                    <p><strong>Nombre:</strong> {{ $carta['nombre_cartas'] }}</p>
                    <p><strong>Rareza:</strong> {{ $carta->rareza }}</p>
                    <p><strong>Estado:</strong> {{ $carta->estado }}</p>
                    <p><strong>Precio:</strong> {{ $carta->precio }} €</p>
                    <p><strong>Fecha:</strong> {{ $carta->fecha_adquisicion }}</p>

                    <form action="{{ route('cartas.destroy', $carta->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                style="width: 100%; background-color: #dc3545; color: white; border: none; padding: 6px;
                                       border-radius: 4px; cursor: pointer; font-size: 12px;">
                            Eliminar
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
