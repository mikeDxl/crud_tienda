<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteProducto extends Model
{
    use HasFactory;

    protected $table = 'cliente_productos';

    // IMPORTANTE: Deshabilitar timestamps automáticos
    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'precio_total',
        'fecha_compra',
        'estado_pedido',
        'notas'
    ];

    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'precio_total' => 'decimal:2',
        'fecha_compra' => 'datetime'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->precio_total = $model->cantidad * $model->precio_unitario;
        });
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('fecha_compra', 'desc');
    }

    public function scopeCurrentMonth($query)
    {
        return $query->whereMonth('fecha_compra', now()->month);
    }
}
