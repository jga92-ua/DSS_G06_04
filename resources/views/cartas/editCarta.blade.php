<form action="{{ route('cartas.update', $carta->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Método PUT para la actualización -->
    
    <input type="hidden" name="id_carta_api" value="{{ $carta->id_carta_api ?? '' }}">
<!-- Barra superior fija con botones -->
<div style="position: fixed; top: 0; left: 0; width: 100%; background: #f9f9f9; padding: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); z-index: 999;">
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <a href="{{ route('inicio') }}" style="background-color: #007bff; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Inicio</a>
        <a href="{{ url('/cartas/buscar') }}" style="background-color: #17a2b8; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Buscar carta</a>
        <a href="{{ route('cartas.mis') }}" style="background-color: #6f42c1; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Mis cartas</a>
    </div>
</div>

<!-- Espacio para evitar que el contenido quede oculto por la barra -->
<div style="height: 65px;"></div>

    {{-- Rareza --}}
    <div style="margin-bottom: 15px;">
        <label for="rareza">Rareza</label>
        <select name="rareza" required 
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
            <option value="">Selecciona una opción</option>
            <option value="common" {{ $carta->rareza == 'common' ? 'selected' : '' }}>Común</option>
            <option value="uncommon" {{ $carta->rareza == 'uncommon' ? 'selected' : '' }}>Poco común</option>
            <option value="rare" {{ $carta->rareza == 'rare' ? 'selected' : '' }}>Rara</option>
            <option value="holo rare" {{ $carta->rareza == 'holo rare' ? 'selected' : '' }}>Holo rara</option>
            <option value="promo" {{ $carta->rareza == 'promo' ? 'selected' : '' }}>Promocional</option>
        </select>
    </div>

    {{-- Estado --}}
    <div style="margin-bottom: 15px;">
        <label for="estado">Estado</label>
        <select name="estado" required 
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
            <option value="">Selecciona el estado</option>
            <option value="nuevo" {{ $carta->estado == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
            <option value="mint" {{ $carta->estado == 'mint' ? 'selected' : '' }}>Mint</option>
            <option value="bueno" {{ $carta->estado == 'bueno' ? 'selected' : '' }}>Bueno</option>
            <option value="usado" {{ $carta->estado == 'usado' ? 'selected' : '' }}>Usado</option>
            <option value="dañado" {{ $carta->estado == 'dañado' ? 'selected' : '' }}>Dañado</option>
        </select>
    </div>

    {{-- Precio --}}
    <label for="precio">Precio:</label>
    <input type="number" name="precio" value="{{ $carta->precio }}" step="0.01" required>

    {{-- Fecha de Adquisición --}}
    <label for="fecha_adquisicion">Fecha de Adquisición:</label>
    <input type="date" name="fecha_adquisicion" value="{{ $carta->fecha_adquisicion }}" required>

    <button type="submit">Guardar cambios</button>
</form>
