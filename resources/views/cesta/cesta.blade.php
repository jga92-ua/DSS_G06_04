@extends('layouts.app')

@section('content')
@include('componentes.popup-pago')

<div class="cesta-container">
    <h2>Cesta de Compra</h2>

    <div class="cesta-header bg-light p-2 d-flex fw-bold border rounded">
        <div class="col-3">Producto</div>
        <div class="col-2 text-center">Precio</div>
        <div class="col-2 text-center">Cantidad</div>
        <div class="col-2 text-center">Total</div>
        <div class="col-3 text-center">Acción</div>
    </div>

    @forelse ($cartasEnCesta as $item)
        <div class="cesta-item d-flex align-items-center border rounded p-2 my-2 bg-white shadow-sm">
            <div class="col-3">
                <strong>{{ $item->carta->nombre_carta_api }}</strong><br>
                Código: {{ $item->carta->id_carta_api }}
            </div>
            <div class="col-2 text-center">{{ number_format($item->precio_unitario, 2) }} €</div>
            <div class="col-2 text-center d-flex justify-content-center align-items-center gap-2">
                <form method="POST" action="{{ route('cesta.decrementar', $item->id) }}">@csrf
                    <button class="btn btn-sm btn-outline-primary" type="submit">−</button>
                </form>
                {{ $item->cantidad }}
                <form method="POST" action="{{ route('cesta.incrementar', $item->id) }}">@csrf
                    <button class="btn btn-sm btn-outline-primary" type="submit">+</button>
                </form>
            </div>
            <div class="col-2 text-center">{{ number_format($item->cantidad * $item->precio_unitario, 2) }} €</div>
            <div class="col-3 text-center">
                <form method="POST" action="{{ route('cesta.eliminar', $item->id) }}">@csrf
                    <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-center mt-4">No hay cartas en la cesta.</p>
    @endforelse

    @if (!$cartasEnCesta->isEmpty())
        <div class="text-center mt-4">
            <h4>PRECIO TOTAL (21% IVA): {{ number_format($precioTotal * 1.21, 2) }} EUROS</h4>

            <div class="form-check d-flex justify-content-center align-items-center gap-2 my-3">
                <input type="checkbox" class="form-check-input" id="terminos" style="transform: scale(1.3); margin-top: 2px;">
                <label class="form-check-label" for="terminos" style="font-size: 1rem;">
                    He leído y acepto los <a href="#" target="_blank">términos y condiciones</a> de venta de PokeMarket TCG
                </label>
            </div>


            <button class="btn btn-success finalizar-btn" onclick="abrirPopup()">Finalizar Compra</button>

            <form action="{{ route('cesta.vaciar') }}" method="POST" class="d-inline-block ms-3">@csrf
                <button type="submit" class="btn btn-danger">Vaciar Cesta</button>
            </form>
        </div>
    @endif
</div>

<script>
function abrirPopup() {
    if (!document.getElementById('terminos').checked) {
        alert("Debes aceptar los términos y condiciones antes de continuar.");
        return;
    }
    let modal = new bootstrap.Modal(document.getElementById('popupPago'));
    modal.show();
}
</script>
@endsection
