<div id="popup-pago" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="background: white; width: 500px; margin: 100px auto; padding: 20px; border-radius: 10px; position: relative;">
        <h2 style="text-align: center;">Método de Pago</h2>

        <form method="POST" action="{{ route('cesta.procesarPago') }}">
            @csrf
            <label for="numero">Número de Tarjeta</label>
            <input type="text" name="numero" required class="form-control mb-2">

            <label for="caducidad">Fecha de Caducidad</label>
            <input type="text" name="caducidad" required class="form-control mb-2">

            <label for="cvv">CVV</label>
            <input type="text" name="cvv" required class="form-control mb-3">

            <p>Se enviará confirmación a tu correo.</p>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <button type="button" onclick="document.getElementById('popup-pago').style.display='none';">Cancelar</button>
                <button type="submit">Pagar</button>
            </div>
        </form>
    </div>
</div>