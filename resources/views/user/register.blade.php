@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Ocupa toda la pantalla */
    }

    .register-box {
        background-color: rgba(240, 240, 240, 0.95);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        width: 400px;
        max-width: 90%;
    }

    .register-box h2 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
        background-color: #333;
        color: white;
        padding: 10px;
        border-radius: 6px;
    }

    .form-row {
        display: flex;
        gap: 10px;
    }

    .form-row input {
        flex: 1;
    }

    .register-box input[type="text"],
    .register-box input[type="email"],
    .register-box input[type="password"],
    .register-box input[type="tel"] {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #e0e0e0;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        font-size: 12px;
        margin: 10px 0;
        flex-wrap: wrap;
    }

    .checkbox-label input {
        margin-right: 8px;
        transform: scale(1.1);
    }

    .checkbox-label a {
        margin: 0 3px;
    }

    .btn-black {
        background-color: #333;
        color: white;
        padding: 10px;
        width: 100%;
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
    }

    .btn-grey {
        background-color: #ddd;
        color: black;
        padding: 10px;
        width: 100%;
        border: none;
        border-radius: 5px;
    }
</style>

<div class="register-container">
    <form class="register-box" method="POST" action="{{ route('register.post') }}">
        @csrf
        <h2>¡Bienvenido a PokeMarketTCG!</h2>

        <div class="form-row">
            <input type="text" name="username" placeholder="Nombre de Usuario *" required>
            <input type="password" name="password" placeholder="Contraseña *" required>
        </div>

        <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña *" required>
        <input type="email" name="email" placeholder="Email *" required>
        <input type="text" name="address" placeholder="Dirección *" required>
        <input type="tel" name="phone" placeholder="Número de Teléfono *" required>

        <label class="checkbox-label">
            <input type="checkbox" required>
            Acepto los <a href="{{ route('terminos') }}" target="_blank">Términos de Servicio</a> y la <a href="{{ route('privacidad') }}" target="_blank">Política de Privacidad</a>
        </label>


        <button type="submit" class="btn-black">Añadir Usuario</button>
        <button type="button" class="btn-grey">Cancelar</button>
    </form>
</div>
@endsection
