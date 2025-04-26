@extends('layouts.app')

@section('content')

<style>
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
        text-align: center;
    }

    .trending-bar {
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
        display: flex;
        overflow-x: auto;
        gap: 15px;
        padding: 10px;
        scroll-behavior: smooth;
    }

    .card {
        width: 150px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .cards-container::-webkit-scrollbar {
        display: none;
    }

    .content-section {
        display: flex;
        margin-top: 20px;
        gap: 15px;
    }

    .left-section {
        width: 66%;
        background-color: #ddd;
        padding: 10px;
        text-align: center;
        border-radius: 8px;
    }

    .right-section {
        width: 33%;
        background-color: #ddd;
        padding: 10px;
        text-align: center;
        border-radius: 8px;
    }

    .left-cards {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .right-images {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }

    .right-images img {
        width: 100%;
        max-width: 200px;
        border-radius: 8px;
    }
</style>
<!-- Barra superior fija con botones -->

<!-- Espacio para evitar que el contenido quede oculto por la barra -->
<div style="height: 65px;"></div>

<div class="trending-bar">🔥 Trending!</div>
<div class="cards-container">
    @foreach($cartasTrending as $carta)
        <div>
            <img src="{{ $carta['imagen'] }}" alt="Carta Pokémon" class="card">
        </div>
    @endforeach
</div>

<div class="content-section">
    <div class="left-section">
        <h3>Catálogo</h3>
        <div class="left-cards">
            @foreach($cartasCatalogo as $carta)
                <img src="{{ $carta['imagen'] }}" alt="Carta Pokémon" class="card">
            @endforeach
        </div>
    </div>
    
    <div class="right-section">
        <h3>Expansiones</h3>
        <div class="right-images">
            <img src="{{ asset('imagenes/chispas.png') }}" alt="Chispas Fulgurantes">
            <img src="{{ asset('imagenes/prismatic.png') }}" alt="Evoluciones Prismáticas">
        </div>
    </div>
</div>

@endsection
