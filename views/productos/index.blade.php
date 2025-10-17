@extends('layouts.app') 

@section('content')
    <div class="container mt-4">
        <h1>Gestión de Productos</h1>
        
        <a href="{{ route('productos.create') }}" class="btn btn-success mb-3">
            Crear Nuevo Producto
        </a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Formulario de Búsqueda y Filtros --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Filtros y Búsqueda</h5>
                <form action="{{ route('productos.index') }}" method="GET" class="row g-3">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control" 
                            placeholder="Buscar por Nombre o Código..." 
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="categoria" class="form-select">
                            <option value="">Todas las Categorías</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" 
                                    {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="stock_bajo" value="1" id="stockBajo"
                                {{ request('stock_bajo') ? 'checked' : '' }}>
                            <label class="form-check-label" for="stockBajo">
                                Stock Bajo
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary me-2">Buscar/Filtrar</button>
                        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Limpiar</a>
                    </div>
                </form>
            </div>
        </div>
        
        {{-- Tabla de Listado --}}
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Código</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $producto)
                <tr>
                    <td>
                        {{-- CRÍTICO: Estilo para tamaño uniforme 50x50px --}}
                        @if ($producto->imagen)
                            <img src="{{ Storage::url($producto->imagen) }}" alt="{{ $producto->nombre }}" 
                                 style="width: 50px; height: 50px; object-fit: cover;" 
                                 class="rounded">
                        @else
                            [N/A]
                        @endif
                    </td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria->nombre ?? 'N/A' }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>
                        <span class="badge {{ $producto->stock <= 5 ? 'bg-danger' : 'bg-success' }}">
                            {{ $producto->stock }}
                        </span>
                    </td>
                    <td>{{ $producto->codigo_barras }}</td>
                    <td>
                        {{-- Botones de Acciones CRUD --}}
                        <a href="{{ route('productos.show', $producto) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-warning">Editar</a>
                        
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que desea eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron productos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        {{-- Paginación --}}
        <div class="d-flex justify-content-center">
            {{ $productos->links() }}
        </div>
        
    </div>
@endsection