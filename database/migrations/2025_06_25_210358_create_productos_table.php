<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('categoria', 50)->nullable();
            $table->string('marca', 50)->nullable();
            $table->string('sku', 50)->unique()->nullable();
            $table->decimal('peso', 8, 2)->nullable();
            $table->string('dimensiones', 100)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index('nombre');
            $table->index('categoria');
            $table->index('sku');
            $table->index('precio');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
