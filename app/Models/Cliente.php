<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'ciudad',
        'codigo_postal',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
        'fecha_registro' => 'datetime'
    ];

    // Relación con productos comprados
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'cliente_productos')
                    ->withPivot('cantidad', 'precio_unitario', 'precio_total', 'fecha_compra', 'estado_pedido')
                    ->withTimestamps();
    }

    // Relación directa con compras
    public function compras()
    {
        return $this->hasMany(ClienteProducto::class);
    }

    // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}
