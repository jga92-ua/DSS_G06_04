<!-- Modal Bootstrap Pago -->
<div class="modal fade" id="popupPago" tabindex="-1" aria-labelledby="popupPagoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="popupPagoLabel">Método de Pago</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <div class="text-center mb-3">
          <img src="https://img.icons8.com/color/48/visa.png" width="50">
          <img src="https://img.icons8.com/color/48/mastercard.png" width="50">
          <img src="https://img.icons8.com/color/48/amex.png" width="50">
        </div>

        <div class="mb-3">
          <label class="form-label">Número de Tarjeta</label>
          <input type="text" class="form-control" name="numero" placeholder="1234 5678 9012 3456" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Fecha de Caducidad</label>
            <input type="text" class="form-control" name="caducidad" placeholder="MM/AA" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">CVV</label>
            <input type="text" class="form-control" name="cvv" placeholder="123" required>
          </div>
        </div>

        <div class="alert alert-info text-center">
          Se enviará confirmación a tu correo.
        </div>
      </div>

      <div class="modal-footer d-flex justify-content-between">
        <!-- Botón de prueba: insertar pedido -->
        <form method="POST" action="{{ route('pedido.realizar') }}">
          @csrf
          <input type="hidden" name="metodo_pago" value="Tarjeta">
          <button type="submit" class="btn btn-success">[TEST] Insertar Pedido</button>
        </form>

        <div>
          <!-- Botón original -->
          <form method="POST" action="{{ route('cesta.procesarPago') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-primary">Finalizar Compra</button>
          </form>

          <!-- Cancelar -->
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>

    </div>
  </div>
</div>
