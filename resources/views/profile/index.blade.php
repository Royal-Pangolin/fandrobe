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
                @if (session('mensaje'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('mensaje') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        {{ session('error') }}
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
                {{-- Shipping Addresses --}}
                <div class="card mb-4">
                    <div class="card-header fw-semibold d-flex justify-content-between align-items-center">
                        Direcciones de envío
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse"
                            data-bs-target="#newAddressForm" aria-expanded="false" aria-controls="newAddressForm">
                            + Añadir
                        </button>
                    </div>
                    <div class="card-body">

                        {{-- Formulario nueva dirección (colapsable) --}}
                        <div class="collapse mb-4" id="newAddressForm">
                            <form method="POST" action="{{ route('addresses.store') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="new_alias" class="form-label">Alias</label>
                                        <input type="text" id="new_alias" name="alias"
                                            class="form-control" placeholder="Ej: Casa, Trabajo"
                                            value="{{ old('alias') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="new_phone" class="form-label">Teléfono</label>
                                        <input type="tel" id="new_phone" name="phone"
                                            class="form-control" value="{{ old('phone') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="new_street" class="form-label">Calle y número *</label>
                                        <input type="text" id="new_street" name="street"
                                            class="form-control @error('street') is-invalid @enderror"
                                            value="{{ old('street') }}" required>
                                        @error('street')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="new_city" class="form-label">Ciudad *</label>
                                        <input type="text" id="new_city" name="city"
                                            class="form-control @error('city') is-invalid @enderror"
                                            value="{{ old('city') }}" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="new_state" class="form-label">Provincia</label>
                                        <input type="text" id="new_state" name="state"
                                            class="form-control" value="{{ old('state') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="new_zip_code" class="form-label">Código postal *</label>
                                        <input type="text" id="new_zip_code" name="zip_code"
                                            class="form-control @error('zip_code') is-invalid @enderror"
                                            value="{{ old('zip_code') }}" required>
                                        @error('zip_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="new_country" class="form-label">País *</label>
                                        <input type="text" id="new_country" name="country"
                                            class="form-control @error('country') is-invalid @enderror"
                                            value="{{ old('country') }}" required>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="new_is_default"
                                                name="is_default" value="1">
                                            <label class="form-check-label" for="new_is_default">
                                                Predeterminada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Guardar dirección</button>
                                </div>
                            </form>
                            <hr>
                        </div>

                        {{-- Listado de direcciones --}}
                        @if ($user->addresses->isEmpty())
                            <p class="text-muted mb-0">No tienes direcciones de envío guardadas.</p>
                        @else
                            <div class="d-flex flex-column gap-3">
                                @foreach ($user->addresses as $address)
                                    <div class="border rounded-3 p-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <p class="fw-bold mb-1">
                                                    {{ $address->alias ?? 'Dirección' }}
                                                    @if ($address->is_default)
                                                        <span class="badge bg-success ms-1">Predeterminada</span>
                                                    @endif
                                                </p>
                                                <p class="mb-0 small text-muted">
                                                    {{ $address->street }}<br>
                                                    {{ $address->zip_code }} {{ $address->city }}@if($address->state), {{ $address->state }}@endif<br>
                                                    {{ $address->country }}
                                                    @if ($address->phone)
                                                        <br>Tel: {{ $address->phone }}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="d-flex gap-1 flex-shrink-0">
                                                @if (!$address->is_default)
                                                    <form method="POST"
                                                        action="{{ route('addresses.setDefault', $address->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-secondary"
                                                            title="Usar como predeterminada">★</button>
                                                    </form>
                                                @endif
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editAddress{{ $address->id }}"
                                                    title="Editar">Editar</button>
                                                <form method="POST"
                                                    action="{{ route('addresses.destroy', $address->id) }}"
                                                    onsubmit="return confirm('¿Eliminar esta dirección?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Eliminar">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal editar dirección --}}
                                    <div class="modal fade" id="editAddress{{ $address->id }}" tabindex="-1"
                                        aria-labelledby="editAddressLabel{{ $address->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST"
                                                    action="{{ route('addresses.update', $address->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-semibold"
                                                            id="editAddressLabel{{ $address->id }}">
                                                            Editar dirección
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Alias</label>
                                                                <input type="text" name="alias" class="form-control"
                                                                    value="{{ $address->alias }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Teléfono</label>
                                                                <input type="tel" name="phone" class="form-control"
                                                                    value="{{ $address->phone }}">
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label">Calle y número *</label>
                                                                <input type="text" name="street" class="form-control"
                                                                    value="{{ $address->street }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Ciudad *</label>
                                                                <input type="text" name="city" class="form-control"
                                                                    value="{{ $address->city }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Provincia</label>
                                                                <input type="text" name="state" class="form-control"
                                                                    value="{{ $address->state }}">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label">Código postal *</label>
                                                                <input type="text" name="zip_code" class="form-control"
                                                                    value="{{ $address->zip_code }}" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label">País *</label>
                                                                <input type="text" name="country" class="form-control"
                                                                    value="{{ $address->country }}" required>
                                                            </div>
                                                            <div class="col-md-4 d-flex align-items-end">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="edit_is_default_{{ $address->id }}"
                                                                        name="is_default" value="1"
                                                                        {{ $address->is_default ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="edit_is_default_{{ $address->id }}">
                                                                        Predeterminada
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar
                                                            cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

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
