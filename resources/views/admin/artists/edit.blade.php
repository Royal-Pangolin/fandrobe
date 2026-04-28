@extends('layouts.app')
@section('title', 'Editar Artista — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container-sm">

        <div class="mb-5">
            <a href="{{ route('admin.artistas.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                ← Artistas
            </a>
            <h1 class="fw-bolder mb-0">Editar Artista</h1>
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

        <form action="{{ route('admin.artistas.update', $artist->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="d-flex flex-column gap-4">

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">Nombre *</label>
                    <input type="text" name="name" value="{{ old('name', $artist->name) }}"
                           class="form-control rounded-pill @error('name') is-invalid @enderror"
                           required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">Género musical *</label>
                    <select name="genre_id" class="form-select rounded-pill @error('genre_id') is-invalid @enderror" required>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}"
                                {{ old('genre_id', $artist->genre_id) == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">Biografía</label>
                    <textarea name="bio" rows="4"
                              class="form-control rounded-3 @error('bio') is-invalid @enderror">{{ old('bio', $artist->bio) }}</textarea>
                    @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">URL de imagen</label>
                    <input type="url" name="image_url" value="{{ old('image_url', $artist->image_url) }}"
                           class="form-control rounded-pill @error('image_url') is-invalid @enderror">
                    @error('image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex align-items-center gap-3 p-3 rounded-3 admin-checkbox-row">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" id="is_active"
                           class="form-check-input admin-checkbox"
                           {{ old('is_active', $artist->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label fw-bold">Artista activo (visible en la tienda)</label>
                </div>

                <div class="d-flex gap-3 pt-2">
                    <button type="submit" class="btn btn-primary fw-bold px-5 admin-btn-submit">
                        Guardar cambios
                    </button>
                    <a href="{{ route('admin.artistas.index') }}"
                       class="btn fw-bold px-4 btn-admin-ghost admin-btn-submit">
                        Cancelar
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection
