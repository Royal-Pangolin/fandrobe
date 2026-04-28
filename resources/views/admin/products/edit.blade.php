@extends('layouts.app')
@section('title', 'Editar Producto — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container-sm">

        <div class="mb-5">
            <a href="{{ route('admin.productos.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                ← Productos
            </a>
            <h1 class="fw-bolder mb-0">Editar Producto</h1>
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

        <form action="{{ route('admin.productos.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="d-flex flex-column gap-4">

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">Nombre *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                           class="form-control rounded-pill @error('name') is-invalid @enderror"
                           required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase admin-form-label">Artista *</label>
                        <select name="artist_id" class="form-select rounded-pill @error('artist_id') is-invalid @enderror" required>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}"
                                    {{ old('artist_id', $product->artist_id) == $artist->id ? 'selected' : '' }}>
                                    {{ $artist->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('artist_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase admin-form-label">Categoría *</label>
                        <select name="category_id" class="form-select rounded-pill @error('category_id') is-invalid @enderror" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">Descripción</label>
                    <textarea name="description" rows="4"
                              class="form-control rounded-3 @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase admin-form-label">Precio base (€) *</label>
                        <input type="number" name="base_price" value="{{ old('base_price', $product->base_price) }}"
                               step="0.01" min="0"
                               class="form-control rounded-pill @error('base_price') is-invalid @enderror"
                               required>
                        @error('base_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase admin-form-label">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                               class="form-control rounded-pill @error('sku') is-invalid @enderror">
                        @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 p-3 rounded-3 admin-checkbox-row">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" id="is_active"
                           class="form-check-input admin-checkbox"
                           {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label fw-bold">Producto activo (visible en la tienda)</label>
                </div>

                <div class="d-flex gap-3 pt-2">
                    <button type="submit" class="btn btn-primary fw-bold px-5 admin-btn-submit">
                        Guardar cambios
                    </button>
                    <a href="{{ route('admin.productos.index') }}"
                       class="btn fw-bold px-4 btn-admin-ghost admin-btn-submit">
                        Cancelar
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection
