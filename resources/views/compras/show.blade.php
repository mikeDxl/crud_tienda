
{{-- resources/views/compras/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Ver Compra')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Compra #{{ $compra->id }}</h1>
            <p class="mt-1 text-sm text-gray-600">Información detallada de la compra</p>
        </div>
        <div class="space-x-2">
            <a href="{{ route('compras.edit', $compra) }}"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                Editar
            </a>
            <a href="{{ route('compras.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Volver
            </a>
        </div>
    </div>

    <!-- Información de la compra -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Detalles de la Compra</h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Cliente</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <div>{{ $compra->cliente->nombre_completo }}</div>
                        <div class="text-gray-500">{{ $compra->cliente->email }}</div>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Producto</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <div>{{ $compra->producto->nombre }}</div>
                        <div class="text-gray-500">{{ $compra->producto->categoria ?? 'Sin categoría' }}</div>
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Cantidad</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $compra->cantidad }} unidades</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Precio unitario</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">${{ number_format($compra->precio_unitario, 2) }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Total</dt>
                    <dd class="mt-1 text-lg font-bold text-green-600 sm:mt-0 sm:col-span-2">${{ number_format($compra->precio_total, 2) }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Estado del pedido</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($compra->estado_pedido == 'entregado') bg-green-100 text-green-800
                            @elseif($compra->estado_pedido == 'enviado') bg-blue-100 text-blue-800
                            @elseif($compra->estado_pedido == 'procesando') bg-yellow-100 text-yellow-800
                            @elseif($compra->estado_pedido == 'pendiente') bg-gray-100 text-gray-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($compra->estado_pedido) }}
                        </span>
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Fecha de compra</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $compra->fecha_compra->format('d/m/Y H:i') }}</dd>
                </div>
                @if($compra->notas)
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Notas</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $compra->notas }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>
</div>
@endsection
