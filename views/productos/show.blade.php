@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Detalles del Producto: {{ $producto->nombre }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            
                            @if ($producto->imagen)
                                <img src="{{ Storage::url($producto->imagen) }}" alt="{{ $producto->nombre }}" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="max-height: 250px; object-fit: contain;">
                            @else
                                <div class="p-5 border rounded bg-light">Sin Imagen</div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <p><strong>ID:</strong> {{ $producto->id }}</p>
                            <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                            <p><strong>Código de Barras:</strong> {{ $producto->codigo_barras }}</p>
                            <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin Categoría' }}</p>
                            <p><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                            <p><strong>Stock:</strong> 
                                <span class="badge {{ $producto->stock <= 5 ? 'bg-danger' : 'bg-success' }}">{{ $producto->stock }}</span>
                            </p>
                            <p><strong>Descripción:</strong> {{ $producto->descripcion ?? 'N/A' }}</p>
                            <p><strong>Creado el:</strong> {{ $producto->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning">Editar</a>
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver al Listado</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection