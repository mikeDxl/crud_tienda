<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('precio_total', 10, 2);
            $table->timestamp('fecha_compra')->useCurrent();
            $table->enum('estado_pedido', ['pendiente', 'procesando', 'enviado', 'entregado', 'cancelado'])
                  ->default('pendiente');
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->index('cliente_id');
            $table->index('producto_id');
            $table->index('fecha_compra');
            $table->index('estado_pedido');
            $table->index(['cliente_id', 'fecha_compra']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente_productos');
    }
};
