<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        Producto::create([
            'nombre' => 'iPhone 15 Pro',
            'descripcion' => 'Último modelo de Apple',
            'precio' => 3500.00,
            'stock' => 10,
            'categoria_id' => 1,
            'codigo_barras' => '111111111111',
            'activo' => true
        ]);

        Producto::create([
            'nombre' => 'Samsung Galaxy S24',
            'descripcion' => 'Smartphone Android',
            'precio' => 3200.00,
            'stock' => 15,
            'categoria_id' => 1,
            'codigo_barras' => '222222222222',
            'activo' => true
        ]);

        Producto::create([
            'nombre' => 'MacBook Air M2',
            'descripcion' => 'Laptop Apple ultraligera',
            'precio' => 5000.00,
            'stock' => 5,
            'categoria_id' => 2,
            'codigo_barras' => '333333333333',
            'activo' => true
        ]);

        Producto::create([
            'nombre' => 'Dell XPS 13',
            'descripcion' => 'Laptop Windows de alto rendimiento',
            'precio' => 4500.00,
            'stock' => 8,
            'categoria_id' => 2,
            'codigo_barras' => '444444444444',
            'activo' => true
        ]);

        Producto::create([
            'nombre' => 'AirPods Pro',
            'descripcion' => 'Audífonos inalámbricos',
            'precio' => 700.00,
            'stock' => 20,
            'categoria_id' => 3,
            'codigo_barras' => '555555555555',
            'activo' => true
        ]);

        Producto::create([
            'nombre' => 'Logitech MX Master 3',
            'descripcion' => 'Mouse inalámbrico profesional',
            'precio' => 150.00,
            'stock' => 12,
            'categoria_id' => 3,
            'codigo_barras' => '666666666666',
            'activo' => true
        ]);

        Producto::create([
            'nombre' => 'Cargador USB-C',
            'descripcion' => 'Cargador rápido para dispositivos',
            'precio' => 50.00,
            'stock' => 25,
            'categoria_id' => 3,
            'codigo_barras' => '777777777777',
            'activo' => true
        ]);

        Producto::create([
            'nombre' => 'iPad Pro',
            'descripcion' => 'Tablet de Apple',
            'precio' => 2800.00,
            'stock' => 7,
            'categoria_id' => 1,
            'codigo_barras' => '888888888888',
            'activo' => true
        ]);
    }
}
