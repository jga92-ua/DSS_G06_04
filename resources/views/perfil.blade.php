@extends('layouts.app')

@section('content')

<div class="perfil-wrapper">
    <!-- FILA 1: Contraseña, Usuario, Foto -->
    <div class="perfil-row">
        <!-- Contraseña -->
        <form class="perfil-card perfil-25" method="POST" action="{{ route('perfil.password') }}">
            @csrf
            <h3>Contraseña</h3>
            <input type="password" name="actual" placeholder="Contraseña actual">
            <input type="password" name="nueva" placeholder="Nueva contraseña">
            <input type="password" name="nueva_confirmation" placeholder="Confirmar contraseña">
            <button type="submit">MODIFICAR</button>
        </form>

        <!-- Nombre de usuario -->
        <form class="perfil-card perfil-25" method="POST" action="{{ route('perfil.usuario') }}">
            @csrf
            <h3>Nombre usuario</h3>
            <input type="text" name="nuevo_usuario" placeholder="Nuevo nombre de usuario">
            <input type="password" name="password" placeholder="Contraseña">
            <button type="submit">MODIFICAR</button>
        </form>

        <!-- Foto de perfil -->
        <form class="perfil-card perfil-foto" method="POST" action="{{ route('perfil.foto') }}" enctype="multipart/form-data">
            @csrf
            <div class="foto-fila">
                <div class="imagen-container">
                    <img src="{{ Auth::user()->foto_perfil_url ?? asset('imagenes/usuario.png') }}" alt="Foto perfil">
                </div>
                <div class="botones-container">
                    <h3>Foto de perfil</h3>
                    <input type="file" name="foto" class="input-archivo">
                    <button type="submit">SUBIR ARCHIVO</button>
                </div>
            </div>
        </form>
    </div>

    <!-- FILA 2: Dirección, Información actual -->
    <div class="perfil-row">
        <!-- Dirección -->
        <form class="perfil-card direccion-form" method="POST" action="{{ route('perfil.direccion') }}">
            @csrf
            <h3>Dirección</h3>
            
            <div class="fila fila-1">
                <div class="campo campo-nombre">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre">
                </div>
                <div class="campo campo-calle">
                    <input type="text" id="calle" name="calle" placeholder="Calle">
                </div>
            </div>

            <div class="fila fila-2">
                <div class="campo">
                    <input type="text" id="numero" name="numero" placeholder="Número">
                </div>
                <div class="campo">
                    <input type="text" id="piso" name="piso" placeholder="Puerta/Piso">
                </div>
                <div class="campo">
                    <input type="text" id="cpp" name="cpp" placeholder="CPP">
                </div>
            </div>

            <div class="fila fila-3">
                <div class="campo">
                    <input type="text" id="localidad" name="localidad" placeholder="Localidad">
                </div>
                <div class="campo">
                    <input type="text" id="pais" name="pais" placeholder="País">
                </div>
            </div>

            <button type="submit">MODIFICAR</button>
        </form>

        <!-- Información dirección actual -->
        <div class="perfil-card">
            <h3>Información dirección actual</h3>
            <div class="info-direccion">
                {{ Auth::user()->direccion ?? 'No hay información' }}
            </div>
        </div>
    </div>
</div>

<style>
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .perfil-wrapper {
        max-width: 1800px;
        width: 100%;
        margin: 0 auto;
        padding: 2rem 2rem;
        display: flex;
        flex-direction: column;
        gap: 2rem;
        box-sizing: border-box;
    }

    .perfil-row {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: space-between;
        box-sizing: border-box;
    }

    .perfil-50 {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .perfil-25 {
        flex: 0 0 25%;
        max-width: 25%;
    }

    .perfil-card {
        background: transparent;
        padding: 1rem;
        flex: 1 1 calc(33.33% - 2rem);
        min-width: 320px;
        box-sizing: border-box;
    }

    .perfil-card h3 {
        width: 100%;
        background: #606060;
        color: white;
        padding: 0.5rem;
        border-radius: 5px;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .perfil-card input {
        width: 100%;
        margin-bottom: 0.7rem;
        padding: 0.5rem;
        border-radius: 4px;
        border: 1px solid #ccc;
        background: #929292;
        color: #C0C0C0;
        border-color: #606060;
        border-width: 2px;
        border-style: solid;
        border-radius: 3px;
    }

    .perfil-card button {
        background: #ebebeb;
        font-weight: bold;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 5px;
        cursor: pointer;
        align-items: center;
    }

    .perfil-foto {
        text-align: left;
    }

    .foto-fila {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .imagen-container img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        background: #EBEBEB;
    }

    .botones-container {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        flex: 1;
    }

    .direccion-form .fila {
        display: grid;
        gap: 2rem;
        margin-bottom: 0.5rem;
    }

    .fila-1 {
        grid-template-columns: 2fr 3fr;
    }

    .fila-2 {
        grid-template-columns: 1fr 1fr 1fr;
    }

    .fila-3 {
        grid-template-columns: 1fr 1fr;
    }

    .direccion-form .campo {
        display: flex;
        flex-direction: column;
    }
</style>

@endsection
