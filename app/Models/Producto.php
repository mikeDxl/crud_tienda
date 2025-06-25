<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria',
        'marca',
        'sku',
        'peso',
        'dimensiones',
        'activo'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'peso' => 'decimal:2',
        'activo' => 'boolean',
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime'
    ];

    // Relación con clientes que compraron este producto
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_productos')
                    ->withPivot('cantidad', 'precio_unitario', 'precio_total', 'fecha_compra', 'estado_pedido')
                    ->withTimestamps();
    }

    // Relación directa con compras
    public function compras()
    {
        return $this->hasMany(ClienteProducto::class);
    }
}
