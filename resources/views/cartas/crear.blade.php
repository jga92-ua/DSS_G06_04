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

<div style="max-width: 600px; margin: auto; padding: 20px;">
    <h1 style="text-align: center; margin-bottom: 20px;">Subir Carta Personalizada</h1>

    @if(session('success'))
        <div style="color: green; text-align: center; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('cartas.store') }}">
        @csrf

        {{-- Nombre de la carta desde la API --}}
        <input type="hidden" name="nombre_carta_api" value="{{ $nombre_carta_api ?? '' }}">
        
        <h3 style="width: 100%; padding: 10px;">{{ $nombre_carta_api ?? '' }}</h3>
        
        {{-- ID de la carta desde la API --}}
        <input type="hidden" name="id_carta_api" value="{{ $id_carta_api ?? '' }}">

        {{-- Rareza --}}
        <div style="margin-bottom: 15px;">
            <label for="rareza">Rareza</label>
            <select name="rareza" required 
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                <option value="">Selecciona una opción</option>
                <option value="common">Común</option>
                <option value="uncommon">Poco común</option>
                <option value="rare">Rara</option>
                <option value="holo rare">Holo rara</option>
                <option value="promo">Promocional</option>
            </select>
        </div>

        {{-- Estado --}}
        <div style="margin-bottom: 15px;">
            <label for="estado">Estado</label>
            <select name="estado" required 
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                <option value="">Selecciona el estado</option>
                <option value="nuevo">Nuevo</option>
                <option value="mint">Mint</option>
                <option value="bueno">Bueno</option>
                <option value="usado">Usado</option>
                <option value="dañado">Dañado</option>
            </select>
        </div>

        {{-- Precio --}}
        <div style="margin-bottom: 15px;">
            <label for="precio">Precio (€)</label>
            <input type="number" name="precio" step="0.01" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
        </div>

        {{-- Fecha de adquisición --}}
        <div style="margin-bottom: 20px;">
            <label for="fecha_adquisicion">Fecha de adquisición</label>
            <input type="date" name="fecha_adquisicion" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
        </div>

        <button type="submit" 
                style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 6px;">
            Subir carta
        </button>
    </form>
</div>
@endsection
