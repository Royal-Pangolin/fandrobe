@extends('layouts.app')
@section('title', 'Categorías — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container">

        <div class="d-flex align-items-end justify-content-between mb-5">
            <div>
                <a href="{{ route('admin.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                    ← Panel
                </a>
                <h1 class="fw-bolder mb-0">Categorías</h1>
            </div>
            <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary fw-bold px-4">
                + Nueva categoría
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
                        <th class="fw-bold py-3">Categoría padre</th>
                        <th class="fw-bold py-3">Productos</th>
                        <th class="fw-bold py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="admin-tr">
                            <td class="px-4 py-3 text-muted fw-bold">{{ $category->id }}</td>
                            <td class="py-3 fw-bold">{{ $category->name }}</td>
                            <td class="py-3 text-muted">{{ $category->parent->name ?? '—' }}</td>
                            <td class="py-3 text-muted">{{ $category->products_count }}</td>
                            <td class="py-3 d-flex gap-2">
                                <a href="{{ route('admin.categorias.edit', $category->id) }}"
                                   class="btn btn-sm fw-bold px-3 btn-admin-ghost">
                                    Editar
                                </a>
                                <form action="{{ route('admin.categorias.destroy', $category->id) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar esta categoría?')">
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
                            <td colspan="5" class="text-center py-5 text-muted">No hay categorías registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $categories->links() }}</div>

    </div>
</div>
@endsection
