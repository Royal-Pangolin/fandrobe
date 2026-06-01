@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-shadow/5 p-8 rounded-3xl shadow-sm border border-shadow/5">
        <div>
            <h2 class="text-center text-3xl font-extrabold text-shadow mb-8">
                {{ __('messages.login_title') }}
            </h2>
        </div>

        @if (session('status'))
            <div class="bg-accent/20 border border-accent text-accent px-4 py-3 rounded-xl mb-6 font-bold text-sm" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-bold text-muted mb-2">{{ __('messages.email_label') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="appearance-none block w-full px-4 py-3 border @error('email') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('email')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-muted mb-2">{{ __('messages.password_label') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="appearance-none block w-full px-4 py-3 border @error('password') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('password')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full font-bold text-primary bg-shadow hover:bg-shadow/90 hover:scale-105 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-shadow">
                    {{ __('messages.login_title') }}
                </button>
            </div>

            <div class="flex flex-col items-center justify-center space-y-3 mt-6">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-bold text-muted hover:text-accent transition-colors">
                        {{ __('messages.forgot_password') }}
                    </a>
                @endif
                <a href="{{ route('register') }}" class="text-sm font-bold text-shadow hover:text-accent transition-colors">
                    {{ __('messages.no_account') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
