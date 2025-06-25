<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\ClienteProducto;
use Illuminate\Http\Request;


class ClienteProductoController extends Controller
{
    public function index()
    {
        $compras = ClienteProducto::with(['cliente', 'producto'])
                                 ->orderBy('fecha_compra', 'desc')
                                 ->paginate(15);
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $clientes = Cliente::where('activo', true)->orderBy('nombre')->get();
        $productos = Producto::where('activo', true)->where('stock', '>', 0)->orderBy('nombre')->get();

        return view('compras.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'estado_pedido' => 'required|in:pendiente,procesando,enviado,entregado,cancelado',
            'notas' => 'nullable|string',
        ]);

        // Verificar stock disponible
        $producto = Producto::find($request->producto_id);
        if ($producto->stock < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'No hay suficiente stock disponible.']);
        }

        // Crear la compra
        ClienteProducto::create($request->all());

        // Actualizar stock
        $producto->decrement('stock', $request->cantidad);

        return redirect()->route('compras.index')->with('success', 'Compra registrada exitosamente.');
    }

    public function show(ClienteProducto $compra)
    {
        $compra->load(['cliente', 'producto']);
        return view('compras.show', compact('compra'));
    }

    public function edit(ClienteProducto $compra)
    {
        $clientes = Cliente::where('activo', true)->orderBy('nombre')->get();
        $productos = Producto::where('activo', true)->orderBy('nombre')->get();

        return view('compras.edit', compact('compra', 'clientes', 'productos'));
    }

    public function update(Request $request, ClienteProducto $compra)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'estado_pedido' => 'required|in:pendiente,procesando,enviado,entregado,cancelado',
            'notas' => 'nullable|string',
        ]);

        $compra->update($request->all());

        return redirect()->route('compras.index')->with('success', 'Compra actualizada exitosamente.');
    }

    public function destroy(ClienteProducto $compra)
    {
        // Restaurar stock si es necesario
        if (in_array($compra->estado_pedido, ['pendiente', 'procesando'])) {
            $compra->producto->increment('stock', $compra->cantidad);
        }

        $compra->delete();
        return redirect()->route('compras.index')->with('success', 'Compra eliminada exitosamente.');
    }
}
