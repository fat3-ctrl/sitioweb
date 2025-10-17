<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Http\Requests\ProductoStoreRequest; 
use App\Http\Requests\ProductoUpdateRequest; 

class ProductoController extends Controller
{
    
    public function index(Request $request)
    {
        
        $query = Producto::with('categoria'); 

        
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('nombre', 'like', '%' . $searchTerm . '%')
                  ->orWhere('codigo_barras', 'like', '%' . $searchTerm . '%');
        }

        
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->input('categoria'));
        }

        if ($request->filled('stock_bajo')) {
            // Se considera stock bajo si es 5 o menos 
            $query->where('stock', '<=', 5); 
        }

        $productos = $query->paginate(10); 
        
        $categorias = Categoria::all(); 

        return view('productos.index', compact('productos', 'categorias'));
    }

    
    public function create()
    {
        $categorias = Categoria::all(); 
        return view('productos.create', compact('categorias'));
    }

    
    public function store(ProductoStoreRequest $request) 
    {
        $data = $request->validated();
        
         
        if ($request->hasFile('imagen')) {
            
            $path = $request->file('imagen')->store('images/productos', 'public');
            $data['imagen'] = $path;
        }

        Producto::create($data);
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

   
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all(); 
        return view('productos.edit', compact('producto', 'categorias'));
    }

    
    public function update(ProductoUpdateRequest $request, Producto $producto) 
    {
        $data = $request->validated();
        
        //Subida de Imágenes
        if ($request->hasFile('imagen')) {
            //Eliminar la imagen anterior si existe
            if ($producto->imagen) {
                \Storage::disk('public')->delete($producto->imagen);
            }
            
            // Guardar la nueva imagen
            $path = $request->file('imagen')->store('images/productos', 'public');
            $data['imagen'] = $path;
        }

        $producto->update($data);
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }
}