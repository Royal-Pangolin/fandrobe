@extends('layouts.app')
@section('title', __('messages.new_product') . ' — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container-sm">

        <div class="mb-5">
            <a href="{{ route('admin.productos.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                ← {{ __('messages.products') }}
            </a>
            <h1 class="fw-bolder mb-0">{{ __('messages.new_product') }}</h1>
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

        <form action="{{ route('admin.productos.store') }}" method="POST">
            @csrf

            <div class="d-flex flex-column gap-4">

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">{{ __('messages.name') }} *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="form-control rounded-pill @error('name') is-invalid @enderror"
                           required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase admin-form-label">{{ __('messages.artist_label') }} *</label>
                        <select name="artist_id" class="form-select rounded-pill @error('artist_id') is-invalid @enderror" required>
                            <option value="">{{ __('messages.select_artist') }}</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
                                    {{ $artist->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('artist_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase admin-form-label">{{ __('messages.categories') }} *</label>
                        <div class="p-3 rounded-3 border @error('categories') border-danger @enderror">
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                           id="cat-{{ $category->id }}"
                                           class="form-check-input admin-checkbox"
                                           {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cat-{{ $category->id }}">
                                        {{ $category->translated_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('categories')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">{{ __('messages.description') }}</label>
                    <textarea name="description" rows="4"
                              class="form-control rounded-3 @error('description') is-invalid @enderror"
                              >{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="form-label fw-bold small text-uppercase admin-form-label">{{ __('messages.image_url') }}</label>
                    <input type="url" name="image_url" value="{{ old('image_url') }}"
                           class="form-control rounded-pill @error('image_url') is-invalid @enderror"
                           placeholder="https://...">
                    @error('image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase admin-form-label">{{ __('messages.base_price') }} *</label>
                        <input type="number" name="base_price" value="{{ old('base_price') }}"
                               step="0.01" min="0"
                               class="form-control rounded-pill @error('base_price') is-invalid @enderror"
                               placeholder="0.00" required>
                        @error('base_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-uppercase admin-form-label">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku') }}"
                               class="form-control rounded-pill @error('sku') is-invalid @enderror"
                               placeholder="ABC-001">
                        @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 p-3 rounded-3 admin-checkbox-row">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" id="is_active"
                           class="form-check-input admin-checkbox"
                           {{ old('is_active', '1') ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label fw-bold">{{ __('messages.active_product') }}</label>
                </div>

                <div class="d-flex gap-3 pt-2">
                    <button type="submit" class="btn btn-primary fw-bold px-5 admin-btn-submit">
                        {{ __('messages.create_product') }}
                    </button>
                    <a href="{{ route('admin.productos.index') }}"
                       class="btn fw-bold px-4 btn-admin-ghost admin-btn-submit">
                        {{ __('messages.cancel') }}
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection
