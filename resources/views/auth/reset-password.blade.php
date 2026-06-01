@extends('layouts.app')

@section('title', __('messages.reset_password_title'))

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-shadow/5 p-8 rounded-3xl shadow-sm border border-shadow/5">
        <div>
            <h2 class="text-center text-3xl font-extrabold text-shadow mb-8">
                {{ __('messages.reset_password_title') }}
            </h2>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="email" class="block text-sm font-bold text-muted mb-2">{{ __('messages.email_label') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                    class="appearance-none block w-full px-4 py-3 border @error('email') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('email')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-muted mb-2">{{ __('messages.new_password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="appearance-none block w-full px-4 py-3 border @error('password') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('password')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-muted mb-2">{{ __('messages.confirm_new_password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="appearance-none block w-full px-4 py-3 border @error('password_confirmation') border-error @else border-shadow/20 @enderror rounded-xl bg-primary text-shadow focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent font-medium">
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-error font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full font-bold text-primary bg-shadow hover:bg-shadow/90 hover:scale-105 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-shadow">
                    {{ __('messages.reset_password_button') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
