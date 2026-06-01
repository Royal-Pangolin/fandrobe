@extends('layouts.app')

@section('title', __('messages.profile_title'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if (session('status'))
        <div class="bg-accent/20 border border-accent text-accent px-4 py-3 rounded-xl mb-6 font-bold text-sm" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('mensaje'))
        <div class="bg-accent/20 border border-accent text-accent px-4 py-3 rounded-xl mb-6 font-bold text-sm" role="alert">
            {{ session('mensaje') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-error/20 border border-error text-error px-4 py-3 rounded-xl mb-6 font-bold text-sm" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="space-y-8">

        <!-- Personal Info -->
        <div class="bg-neutral/30 rounded-3xl shadow-sm border border-shadow/5 overflow-hidden">
            <div class="px-6 py-4 border-b border-shadow/10 bg-neutral/30">
                <h3 class="text-xl font-extrabold text-shadow">{{ __('messages.personal_info') }}</h3>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('user-profile-information.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-bold text-muted mb-2">{{ __('messages.first_name') }}</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required
                                class="w-full px-4 py-3 border @error('first_name') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            @error('first_name')
                                <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-bold text-muted mb-2">{{ __('messages.last_name') }}</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required
                                class="w-full px-4 py-3 border @error('last_name') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            @error('last_name')
                                <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-muted mb-2">{{ __('messages.email_label') }}</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-3 border @error('email') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            @error('email')
                                <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-bold text-muted mb-2">{{ __('messages.phone') }}</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full px-4 py-3 border @error('phone') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            @error('phone')
                                <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn-primary py-3 px-8 text-sm">
                            {{ __('messages.save_changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class="bg-neutral/30 rounded-3xl shadow-sm border border-shadow/5 overflow-hidden">
            <div class="px-6 py-4 border-b border-shadow/10 bg-neutral/30">
                <h3 class="text-xl font-extrabold text-shadow">{{ __('messages.change_password') }}</h3>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('user-password.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="current_password" class="block text-sm font-bold text-muted mb-2">{{ __('messages.current_password') }}</label>
                            <input type="password" id="current_password" name="current_password"
                                class="w-full px-4 py-3 border @error('current_password') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            @error('current_password')
                                <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-sm font-bold text-muted mb-2">{{ __('messages.new_password') }}</label>
                                <input type="password" id="password" name="password"
                                    class="w-full px-4 py-3 border @error('password') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                                @error('password')
                                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-bold text-muted mb-2">{{ __('messages.confirm_new_password') }}</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="w-full px-4 py-3 border border-shadow/20 rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn-primary py-3 px-8 text-sm">
                            {{ __('messages.update_password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Addresses -->
        <div class="bg-neutral/30 rounded-3xl shadow-sm border border-shadow/5 overflow-hidden">
            <div class="px-6 py-4 border-b border-shadow/10 bg-neutral/30 flex justify-between items-center">
                <h3 class="text-xl font-extrabold text-shadow">{{ __('messages.shipping_addresses') }}</h3>
                <button type="button" class="bg-shadow text-primary px-4 py-2 rounded-full text-xs font-bold hover:bg-shadow/90 transition-colors" onclick="document.getElementById('newAddressForm').classList.toggle('hidden')">
                    {{ __('messages.add_address') }}
                </button>
            </div>
            <div class="p-6">
                <div id="newAddressForm" class="hidden mb-8 border-b border-shadow/10 pb-8">
                    <form method="POST" action="{{ route('addresses.store') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                            <div class="md:col-span-6">
                                <label for="new_alias" class="block text-sm font-bold text-muted mb-2">{{ __('messages.alias') }}</label>
                                <input type="text" id="new_alias" name="alias" value="{{ old('alias') }}"
                                    class="w-full px-4 py-2 border border-shadow/20 rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            </div>
                            <div class="md:col-span-6">
                                <label for="new_phone" class="block text-sm font-bold text-muted mb-2">{{ __('messages.phone') }}</label>
                                <input type="tel" id="new_phone" name="phone" value="{{ old('phone') }}"
                                    class="w-full px-4 py-2 border border-shadow/20 rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            </div>
                            <div class="md:col-span-12">
                                <label for="new_street" class="block text-sm font-bold text-muted mb-2">{{ __('messages.street') }} *</label>
                                <input type="text" id="new_street" name="street" value="{{ old('street') }}" required
                                    class="w-full px-4 py-2 border border-shadow/20 rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            </div>
                            <div class="md:col-span-6">
                                <label for="new_city" class="block text-sm font-bold text-muted mb-2">{{ __('messages.city') }} *</label>
                                <input type="text" id="new_city" name="city" value="{{ old('city') }}" required
                                    class="w-full px-4 py-2 border border-shadow/20 rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            </div>
                            <div class="md:col-span-6">
                                <label for="new_state" class="block text-sm font-bold text-muted mb-2">{{ __('messages.state') }}</label>
                                <input type="text" id="new_state" name="state" value="{{ old('state') }}"
                                    class="w-full px-4 py-2 border border-shadow/20 rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            </div>
                            <div class="md:col-span-4">
                                <label for="new_zip_code" class="block text-sm font-bold text-muted mb-2">{{ __('messages.zip_code') }} *</label>
                                <input type="text" id="new_zip_code" name="zip_code" value="{{ old('zip_code') }}" required
                                    class="w-full px-4 py-2 border border-shadow/20 rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            </div>
                            <div class="md:col-span-4">
                                <label for="new_country" class="block text-sm font-bold text-muted mb-2">{{ __('messages.country') }} *</label>
                                <input type="text" id="new_country" name="country" value="{{ old('country') }}" required
                                    class="w-full px-4 py-2 border border-shadow/20 rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                            </div>
                            <div class="md:col-span-4 flex items-end pb-2">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" id="new_is_default" name="is_default" value="1"
                                        class="w-5 h-5 rounded border-shadow/30 text-accent focus:ring-accent bg-transparent cursor-pointer">
                                    <span class="text-muted text-sm font-bold">{{ __('messages.default_address') }}</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="bg-shadow text-primary px-6 py-2 rounded-full font-bold text-sm hover:scale-105 transition-all">{{ __('messages.save_address') }}</button>
                        </div>
                    </form>
                </div>

                @if ($user->addresses->isEmpty())
                    <p class="text-muted text-sm font-medium">{{ __('messages.no_addresses') }}</p>
                @else
                    <div class="space-y-4">
                        @foreach ($user->addresses as $address)
                            <div class="bg-primary border border-shadow/10 rounded-2xl p-5 flex flex-col sm:flex-row justify-between items-start gap-4">
                                <div>
                                    <p class="font-extrabold text-shadow mb-1 flex items-center gap-2">
                                        {{ $address->alias ?? __('messages.address_fallback') }}
                                        @if ($address->is_default)
                                            <span class="bg-verified text-white text-[10px] px-2 py-0.5 rounded-full uppercase tracking-widest">{{ __('messages.default_address') }}</span>
                                        @endif
                                    </p>
                                    <p class="text-sm text-muted font-medium leading-relaxed">
                                        {{ $address->street }}<br>
                                        {{ $address->zip_code }} {{ $address->city }}@if($address->state), {{ $address->state }}@endif<br>
                                        {{ $address->country }}
                                        @if ($address->phone)
                                            <br><span class="font-bold">{{ __('messages.tel_label') }}:</span> {{ $address->phone }}
                                        @endif
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if (!$address->is_default)
                                        <form method="POST" action="{{ route('addresses.setDefault', $address->id) }}">
                                            @csrf
                                            <button type="submit" class="p-2 text-muted hover:text-accent transition-colors" title="{{ __('messages.set_default_title') }}">
                                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                    <button type="button" class="text-xs font-bold uppercase tracking-widest text-shadow hover:text-accent transition-colors px-3 py-2" onclick="document.getElementById('editAddress{{ $address->id }}').classList.toggle('hidden')">
                                        {{ __('messages.edit') }}
                                    </button>
                                    <form method="POST" action="{{ route('addresses.destroy', $address->id) }}" onsubmit="return confirm('{{ __('messages.confirm_delete_address') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold uppercase tracking-widest text-error hover:text-error/80 transition-colors px-3 py-2">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Inline Edit Form (Replaces Modal) -->
                            <div id="editAddress{{ $address->id }}" class="hidden bg-neutral/30 p-6 rounded-2xl border border-shadow/10 mt-2 mb-6">
                                <h4 class="font-extrabold mb-4 text-shadow">{{ __('messages.edit_address') }}</h4>
                                <form method="POST" action="{{ route('addresses.update', $address->id) }}" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                        <div class="md:col-span-6">
                                            <label class="block text-xs font-bold text-muted mb-1">{{ __('messages.alias') }}</label>
                                            <input type="text" name="alias" class="w-full px-3 py-2 border border-shadow/20 rounded-lg bg-primary text-shadow text-sm" value="{{ $address->alias }}">
                                        </div>
                                        <div class="md:col-span-6">
                                            <label class="block text-xs font-bold text-muted mb-1">{{ __('messages.phone') }}</label>
                                            <input type="tel" name="phone" class="w-full px-3 py-2 border border-shadow/20 rounded-lg bg-primary text-shadow text-sm" value="{{ $address->phone }}">
                                        </div>
                                        <div class="md:col-span-12">
                                            <label class="block text-xs font-bold text-muted mb-1">{{ __('messages.street') }} *</label>
                                            <input type="text" name="street" class="w-full px-3 py-2 border border-shadow/20 rounded-lg bg-primary text-shadow text-sm" value="{{ $address->street }}" required>
                                        </div>
                                        <div class="md:col-span-6">
                                            <label class="block text-xs font-bold text-muted mb-1">{{ __('messages.city') }} *</label>
                                            <input type="text" name="city" class="w-full px-3 py-2 border border-shadow/20 rounded-lg bg-primary text-shadow text-sm" value="{{ $address->city }}" required>
                                        </div>
                                        <div class="md:col-span-6">
                                            <label class="block text-xs font-bold text-muted mb-1">{{ __('messages.state') }}</label>
                                            <input type="text" name="state" class="w-full px-3 py-2 border border-shadow/20 rounded-lg bg-primary text-shadow text-sm" value="{{ $address->state }}">
                                        </div>
                                        <div class="md:col-span-4">
                                            <label class="block text-xs font-bold text-muted mb-1">{{ __('messages.zip_code') }} *</label>
                                            <input type="text" name="zip_code" class="w-full px-3 py-2 border border-shadow/20 rounded-lg bg-primary text-shadow text-sm" value="{{ $address->zip_code }}" required>
                                        </div>
                                        <div class="md:col-span-4">
                                            <label class="block text-xs font-bold text-muted mb-1">{{ __('messages.country') }} *</label>
                                            <input type="text" name="country" class="w-full px-3 py-2 border border-shadow/20 rounded-lg bg-primary text-shadow text-sm" value="{{ $address->country }}" required>
                                        </div>
                                        <div class="md:col-span-4 flex items-end pb-2">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox" name="is_default" value="1" {{ $address->is_default ? 'checked' : '' }}
                                                    class="w-4 h-4 rounded border-shadow/30 text-accent focus:ring-accent bg-transparent">
                                                <span class="text-muted text-xs font-bold">{{ __('messages.default_address') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex justify-end gap-3 mt-4">
                                        <button type="button" class="px-4 py-2 text-xs font-bold text-muted hover:text-shadow" onclick="document.getElementById('editAddress{{ $address->id }}').classList.add('hidden')">{{ __('messages.cancel') }}</button>
                                        <button type="submit" class="bg-shadow text-primary px-4 py-2 rounded-full text-xs font-bold hover:scale-105 transition-transform">{{ __('messages.save_changes') }}</button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Preferences / Language -->
        <div class="bg-neutral/30 rounded-3xl shadow-sm border border-shadow/5 overflow-hidden">
            <div class="px-6 py-4 border-b border-shadow/10 bg-neutral/30">
                <h3 class="text-xl font-extrabold text-shadow">{{ __('messages.language') }}</h3>
            </div>
            <div class="p-6">
                <p class="text-muted text-sm font-medium mb-4">{{ __('messages.language_desc') }}</p>
                <form method="POST" action="{{ route('profile.updateLocale') }}" class="flex flex-col sm:flex-row items-start sm:items-end gap-4">
                    @csrf
                    <div class="w-full sm:w-64">
                        <select name="locale" id="locale" class="w-full px-4 py-3 border border-shadow/20 rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-bold text-sm">
                            <option value="es" {{ $user->locale === 'es' ? 'selected' : '' }}>{{ __('messages.spanish') }}</option>
                            <option value="en" {{ $user->locale === 'en' ? 'selected' : '' }}>{{ __('messages.english') }}</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-shadow text-primary px-6 py-3 rounded-xl font-bold text-sm hover:scale-105 transition-all w-full sm:w-auto">
                        {{ __('messages.save_language') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Account Details -->
        <div class="bg-neutral/30 rounded-3xl shadow-sm border border-shadow/5 overflow-hidden">
            <div class="px-6 py-4 border-b border-shadow/10 bg-neutral/30">
                <h3 class="text-xl font-extrabold text-shadow">{{ __('messages.account') }}</h3>
            </div>
            <div class="p-6">
                <ul class="space-y-4 text-sm">
                    <li class="flex items-center gap-3">
                        <span class="text-muted font-bold uppercase tracking-widest w-32">{{ __('messages.role') }}:</span>
                        <span class="font-extrabold text-shadow">{{ $user->role->name ?? '—' }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-muted font-bold uppercase tracking-widest w-32">{{ __('messages.member_since') }}:</span>
                        <span class="font-extrabold text-shadow">{{ $user->created_at->format('d/m/Y') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-muted font-bold uppercase tracking-widest w-32">{{ __('messages.status') }}:</span>
                        @if ($user->is_active)
                            <span class="bg-verified/20 text-verified px-3 py-1 rounded-full font-bold text-xs uppercase tracking-widest">{{ __('messages.active') }}</span>
                        @else
                            <span class="bg-error/20 text-error px-3 py-1 rounded-full font-bold text-xs uppercase tracking-widest">{{ __('messages.inactive') }}</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection
