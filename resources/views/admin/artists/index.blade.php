@extends('layouts.app')
@section('title', 'Artistas — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container">

        <div class="d-flex align-items-end justify-content-between mb-5">
            <div>
                <a href="{{ route('admin.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                    ← Panel
                </a>
                <h1 class="fw-bolder mb-0">Artistas</h1>
            </div>
            <a href="{{ route('admin.artistas.create') }}" class="btn btn-primary fw-bold px-4">
                + Nuevo artista
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
                        <th class="fw-bold py-3">Género</th>
                        <th class="fw-bold py-3">Productos</th>
                        <th class="fw-bold py-3">Estado</th>
                        <th class="fw-bold py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artists as $artist)
                        <tr class="admin-tr">
                            <td class="px-4 py-3 text-muted fw-bold">{{ $artist->id }}</td>
                            <td class="py-3 fw-bold">{{ $artist->name }}</td>
                            <td class="py-3 text-muted">{{ $artist->genre->name ?? '—' }}</td>
                            <td class="py-3 text-muted">{{ $artist->products_count }}</td>
                            <td class="py-3">
                                @if($artist->is_active)
                                    <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-active">Activo</span>
                                @else
                                    <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-inactive">Inactivo</span>
                                @endif
                            </td>
                            <td class="py-3 d-flex gap-2">
                                <a href="{{ route('admin.artistas.edit', $artist->id) }}"
                                   class="btn btn-sm fw-bold px-3 btn-admin-ghost">
                                    Editar
                                </a>
                                <form action="{{ route('admin.artistas.destroy', $artist->id) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar este artista?')">
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
                            <td colspan="6" class="text-center py-5 text-muted">No hay artistas registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $artists->links() }}</div>

    </div>
</div>
@endsection
