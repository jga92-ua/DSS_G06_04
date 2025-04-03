@extends('layouts.app')

@section('content')

<style>
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
        text-align: center;
    }

    .top-bar {
        background-color: #ddd;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }

    .section-bar {
        background-color: #ddd;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: start;
        margin-top: 10px;
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        padding: 20px;
        justify-content: center;
    }

    .card img {
        width: 100%;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .search-form {
        margin: 20px auto;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .search-form input {
        padding: 8px;
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .search-form button {
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<nav class="top-bar">
    <div style="display: flex; align-items: center;">
        <button style="background: none; border: none; font-size: 24px; cursor: pointer;">☰</button>
        <h2 style="margin-left: 10px;">PokeMarket TCG</h2>
        <img src="{{ asset('imagenes/logo.png') }}" alt="Logo" style="width: 30px; margin-left: 5px;">
    </div>
    <div style="display: flex; align-items: center;">
        <span style="margin-right: 10px;">🔔<sup>2</sup></span>
        <div style="text-align: right;">
            <strong>Renee McKelvey</strong>
            <br>
            <span style="font-size: 12px; color: gray;">Product Manager</span>
        </div>
        <img src="{{ asset('imagenes/usuario.png') }}" alt="Usuario" style="width: 30px; margin-left: 10px;">
    </div>
</nav>

<div class="section-bar">Catálogo</div>

<!-- Formulario de búsqueda -->
<form method="GET" action="{{ route('catalogo') }}" class="search-form">
    <input type="text" name="nombre" placeholder="Buscar cartas por nombre" value="{{ request('nombre') }}">
    <button type="submit">Buscar</button>
</form>

@if($cartas->isEmpty())
    <p style="text-align: center; margin-top: 20px;">No se encontraron cartas.</p>
@else
    <div class="cards-container">
        @foreach($cartas as $carta)
            <div class="card">
                <img src="{{ $carta['imagen'] }}" alt="Carta Pokémon">
            </div>
        @endforeach
    </div>
@endif

@endsection
