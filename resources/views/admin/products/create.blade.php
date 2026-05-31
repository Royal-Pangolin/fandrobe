@extends('layouts.app')
@section('title', __('messages.new_product') . ' — Admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <a href="{{ route('admin.productos.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-muted hover:text-shadow transition-colors uppercase tracking-widest mb-4">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            {{ __('messages.products') }}
        </a>
        <h1 class="text-4xl font-extrabold text-shadow tracking-tight">{{ __('messages.new_product') }}</h1>
    </div>

    @if($errors->any())
        <div class="bg-error/20 border border-error text-error px-6 py-4 rounded-2xl mb-8 shadow-sm">
            <ul class="list-disc list-inside font-bold">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-shadow/5 border border-shadow/5 p-8 rounded-3xl">
        <form action="{{ route('admin.productos.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.name') }} *</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full bg-primary border @error('name') border-error @else border-shadow/20 @enderror text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold"
                       required>
                @error('name')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.artist_label') }} *</label>
                    <select name="artist_id" class="w-full bg-primary border @error('artist_id') border-error @else border-shadow/20 @enderror text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold" required>
                        <option value="">{{ __('messages.select_artist') ?? 'Seleccionar artista' }}</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('artist_id')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.categories') }} *</label>
                    <div class="p-4 rounded-xl border @error('categories') border-error @else border-shadow/20 @enderror bg-primary/50 max-h-48 overflow-y-auto space-y-2">
                        @foreach($categories as $category)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       class="w-5 h-5 rounded border-shadow/30 text-accent focus:ring-accent focus:ring-offset-primary bg-primary transition-colors cursor-pointer"
                                       {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                <span class="text-sm font-bold text-shadow group-hover:text-accent transition-colors">
                                    {{ $category->translated_name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('categories')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.description') }}</label>
                <textarea name="description" rows="4"
                          class="w-full bg-primary border @error('description') border-error @else border-shadow/20 @enderror text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold">{{ old('description') }}</textarea>
                @error('description')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.image_url') }}</label>
                <input type="url" name="image_url" value="{{ old('image_url') }}"
                       class="w-full bg-primary border @error('image_url') border-error @else border-shadow/20 @enderror text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold"
                       placeholder="https://...">
                @error('image_url')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.base_price') }} *</label>
                    <input type="number" name="base_price" value="{{ old('base_price') }}"
                           step="0.01" min="0"
                           class="w-full bg-primary border @error('base_price') border-error @else border-shadow/20 @enderror text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold"
                           placeholder="0.00" required>
                    @error('base_price')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku') }}"
                           class="w-full bg-primary border @error('sku') border-error @else border-shadow/20 @enderror text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold"
                           placeholder="ABC-001">
                    @error('sku')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="bg-shadow/5 p-4 rounded-xl flex items-center gap-3 cursor-pointer group" onclick="document.getElementById('is_active').click();">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" id="is_active"
                       class="w-5 h-5 rounded border-shadow/30 text-accent focus:ring-accent focus:ring-offset-primary bg-primary transition-colors cursor-pointer"
                       {{ old('is_active', '1') ? 'checked' : '' }} onclick="event.stopPropagation();">
                <label for="is_active" class="text-sm font-bold text-shadow group-hover:text-accent transition-colors cursor-pointer" onclick="event.stopPropagation();">{{ __('messages.active_product') ?? 'Producto activo' }}</label>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-shadow/10">
                <button type="submit" class="btn-primary py-3 px-8 text-center">
                    {{ __('messages.create_product') ?? 'Crear producto' }}
                </button>
                <a href="{{ route('admin.productos.index') }}" class="inline-flex items-center justify-center px-8 py-3 border-2 border-shadow/20 rounded-full text-sm font-bold text-shadow hover:bg-shadow/5 hover:border-shadow/40 transition-all text-center">
                    {{ __('messages.cancel') ?? 'Cancelar' }}
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
