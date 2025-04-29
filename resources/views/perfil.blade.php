@extends('layoutH') {{-- O tu layout principal personalizado --}}

@section('title', 'Mi Perfil')

@section('content')
<style>
    .profile-container {
        max-width: 600px;
        margin: 40px auto;
        background-color: #f8f8f8;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .profile-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile-info {
        font-size: 16px;
        line-height: 1.8;
    }

    .profile-info strong {
        display: inline-block;
        width: 150px;
        color: #333;
    }

    .logout-button {
        display: block;
        width: 100%;
        margin-top: 30px;
        padding: 10px;
        background-color: #333;
        color: white;
        border: none;
        border-radius: 6px;
        text-align: center;
        text-decoration: none;
    }

    .logout-button:hover {
        background-color: #555;
    }
</style>

<div class="profile-container">
    <h2>Perfil de Usuario</h2>

    <div class="profile-info">
        <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Teléfono:</strong> {{ Auth::user()->numTelf }}</p>
        <p><strong>Dirección:</strong> {{ Auth::user()->direccion }}</p>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-button">Cerrar sesión</button>
    </form>
</div>
@endsection
