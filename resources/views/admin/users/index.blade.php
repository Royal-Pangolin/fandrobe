@extends('layouts.app')
@section('title', 'Usuarios — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container">

        <div class="d-flex align-items-end justify-content-between mb-5">
            <div>
                <a href="{{ route('admin.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                    ← Panel
                </a>
                <h1 class="fw-bolder mb-0">Usuarios</h1>
            </div>
        </div>

        <div class="admin-table-wrapper rounded-4 overflow-hidden">
            <table class="table mb-0 admin-table">
                <thead class="admin-thead">
                    <tr>
                        <th class="fw-bold px-4 py-3">#</th>
                        <th class="fw-bold py-3">Nombre</th>
                        <th class="fw-bold py-3">Email</th>
                        <th class="fw-bold py-3">Rol</th>
                        <th class="fw-bold py-3">Estado</th>
                        <th class="fw-bold py-3">Registro</th>
                        <th class="fw-bold py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="admin-tr">
                            <td class="px-4 py-3 text-muted fw-bold">{{ $user->id }}</td>
                            <td class="py-3 fw-bold">{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td class="py-3 text-muted">{{ $user->email }}</td>
                            <td class="py-3">
                                <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-status">
                                    {{ $user->role->name ?? '—' }}
                                </span>
                            </td>
                            <td class="py-3">
                                @if($user->is_active)
                                    <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-active">Activo</span>
                                @else
                                    <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-inactive">Inactivo</span>
                                @endif
                            </td>
                            <td class="py-3 text-muted">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="py-3">
                                <a href="{{ route('admin.usuarios.show', $user->id) }}"
                                   class="btn btn-sm fw-bold px-3 btn-admin-ghost">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $users->links() }}</div>

    </div>
</div>
@endsection
