{{-- resources/views/compras/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Crear Compra')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Registrar Nueva Compra</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Asocia un producto con un cliente</p>
        </div>
        <div class="border-t border-gray-200">
            <form action="{{ route('compras.store') }}" method="POST" class="px-4 py-5 sm:p-6 space-y-6" id="compraForm">
                @csrf

                <div>
                    <label for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                    <select name="cliente_id" id="cliente_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <option value="">Selecciona un cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre_completo }} - {{ $cliente->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="producto_id" class="block text-sm font-medium text-gray-700">Producto</label>
                    <select name="producto_id" id="producto_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <option value="">Selecciona un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}" data-stock="{{ $producto->stock }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }} - ${{ number_format($producto->precio, 2) }} (Stock: {{ $producto->stock }})
                            </option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" min="1" value="{{ old('cantidad', 1) }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        @error('cantidad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500" id="stockInfo"></p>
                    </div>

                    <div>
                        <label for="precio_unitario" class="block text-sm font-medium text-gray-700">Precio Unitario</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="precio_unitario" id="precio_unitario" step="0.01" min="0" value="{{ old('precio_unitario') }}" required
                                   class="pl-7 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        </div>
                        @error('precio_unitario')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="estado_pedido" class="block text-sm font-medium text-gray-700">Estado del Pedido</label>
                    <select name="estado_pedido" id="estado_pedido" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <option value="pendiente" {{ old('estado_pedido', 'pendiente') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="procesando" {{ old('estado_pedido') == 'procesando' ? 'selected' : '' }}>Procesando</option>
                        <option value="enviado" {{ old('estado_pedido') == 'enviado' ? 'selected' : '' }}>Enviado</option>
                        <option value="entregado" {{ old('estado_pedido') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                        <option value="cancelado" {{ old('estado_pedido') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    @error('estado_pedido')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="notas" class="block text-sm font-medium text-gray-700">Notas (Opcional)</label>
                    <textarea name="notas" id="notas" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">{{ old('notas') }}</textarea>
                    @error('notas')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Resumen de la compra -->
                <div class="bg-gray-50 p-4 rounded-lg" id="resumenCompra" style="display: none;">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Resumen de la Compra</h4>
                    <div class="text-sm text-gray-600">
                        <p>Precio unitario: <span id="precioMostrar">$0.00</span></p>
                        <p>Cantidad: <span id="cantidadMostrar">0</span></p>
                        <p class="font-bold text-lg text-gray-900">Total: <span id="totalMostrar">$0.00</span></p>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('compras.index') }}"
                       class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Registrar Compra
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productoSelect = document.getElementById('producto_id');
    const cantidadInput = document.getElementById('cantidad');
    const precioInput = document.getElementById('precio_unitario');
    const stockInfo = document.getElementById('stockInfo');
    const resumenCompra = document.getElementById('resumenCompra');

    function actualizarPrecio() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        if (selectedOption.value) {
            const precio = selectedOption.dataset.precio;
            const stock = selectedOption.dataset.stock;
            precioInput.value = precio;
            stockInfo.textContent = `Stock disponible: ${stock} unidades`;
            cantidadInput.max = stock;
            actualizarResumen();
        } else {
            precioInput.value = '';
            stockInfo.textContent = '';
            resumenCompra.style.display = 'none';
        }
    }

    function actualizarResumen() {
        const precio = parseFloat(precioInput.value) || 0;
        const cantidad = parseInt(cantidadInput.value) || 0;
        const total = precio * cantidad;

        if (precio > 0 && cantidad > 0) {
            document.getElementById('precioMostrar').textContent = ' + precio.toFixed(2);
            document.getElementById('cantidadMostrar').textContent = cantidad;
            document.getElementById('totalMostrar').textContent = ' + total.toFixed(2);
            resumenCompra.style.display = 'block';
        } else {
            resumenCompra.style.display = 'none';
        }
    }

    productoSelect.addEventListener('change', actualizarPrecio);
    cantidadInput.addEventListener('input', actualizarResumen);
    precioInput.addEventListener('input', actualizarResumen);

    // Actualizar al cargar si hay valores previos
    if (productoSelect.value) {
        actualizarPrecio();
    }
});
</script>
@endsection
