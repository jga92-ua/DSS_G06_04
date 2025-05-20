@extends('layouts.app')

@section('content')

<style>
    body, html {
        overflow-x: hidden;
    }

</style>

<form action="{{ route('cartas.update', $carta->id) }}" method="POST" style="max-width: 600px; margin: 0 auto; padding: 20px;">
    @csrf
    @method('PUT')

    <input type="hidden" name="id_carta_api" value="{{ $carta->id_carta_api ?? '' }}">

    <h2 style="text-align: center; margin-bottom: 30px;">Editar Carta</h2>

    {{-- Rareza --}}
    <div style="margin-bottom: 15px;">
        <label for="rareza">Rareza</label>
        <select name="rareza" required 
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
            <option value="">Selecciona una opción</option>
            <option value="common"    {{ $carta->rareza == 'common'    ? 'selected' : '' }}>Común</option>
            <option value="uncommon"  {{ $carta->rareza == 'uncommon'  ? 'selected' : '' }}>Poco común</option>
            <option value="rare"      {{ $carta->rareza == 'rare'      ? 'selected' : '' }}>Rara</option>
            <option value="holo rare" {{ $carta->rareza == 'holo rare' ? 'selected' : '' }}>Holo rara</option>
            <option value="promo"     {{ $carta->rareza == 'promo'     ? 'selected' : '' }}>Promocional</option>
        </select>
    </div>

    {{-- Estado --}}
    <div style="margin-bottom: 15px;">
        <label for="estado">Estado</label>
        <select name="estado" required 
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
            <option value="">Selecciona el estado</option>
            <option value="nuevo"  {{ $carta->estado == 'nuevo'  ? 'selected' : '' }}>Nuevo</option>
            <option value="mint"   {{ $carta->estado == 'mint'   ? 'selected' : '' }}>Mint</option>
            <option value="bueno"  {{ $carta->estado == 'bueno'  ? 'selected' : '' }}>Bueno</option>
            <option value="usado"  {{ $carta->estado == 'usado'  ? 'selected' : '' }}>Usado</option>
            <option value="dañado" {{ $carta->estado == 'dañado' ? 'selected' : '' }}>Dañado</option>
        </select>
    </div>

    {{-- Precio --}}
    <div style="margin-bottom: 15px;">
        <label for="precio">Precio (€)</label>
        <input type="number" name="precio" value="{{ $carta->precio }}" step="0.01" required
               style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
    </div>

    {{-- Fecha de Adquisición --}}
    <div style="margin-bottom: 25px;">
        <label for="fecha_adquisicion">Fecha de Adquisición</label>
        <input type="date" name="fecha_adquisicion" value="{{ $carta->fecha_adquisicion }}" required
               style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
    </div>

    {{-- Botón Guardar --}}
    <div style="text-align: center;">
        <button type="submit"
                style="background-color: #28a745; color: white; padding: 10px 20px;
                       border: none; border-radius: 6px; font-size: 16px;">
            Guardar cambios
        </button>
    </div>
</form>
@endsection
