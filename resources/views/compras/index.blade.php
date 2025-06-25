{{-- resources/views/compras/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Compras')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Compras</h1>
            <p class="mt-1 text-sm text-gray-600">Gestiona las compras y pedidos de clientes</p>
        </div>
        <a href="{{ route('compras.create') }}"
           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
            </svg>
            Nueva Compra
        </a>
    </div>

    <!-- Lista de compras -->
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Unit.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($compras as $compra)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-full bg-purple-500 flex items-center justify-center">
                                        <span class="text-xs font-medium text-white">
                                            {{ strtoupper(substr($compra->cliente->nombre, 0, 1) . substr($compra->cliente->apellido, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $compra->cliente->nombre_completo }}</div>
                                    <div class="text-sm text-gray-500">{{ $compra->cliente->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $compra->producto->nombre }}</div>
                            <div class="text-sm text-gray-500">{{ $compra->producto->categoria }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $compra->cantidad }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($compra->precio_unitario, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${{ number_format($compra->precio_total, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($compra->estado_pedido == 'entregado') bg-green-100 text-green-800
                                @elseif($compra->estado_pedido == 'enviado') bg-blue-100 text-blue-800
                                @elseif($compra->estado_pedido == 'procesando') bg-yellow-100 text-yellow-800
                                @elseif($compra->estado_pedido == 'pendiente') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($compra->estado_pedido) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $compra->fecha_compra->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('compras.show', $compra) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                            <a href="{{ route('compras.edit', $compra) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                            <form action="{{ route('compras.destroy', $compra) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="confirmDelete(event)" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            No hay compras registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginación -->
    @if($compras->hasPages())
    <div class="px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
        {{ $compras->links() }}
    </div>
    @endif
</div>
@endsection







