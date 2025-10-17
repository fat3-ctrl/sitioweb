<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; 
class CategoriaController extends Controller
{
    // Categorías
    public function index()
    {
        $categorias = Categoria::paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    // formulario
    public function create()
    {
        return view('categorias.create');
    }

    // CREATE: Almacena la categoría
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:categorias,nombre',
            'descripcion' => 'nullable',
        ]);

        Categoria::create($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoría creada.');
    }

    // UPDATE: Muestra el formulario de edición
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }


    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
           
            'nombre' => 'required|max:100|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'nullable',
        ]);

        $categoria->update($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada.');
    }

    // Elimina la categoría
    public function destroy(Categoria $categoria)
    {
        
        try {
            $categoria->delete();
            return redirect()->route('categorias.index')->with('success', 'Categoría eliminada.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('categorias.index')->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }
    }
}