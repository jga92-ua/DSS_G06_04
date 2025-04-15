<!DOCTYPE html>
<html lang="es"> 
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>PokeMarket TCG</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-image: url('{{ asset('imagenes/fondo.png') }}');
                background-size: cover;      
                background-repeat: no-repeat;
                background-position: center; 
                padding: 20px;
            }

            .container {
                max-width: 800px;
                margin: auto;
                background: white;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }

            h1 {
                text-align: center;
            }
        </style>
    </head>

    <body>
        @include('componentes.header')
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
