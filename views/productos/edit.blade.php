@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Editar Producto: {{ $producto->nombre }}</h1>
    
    {{-- Muestra mensajes de error de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   
    <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- Columna de Campos de Texto y Selección --}}
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                </div>

                <div class="mb-3">
                    <label for="codigo_barras" class="form-label">Código de Barras</label>
                    <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" value="{{ old('codigo_barras', $producto->codigo_barras) }}" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" value="{{ old('precio', $producto->precio) }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ old('stock', $producto->stock) }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="categoria_id" class="form-label">Categoría</label>
                        <select class="form-select" id="categoria_id" name="categoria_id" required>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" 
                                    {{ (old('categoria_id') == $categoria->id || $producto->categoria_id == $categoria->id) ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="hidden" name="activo" value="0"> 
                    <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1" {{ old('activo', $producto->activo) ? 'checked' : '' }}>
                    <label class="form-check-label" for="activo">Producto Activo</label>
                </div>
            </div>

            {{-- Columna de Imagen (Actual y Subida Nueva) --}}
            <div class="col-md-4">
                <div class="card p-3 mb-3">
                    <h5>Imagen Actual</h5>
                    @if ($producto->imagen)
                        <img src="{{ Storage::url($producto->imagen) }}" alt="Imagen actual de {{ $producto->nombre }}" 
                            class="img-fluid rounded mb-3" 
                            style="max-height: 250px; object-fit: contain;">
                    @else
                        <div class="alert alert-secondary text-center">Sin imagen actual</div>
                    @endif
                    
                    <label for="imagen" class="form-label">Subir Nueva Imagen (Opcional)</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                    <small class="text-muted">La nueva imagen reemplazará a la anterior.</small>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-warning mt-3">Actualizar Producto</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection