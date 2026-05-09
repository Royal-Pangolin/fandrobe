@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.register_title') }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- First Name -->
                            <div class="mb-3">
                                <label for="first_name" class="form-label">{{ __('messages.first_name') }}</label>
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" required autofocus autocomplete="given-name">
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="mb-3">
                                <label for="last_name" class="form-label">{{ __('messages.last_name') }}</label>
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" required autocomplete="family-name">
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                                <input id="phone" type="tel"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') }}" required autocomplete="tel">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('messages.email_label') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('messages.password_label') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation"
                                    class="form-label">{{ __('messages.confirm_password') }}</label>
                                <input id="password_confirmation" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.register_title') }}
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}" class="text-decoration-none text-dark">
                                    {{ __('messages.has_account') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
