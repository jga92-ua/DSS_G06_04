@extends('layouts.app')

@section('content')

<style>
    .contacto-container {
        max-width: 1300px;
        margin: 40px auto;
        display: flex;
        gap: 40px;
        padding: 0 30px;
        justify-content: center;
    }

    .formulario-contacto,
    .info-contacto {
        flex: 1;
        background-color: #f0f0f0;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
    }

    .formulario-contacto h2,
    .info-contacto h2 {
        background-color: #505050;
        color: white;
        padding: 12px 18px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-size: 22px;
    }

    .formulario-contacto input,
    .formulario-contacto textarea {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        font-size: 16px;
        border: 1px solid #bbb;
        border-radius: 6px;
    }

    .formulario-contacto button {
        padding: 12px 25px;
        background-color: #007bff;
        border: none;
        color: white;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
    }

    .info-contacto div {
        background-color: #e0e0e0;
        padding: 12px;
        margin-bottom: 18px;
        border-radius: 6px;
        text-align: left;
        font-size: 15px;
        line-height: 1.4;
    }

    html, body {
        overflow-x: hidden;
    }

    @media (max-width: 768px) {
        .contacto-container {
            flex-direction: column;
            padding: 10px;
        }
    }
</style>


<div class="contacto-container">

    <!-- Formulario de contacto -->
    <div class="formulario-contacto">
        <h2>Página de Contacto</h2>
        <form>
            <input type="text" placeholder="Nombre y Apellidos" required>
            <input type="email" placeholder="Email de contacto" required>
            <textarea rows="5" placeholder="Mensaje" required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </div>

    <!-- Información de contacto -->
    <div class="info-contacto">
        <h2>Datos de Contacto - PokeTrade</h2>

        <div>
            <strong>Sede Central</strong><br>
            Av. de los Entrenadores 45, Madrid 28000<br>
            Email: poketrade625@gmail.com<br>
            Teléfono: 911 123 456
        </div>

        <div>
            <strong>Departamento de Soporte</strong><br>
            Email: soporte@poketrade.com<br>
            Teléfono: 912 987 654
        </div>

        <div>
            <strong>Departamento de Comunicación</strong><br>
            Email: comunicacion@poketrade.com<br>
            Teléfono: 913 456 789
        </div>

        <div>
            <strong>Departamento de Proyectos</strong><br>
            Email: proyectos@poketrade.com<br>
            Teléfono: 914 321 000
        </div>

        <div>
            <strong>Atención al Cliente</strong><br>
            Email: atencion@poketrade.com<br>
            Teléfono: 915 654 321
        </div>
    </div>

</div>
@endsection
