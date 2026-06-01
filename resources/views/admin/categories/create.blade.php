@extends('layouts.app')
@section('title', 'Nueva Categoría — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container-sm">

        <div class="mb-5">
            <a href="{{ route('admin.categorias.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                ← Categorías
            </a>
            <h1 class="fw-bolder mb-0">Nueva Categoría</h1>
        </div>

        @if($errors->any())
            <div class="alert alert-admin-error rounded-3 mb-4">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categorias.store') }}" method="POST">
            @csrf

            <div class="d-flex flex-column gap-4">

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">Nombre *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="form-control rounded-pill @error('name') is-invalid @enderror"
                           placeholder="Nombre de la categoría" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">Categoría padre</label>
                    <select name="parent_id" class="form-select rounded-pill @error('parent_id') is-invalid @enderror">
                        <option value="">Sin categoría padre</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">URL de imagen</label>
                    <input type="url" name="image_url" value="{{ old('image_url') }}"
                           class="form-control rounded-pill @error('image_url') is-invalid @enderror"
                           placeholder="https://...">
                    @error('image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-3 pt-2">
                    <button type="submit" class="btn btn-primary fw-bold px-5 admin-btn-submit">
                        Crear categoría
                    </button>
                    <a href="{{ route('admin.categorias.index') }}"
                       class="btn fw-bold px-4 btn-admin-ghost admin-btn-submit">
                        Cancelar
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection
