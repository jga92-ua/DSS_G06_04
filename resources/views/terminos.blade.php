@extends('layouts.app')

@section('content')
<style>
<<<<<<< HEAD
    html, body {
        overflow-x: hidden;
    }
</style>
<div style="
    max-height: 80vh;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 40px;
    max-width: 800px;
    margin: 40px auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
">
    <h1 class="text-center mb-4">Términos de Servicio</h1>

    <p><strong>1. Aceptación de los Términos</strong></p>
    <p>Bienvenido a PokeMarketTCG. Al acceder y utilizar nuestra plataforma, aceptas cumplir con los siguientes términos y condiciones. Si no estás de acuerdo con alguna parte de estos términos, no utilices nuestro servicio.</p>

    <p><strong>2. Descripción del Servicio</strong></p>
    <p>PokeMarketTCG es una plataforma en línea que permite a los usuarios comprar y vender cartas de Pokémon Trading Card Game (TCG). Ofrecemos herramientas para publicar cartas, gestionar transacciones y comunicarse entre usuarios.</p>
=======
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
>>>>>>> 2f056cbd5f4bbb422f1078cc6307e6a265c74ba6

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

<<<<<<< HEAD
    <p><strong>5. Política de Pagos y Tarifas</strong></p>
    <p>Al usar PokeMarketTCG, aceptas las tarifas aplicables que se indican al momento de publicar o completar una transacción. Estas tarifas pueden incluir comisiones por venta, cargos por procesamiento de pago y otros costes operativos. Nos reservamos el derecho de cambiar estas tarifas en cualquier momento con previo aviso.</p>

    <p><strong>6. Envío y Entrega</strong></p>
    <p>Los vendedores son responsables de asegurar que las cartas se envíen en condiciones adecuadas, protegidas y dentro del plazo estipulado. Se recomienda usar servicios de envío con seguimiento. PokeMarketTCG no se hace responsable por pérdidas o daños durante el envío, pero podrá intervenir en caso de disputas.</p>

    <p><strong>7. Devoluciones y Reembolsos</strong></p>
    <p>Las devoluciones están sujetas a las políticas individuales del vendedor, las cuales deben estar claramente especificadas en cada publicación. En caso de que el producto recibido no coincida con la descripción, el comprador podrá solicitar un reembolso dentro de los 7 días posteriores a la entrega. PokeMarketTCG evaluará la situación y podrá mediar si es necesario.</p>
=======
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
>>>>>>> 2f056cbd5f4bbb422f1078cc6307e6a265c74ba6

    .terminos-container a:hover {
        text-decoration: underline;
    }
</style>

<div class="terminos-wrapper">
    <div class="section-bar">Términos de Servicio</div>

<<<<<<< HEAD
    <p><strong>10. Modificaciones a los Términos</strong></p>
    <p>Nos reservamos el derecho de modificar estos términos en cualquier momento. Se notificará a los usuarios mediante correo electrónico o a través del sitio web.</p>
=======
    <div class="terminos-container">
        <h2>1. Aceptación de los Términos</h2>
        <p>Bienvenido a <strong>PokeMarketTCG</strong>. Al acceder y utilizar nuestra plataforma, aceptas cumplir con los siguientes términos y condiciones. Si no estás de acuerdo con alguna parte de estos términos, por favor no utilices nuestro servicio.</p>
>>>>>>> 2f056cbd5f4bbb422f1078cc6307e6a265c74ba6

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
