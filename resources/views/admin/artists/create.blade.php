@extends('layouts.app')
@section('title', __('messages.new_artist') . ' — Admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <a href="{{ route('admin.artistas.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-muted hover:text-shadow transition-colors uppercase tracking-widest mb-4">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            {{ __('messages.nav_artists') }}
        </a>
        <h1 class="text-4xl font-extrabold text-shadow tracking-tight">{{ __('messages.new_artist') }}</h1>
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
        <form action="{{ route('admin.artistas.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.name') }} *</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full bg-primary border @error('name') border-error @else border-shadow/20 @enderror text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold"
                       required>
                @error('name')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.genre') }} *</label>
                <select name="genre_id" class="w-full bg-primary border @error('genre_id') border-error @else border-shadow/20 @enderror text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold" required>
                    <option value="">{{ __('messages.select_genre') ?? 'Seleccionar género' }}</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                @error('genre_id')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.bio') ?? 'Biografía' }}</label>
                <textarea name="bio" rows="4"
                          class="w-full bg-primary border @error('bio') border-error @else border-shadow/20 @enderror text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold">{{ old('bio') }}</textarea>
                @error('bio')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.image_url') ?? 'URL de imagen' }}</label>
                <input type="url" name="image_url" value="{{ old('image_url') }}"
                       class="w-full bg-primary border @error('image_url') border-error @else border-shadow/20 @enderror text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold"
                       placeholder="https://...">
                @error('image_url')<p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>@enderror
            </div>

            <div class="bg-shadow/5 p-4 rounded-xl flex items-center gap-3 cursor-pointer group" onclick="document.getElementById('is_active').click();">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" id="is_active"
                       class="w-5 h-5 rounded border-shadow/30 text-accent focus:ring-accent focus:ring-offset-primary bg-primary transition-colors cursor-pointer"
                       {{ old('is_active', '1') ? 'checked' : '' }} onclick="event.stopPropagation();">
                <label for="is_active" class="text-sm font-bold text-shadow group-hover:text-accent transition-colors cursor-pointer" onclick="event.stopPropagation();">{{ __('messages.active_artist') ?? 'Artista activo' }}</label>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-shadow/10">
                <button type="submit" class="btn-primary py-3 px-8 text-center">
                    {{ __('messages.create_artist') ?? 'Crear artista' }}
                </button>
                <a href="{{ route('admin.artistas.index') }}" class="inline-flex items-center justify-center px-8 py-3 border-2 border-shadow/20 rounded-full text-sm font-bold text-shadow hover:bg-shadow/5 hover:border-shadow/40 transition-all text-center">
                    {{ __('messages.cancel') ?? 'Cancelar' }}
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
