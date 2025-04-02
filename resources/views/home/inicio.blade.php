@extends('layouts.app')

@section('content')

<!-- Barra de navegación -->
<nav style="display: flex; align-items: center; justify-content: space-between; background-color: #ddd; padding: 10px;">
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

<!-- Aquí va el resto del contenido -->
<div class="container">
    <h1>Bienvenido a PokeMarket TCG</h1>
</div>

@endsection
