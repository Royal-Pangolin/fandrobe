@extends('layouts.app')

@section('title', __('messages.profile_title'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Flash messages --}}
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Profile Info --}}
                <div class="card mb-4">
                    <div class="card-header fw-semibold">{{ __('messages.personal_info') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user-profile-information.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">{{ __('messages.first_name') }}</label>
                                    <input type="text" id="first_name" name="first_name"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name', $user->first_name) }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">{{ __('messages.last_name') }}</label>
                                    <input type="text" id="last_name" name="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name', $user->last_name) }}" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">{{ __('messages.email_label') }}</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                                    <input type="tel" id="phone" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.save_changes') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Change Password --}}
                <div class="card mb-4">
                    <div class="card-header fw-semibold">{{ __('messages.change_password') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user-password.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="current_password" class="form-label">{{ __('messages.current_password') }}</label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror">
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label">{{ __('messages.new_password') }}</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">{{ __('messages.confirm_new_password') }}</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.update_password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Language selector --}}
                <div class="card mb-4">
                    <div class="card-header fw-semibold">{{ __('messages.language') }}</div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">{{ __('messages.language_desc') }}</p>
                        <form method="POST" action="{{ route('profile.updateLocale') }}">
                            @csrf
                            <div class="row g-3 align-items-end">
                                <div class="col-md-6">
                                    <select name="locale" id="locale" class="form-select">
                                        <option value="es" {{ $user->locale === 'es' ? 'selected' : '' }}>{{ __('messages.spanish') }}</option>
                                        <option value="en" {{ $user->locale === 'en' ? 'selected' : '' }}>{{ __('messages.english') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('messages.save_language') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Account Info --}}
                <div class="card">
                    <div class="card-header fw-semibold">{{ __('messages.account') }}</div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0 small text-muted">
                            <li><strong>{{ __('messages.role') }}:</strong> {{ $user->role->name ?? '—' }}</li>
                            <li><strong>{{ __('messages.member_since') }}:</strong> {{ $user->created_at->format('d/m/Y') }}</li>
                            <li><strong>{{ __('messages.status') }}:</strong>
                                @if ($user->is_active)
                                    <span class="badge bg-success">{{ __('messages.active') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('messages.inactive') }}</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
