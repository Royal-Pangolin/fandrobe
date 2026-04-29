@extends('layouts.app')
@section('title', 'Productos — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container">

        <div class="d-flex align-items-end justify-content-between mb-5">
            <div>
                <a href="{{ route('admin.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                    ← Panel
                </a>
                <h1 class="fw-bolder mb-0">Productos</h1>
            </div>
            <a href="{{ route('admin.productos.create') }}" class="btn btn-primary fw-bold px-4">
                + Nuevo producto
            </a>
        </div>

        @if(session('mensaje'))
            <div class="alert alert-admin-success rounded-3 mb-4">{{ session('mensaje') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-admin-error rounded-3 mb-4">{{ session('error') }}</div>
        @endif

        <div class="admin-table-wrapper rounded-4 overflow-hidden">
            <table class="table mb-0 admin-table">
                <thead class="admin-thead">
                    <tr>
                        <th class="fw-bold px-4 py-3">#</th>
                        <th class="fw-bold py-3">Nombre</th>
                        <th class="fw-bold py-3">Artista</th>
                        <th class="fw-bold py-3">Categoría</th>
                        <th class="fw-bold py-3">Precio</th>
                        <th class="fw-bold py-3">Estado</th>
                        <th class="fw-bold py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="admin-tr">
                            <td class="px-4 py-3 text-muted fw-bold">{{ $product->id }}</td>
                            <td class="py-3 fw-bold">{{ $product->name }}</td>
                            <td class="py-3 text-muted">{{ $product->artist->name ?? '—' }}</td>
                            <td class="py-3 text-muted">{{ $product->category->name ?? '—' }}</td>
                            <td class="py-3 fw-bold">€{{ number_format($product->base_price, 2) }}</td>
                            <td class="py-3">
                                @if($product->is_active)
                                    <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-active">Activo</span>
                                @else
                                    <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-inactive">Inactivo</span>
                                @endif
                            </td>
                            <td class="py-3 d-flex gap-2">
                                <a href="{{ route('admin.productos.edit', $product->id) }}"
                                   class="btn btn-sm fw-bold px-3 btn-admin-ghost">
                                    Editar
                                </a>
                                <form action="{{ route('admin.productos.destroy', $product->id) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm fw-bold px-3 btn-admin-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No hay productos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $products->links() }}</div>

    </div>
</div>
@endsection
