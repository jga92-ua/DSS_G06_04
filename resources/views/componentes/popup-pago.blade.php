<div class="modal fade" id="popupPago" tabindex="-1" aria-labelledby="popupPagoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('cesta.procesarPago') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="popupPagoLabel">Método de Pago</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 text-center">
            <img src="https://img.icons8.com/color/48/visa.png" width="50">
            <img src="https://img.icons8.com/color/48/mastercard.png" width="50">
            <img src="https://img.icons8.com/color/48/amex.png" width="50">
          </div>

          <div class="mb-3">
            <label class="form-label">Número de Tarjeta</label>
            <input type="text" class="form-control" name="tarjeta" required>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Fecha de Caducidad</label>
              <input type="text" class="form-control" name="caducidad" placeholder="MM/AA" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">CVV</label>
              <input type="text" class="form-control" name="cvv" required>
            </div>
          </div>

          <div class="alert alert-info text-center">
            Se enviará confirmación a tu correo.
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Pagar</button>
        </div>
      </div>
    </form>
  </div>
</div>
