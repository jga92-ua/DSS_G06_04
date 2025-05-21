@extends('layouts.app')

@section('head')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
<style>
    .cesta-container {
        max-width: 1200px;
        margin: 20px;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 8px;
    }

    .cesta-header,
    .cesta-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        margin-bottom: 10px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .cesta-header {
        font-weight: bold;
        background-color: #e0e0e0;
    }

    .cesta-col {
        width: 20%;
        text-align: center;
    }

    .cesta-info {
        width: 20%;
        text-align: left;
    }

    .cesta-info strong {
        display: block;
    }

    .cantidad-control {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .cantidad-control form {
        display: inline;
    }

    .cantidad-control button {
        padding: 4px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }

    .precio-final {
        text-align: center;
        margin-top: 40px;
    }

    .precio-final label {
        display: inline-block;
        margin-bottom: 15px;
    }

    html, body {
        overflow-x: hidden;
    }
</style>

@include('componentes.popup-pago')

<div class="cesta-container">
    <h2>Cesta de Compra</h2>

    <div class="cesta-header">
        <div class="cesta-info">Producto</div>
        <div class="cesta-col">Precio</div>
        <div class="cesta-col">Cantidad</div>
        <div class="cesta-col">Total</div>
        <div class="cesta-col">Acción</div>
    </div>

    @forelse ($cartasEnCesta as $item)
        <div class="cesta-item">
            <div class="cesta-info">
                <strong>{{ $item->carta->nombre_carta_api }}</strong>
                Código: {{ $item->carta->id_carta_api }}
            </div>
            <div class="cesta-col">{{ number_format($item->precio_unitario, 2) }} €</div>
            <div class="cesta-col cantidad-control">
                <form method="POST" action="{{ route('cesta.decrementar', $item->id) }}">
                    @csrf
                    <button type="submit">−</button>
                </form>
                {{ $item->cantidad }}
                <form method="POST" action="{{ route('cesta.incrementar', $item->id) }}">
                    @csrf
                    <button type="submit">+</button>
                </form>
            </div>
            <div class="cesta-col">{{ number_format($item->cantidad * $item->precio_unitario, 2) }} €</div>
            <div class="cesta-col">
                <form method="POST" action="{{ route('cesta.eliminar', $item->id) }}">
                    @csrf
                    <button type="submit">Eliminar</button>
                </form>
            </div>
        </div>
    @empty
        <p style="text-align: center;">No hay cartas en la cesta.</p>
    @endforelse

    @if (!$cartasEnCesta->isEmpty())
    <div class="precio-final text-center mt-4">
        <h3>PRECIO TOTAL (21% IVA): {{ number_format($precioTotal * 1.21, 2) }} EUROS</h3>

        <label>
            <input type="checkbox" id="terminosCheckbox" required>
            He leído y acepto los <a href="#">términos y condiciones</a>
        </label>
        <br>

        <button type="button" class="btn btn-success mt-2" onclick="abrirModalPago()">Finalizar Compra</button>
    </div>
    @endif
</div>

<!-- MODAL DE CONFIRMACIÓN FINAL -->
<div class="modal fade" id="confirmarPedidoModal" tabindex="-1" aria-labelledby="confirmarPedidoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content popup-content">
      <div class="modal-header">
        <h2 class="modal-title" id="confirmarPedidoLabel">Confirmar pedido</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p>¿Estás seguro de que deseas realizar la compra?</p>
        <form id="formPedidoConfirmado" action="{{ route('pedido.realizar') }}" method="POST">
          @csrf
          <input type="hidden" name="metodo_pago" value="Tarjeta">
          <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Sí, continuar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function abrirModalPago() {
    const checkbox = document.getElementById('terminosCheckbox');
    if (!checkbox.checked) {
      alert('Debes aceptar los términos y condiciones.');
      return;
    }
    const modal = new bootstrap.Modal(document.getElementById('popupPago'));
    modal.show();
  }

  function abrirConfirmacionDesdePago() {
    const modalPago = bootstrap.Modal.getInstance(document.getElementById('popupPago'));
    modalPago.hide();

    const modalConfirm = new bootstrap.Modal(document.getElementById('confirmarPedidoModal'));
    modalConfirm.show();
  }
</script>
@endsection
