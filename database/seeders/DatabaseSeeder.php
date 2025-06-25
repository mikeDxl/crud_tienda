<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear clientes de ejemplo
        $clientes = [
            [
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'email' => 'juan.perez@email.com',
                'telefono' => '555-0101',
                'direccion' => 'Calle Principal 123',
                'ciudad' => 'México DF',
                'codigo_postal' => '01000'
            ],
            [
                'nombre' => 'María',
                'apellido' => 'González',
                'email' => 'maria.gonzalez@email.com',
                'telefono' => '555-0102',
                'direccion' => 'Avenida Central 456',
                'ciudad' => 'Guadalajara',
                'codigo_postal' => '44100'
            ],
            [
                'nombre' => 'Carlos',
                'apellido' => 'Rodríguez',
                'email' => 'carlos.rodriguez@email.com',
                'telefono' => '555-0103',
                'direccion' => 'Boulevard Norte 789',
                'ciudad' => 'Monterrey',
                'codigo_postal' => '64000'
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'López',
                'email' => 'ana.lopez@email.com',
                'telefono' => '555-0104',
                'direccion' => 'Calle Sur 321',
                'ciudad' => 'Puebla',
                'codigo_postal' => '72000'
            ],
            [
                'nombre' => 'Luis',
                'apellido' => 'Martínez',
                'email' => 'luis.martinez@email.com',
                'telefono' => '555-0105',
                'direccion' => 'Avenida Este 654',
                'ciudad' => 'Tijuana',
                'codigo_postal' => '22000'
            ]
        ];

        foreach ($clientes as $clienteData) {
            Cliente::create($clienteData);
        }

        // Crear productos de ejemplo
        $productos = [
            [
                'nombre' => 'Laptop HP Pavilion',
                'descripcion' => 'Laptop para uso profesional con 8GB RAM y 512GB SSD',
                'precio' => 15999.99,
                'stock' => 25,
                'categoria' => 'Electrónicos',
                'marca' => 'HP',
                'sku' => 'HP-PAV-001',
                'peso' => 2.1
            ],
            [
                'nombre' => 'Mouse Logitech MX Master',
                'descripcion' => 'Mouse inalámbrico ergonómico para productividad',
                'precio' => 1299.99,
                'stock' => 50,
                'categoria' => 'Accesorios',
                'marca' => 'Logitech',
                'sku' => 'LOG-MX-002',
                'peso' => 0.14
            ],
            [
                'nombre' => 'Teclado Mecánico Corsair',
                'descripcion' => 'Teclado mecánico gaming con switches Cherry MX',
                'precio' => 2199.99,
                'stock' => 30,
                'categoria' => 'Accesorios',
                'marca' => 'Corsair',
                'sku' => 'COR-K70-003',
                'peso' => 1.2
            ],
            [
                'nombre' => 'Monitor Samsung 24"',
                'descripcion' => 'Monitor Full HD de 24 pulgadas para oficina',
                'precio' => 3999.99,
                'stock' => 15,
                'categoria' => 'Electrónicos',
                'marca' => 'Samsung',
                'sku' => 'SAM-MON-004',
                'peso' => 4.5
            ],
            [
                'nombre' => 'Audífonos Sony WH-1000XM4',
                'descripcion' => 'Audífonos inalámbricos con cancelación de ruido',
                'precio' => 5999.99,
                'stock' => 20,
                'categoria' => 'Audio',
                'marca' => 'Sony',
                'sku' => 'SON-WH-005',
                'peso' => 0.25
            ],
            [
                'nombre' => 'Impresora Canon PIXMA',
                'descripcion' => 'Impresora multifuncional para hogar y oficina',
                'precio' => 2799.99,
                'stock' => 12,
                'categoria' => 'Oficina',
                'marca' => 'Canon',
                'sku' => 'CAN-PIX-006',
                'peso' => 6.2
            ],
            [
                'nombre' => 'Disco Duro Externo 1TB',
                'descripcion' => 'Almacenamiento portátil USB 3.0',
                'precio' => 1899.99,
                'stock' => 40,
                'categoria' => 'Almacenamiento',
                'marca' => 'Seagate',
                'sku' => 'SEA-EXT-007',
                'peso' => 0.23
            ],
            [
                'nombre' => 'Webcam Logitech C920',
                'descripcion' => 'Cámara web HD para videoconferencias',
                'precio' => 1599.99,
                'stock' => 35,
                'categoria' => 'Accesorios',
                'marca' => 'Logitech',
                'sku' => 'LOG-C920-008',
                'peso' => 0.16
            ]
        ];

        foreach ($productos as $productoData) {
            Producto::create($productoData);
        }

        // Crear algunas compras de ejemplo
        $compras = [
            [
                'cliente_id' => 1,
                'producto_id' => 1,
                'cantidad' => 1,
                'precio_unitario' => 15999.99,
                'estado_pedido' => 'entregado'
            ],
            [
                'cliente_id' => 1,
                'producto_id' => 2,
                'cantidad' => 2,
                'precio_unitario' => 1299.99,
                'estado_pedido' => 'entregado'
            ],
            [
                'cliente_id' => 2,
                'producto_id' => 3,
                'cantidad' => 1,
                'precio_unitario' => 2199.99,
                'estado_pedido' => 'enviado'
            ],
            [
                'cliente_id' => 2,
                'producto_id' => 4,
                'cantidad' => 1,
                'precio_unitario' => 3999.99,
                'estado_pedido' => 'procesando'
            ],
            [
                'cliente_id' => 3,
                'producto_id' => 5,
                'cantidad' => 1,
                'precio_unitario' => 5999.99,
                'estado_pedido' => 'entregado'
            ],
            [
                'cliente_id' => 3,
                'producto_id' => 6,
                'cantidad' => 1,
                'precio_unitario' => 2799.99,
                'estado_pedido' => 'entregado'
            ],
            [
                'cliente_id' => 4,
                'producto_id' => 7,
                'cantidad' => 2,
                'precio_unitario' => 1899.99,
                'estado_pedido' => 'pendiente'
            ],
            [
                'cliente_id' => 4,
                'producto_id' => 8,
                'cantidad' => 1,
                'precio_unitario' => 1599.99,
                'estado_pedido' => 'enviado'
            ],
            [
                'cliente_id' => 5,
                'producto_id' => 1,
                'cantidad' => 1,
                'precio_unitario' => 15999.99,
                'estado_pedido' => 'procesando'
            ],
            [
                'cliente_id' => 5,
                'producto_id' => 2,
                'cantidad' => 1,
                'precio_unitario' => 1299.99,
                'estado_pedido' => 'entregado'
            ]
        ];

        foreach ($compras as $compraData) {
            ClienteProducto::create($compraData);
        }
    }
}
