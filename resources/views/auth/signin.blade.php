@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-shadow/5 p-8 rounded-3xl shadow-sm border border-shadow/5">
        <div>
            <h2 class="text-center text-3xl font-extrabold text-shadow mb-8">
                {{ __('messages.register_title') }}
            </h2>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="first_name" class="block text-sm font-bold text-muted mb-2">{{ __('messages.first_name') }}</label>
                <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus autocomplete="given-name"
                    class="appearance-none block w-full px-4 py-3 border @error('first_name') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('first_name')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="last_name" class="block text-sm font-bold text-muted mb-2">{{ __('messages.last_name') }}</label>
                <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name"
                    class="appearance-none block w-full px-4 py-3 border @error('last_name') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('last_name')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-bold text-muted mb-2">{{ __('messages.phone') }}</label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required autocomplete="tel"
                    class="appearance-none block w-full px-4 py-3 border @error('phone') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('phone')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-bold text-muted mb-2">{{ __('messages.email_label') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="appearance-none block w-full px-4 py-3 border @error('email') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('email')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-muted mb-2">{{ __('messages.password_label') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="appearance-none block w-full px-4 py-3 border @error('password') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('password')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-muted mb-2">{{ __('messages.confirm_password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="appearance-none block w-full px-4 py-3 border @error('password_confirmation') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full font-bold text-primary bg-shadow hover:bg-shadow/90 hover:scale-105 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-shadow">
                    {{ __('messages.register_title') }}
                </button>
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-sm font-bold text-shadow hover:text-accent transition-colors">
                    {{ __('messages.has_account') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
