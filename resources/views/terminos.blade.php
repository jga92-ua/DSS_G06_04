@extends('layouts.app')

@section('content')
<style>
    .terminos-wrapper {
        max-width: 1100px;
        margin: 40px auto;
        padding: 20px;
    }

    .section-bar {
        background-color: #606060;
        color: white;
        border-radius: 10px;
        text-align: left;
        padding: 10px 20px;
        font-size: 22px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: start;
        margin-bottom: 25px;
    }

    .terminos-container {
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', sans-serif;
        line-height: 1.8;
        font-size: 16px;
        padding: 40px;
    }

    .terminos-container h2 {
        font-size: 22px;
        color: #007bff;
        margin-top: 25px;
    }

    .terminos-container ul {
        padding-left: 20px;
    }

    .terminos-container li {
        margin-bottom: 10px;
    }

    .terminos-container a {
        color: #007bff;
        text-decoration: none;
    }

    .terminos-container a:hover {
        text-decoration: underline;
    }
</style>

<div class="terminos-wrapper">
    <div class="section-bar">Términos de Servicio</div>

    <div class="terminos-container">
        <h2>1. Aceptación de los Términos</h2>
        <p>Bienvenido a <strong>PokeMarketTCG</strong>. Al acceder y utilizar nuestra plataforma, aceptas cumplir con los siguientes términos y condiciones. Si no estás de acuerdo con alguna parte de estos términos, por favor no utilices nuestro servicio.</p>

        <h2>2. Descripción del Servicio</h2>
        <p>PokeMarketTCG es una plataforma en línea que permite a los usuarios comprar y vender cartas del juego de cartas coleccionables Pokémon (TCG).</p>

        <h2>3. Registro y Cuenta de Usuario</h2>
        <ul>
            <li>No compartir tus credenciales con terceros.</li>
            <li>Ser responsable de cualquier actividad realizada desde tu cuenta.</li>
            <li>Notificar de inmediato cualquier uso no autorizado de tu cuenta.</li>
        </ul>

        <h2>4. Compra y Venta de Cartas</h2>
        <ul>
            <li>Todos los listados deben describir con exactitud el estado y las características de la carta.</li>
            <li>El pago se procesa a través de los proveedores autorizados.</li>
            <li>No se permiten productos falsificados o que infrinjan derechos de autor.</li>
        </ul>

        <h2>5. Política de Pagos y Tarifas</h2>
        <p>Los pagos se realizarán a través de pasarelas seguras. PokeMarketTCG podrá aplicar comisiones por transacción, claramente informadas antes de confirmar la compra o venta.</p>

        <h2>6. Envío y Entrega</h2>
        <p>Los vendedores son responsables de realizar los envíos en un plazo razonable. Se recomienda utilizar servicios con seguimiento.</p>

        <h2>7. Devoluciones y Reembolsos</h2>
        <p>En caso de recibir un producto dañado o distinto al anunciado, el comprador podrá solicitar una devolución o reembolso dentro de los 7 días posteriores a la entrega.</p>

        <h2>8. Conducta del Usuario</h2>
        <ul>
            <li>Prohibido vender productos falsificados o ilegales.</li>
            <li>No se tolera el uso de lenguaje ofensivo o conductas acosadoras.</li>
            <li>Se perseguirá cualquier intento de fraude.</li>
        </ul>

        <h2>9. Suspensión y Terminación de Cuenta</h2>
        <p>PokeMarketTCG se reserva el derecho de suspender o eliminar cuentas que violen estos términos, sin previo aviso.</p>

        <h2>10. Modificaciones a los Términos</h2>
        <p>Nos reservamos el derecho de modificar estos términos en cualquier momento. Las actualizaciones se comunicarán vía web y serán efectivas desde su publicación.</p>

        <h2>11. Contacto</h2>
        <p>Para cualquier consulta, contáctanos en: <a href="mailto:soporte@pokemarkettcg.com">soporte@pokemarkettcg.com</a>.</p>
    </div>
</div>
@endsection
