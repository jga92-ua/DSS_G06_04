@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .profile-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 60px 20px;
    }

    .profile-box {
        background-color: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        width: 600px;
        max-width: 90%;
    }

    .profile-box h2 {
        text-align: center;
        background-color: #333;
        color: white;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 25px;
    }

    .profile-box label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
        color: #333;
    }

    .profile-box input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background-color: #e0e0e0;
        color: #333;
        box-sizing: border-box;
    }

    .profile-box input[readonly] {
        background-color: #dcdcdc;
        color: #555;
    }

    .btn-green {
        background-color: #2e7d32; /* verde oscuro */
        color: white;
        padding: 12px;
        width: 100%;
        margin-top: 20px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        transition: background-color 0.2s ease;
    }

    .btn-green:hover {
        background-color: #388e3c; /* verde más claro al pasar el ratón */
    }

    .btn-black {
        background-color: #333;
        color: white;
        padding: 12px;
        width: 100%;
        margin-top: 25px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
    }

    .btn-black:hover {
        background-color: #555;
    }

    .logout-form {
        margin-top: 20px;
        width: 600px;
        max-width: 90%;
    }
</style>

<div class="profile-container">
    <form class="profile-box" method="POST" action="{{ route('perfil.actualizar') }}" id="perfil-form">
        @csrf
        @method('PUT')

        <h2>Mi Perfil</h2>

        @if(session('success'))
            <div style="color: green; text-align: center;">{{ session('success') }}</div>
        @endif

        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" readonly>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" readonly>

        <label for="numTelf">Teléfono</label>
        <input type="tel" name="numTelf" id="numTelf" value="{{ Auth::user()->numTelf }}" readonly>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" value="{{ Auth::user()->direccion }}" readonly>

        <button type="button" class="btn-black" id="edit-btn">Editar</button>
        <button type="submit" class="btn-green" id="save-btn" style="display: none;">Guardar</button>   
    </form>

    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="btn-black">Cerrar sesión</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('perfil-form');
        const inputs = form.querySelectorAll('input');
        const editBtn = document.getElementById('edit-btn');
        const saveBtn = document.getElementById('save-btn');

        editBtn.addEventListener('click', () => {
            inputs.forEach(input => input.removeAttribute('readonly'));
            editBtn.style.display = 'none';
            saveBtn.style.display = 'block';
        });
    });
</script>
@endsection
