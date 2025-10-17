<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        Categoria::create(['nombre' => 'Smartphones', 'descripcion' => 'Teléfonos inteligentes']);
        Categoria::create(['nombre' => 'Laptops', 'descripcion' => 'Portátiles y notebooks']);
        Categoria::create(['nombre' => 'Accesorios', 'descripcion' => 'Audífonos, mouse, cargadores']);
    }
}

