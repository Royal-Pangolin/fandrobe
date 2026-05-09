@extends('layouts.app')
@section('title', __('messages.user') . ' — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container-sm">

        <div class="mb-5">
            <a href="{{ route('admin.usuarios.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                ← {{ __('messages.users') }}
            </a>
            <h1 class="fw-bolder mb-0">{{ $user->first_name }} {{ $user->last_name }}</h1>
        </div>

        <div class="d-flex flex-column gap-3">

            <div class="admin-card p-4 rounded-4">
                <h2 class="fw-bold mb-3 admin-label">{{ __('messages.personal_info') }}</h2>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <p class="text-muted small mb-1">{{ __('messages.name') }}</p>
                        <p class="fw-bold mb-0">{{ $user->first_name }} {{ $user->last_name }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-muted small mb-1">{{ __('messages.email_label') }}</p>
                        <p class="fw-bold mb-0">{{ $user->email }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-muted small mb-1">{{ __('messages.phone') }}</p>
                        <p class="fw-bold mb-0">{{ $user->phone ?? '—' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-muted small mb-1">{{ __('messages.registration_date') }}</p>
                        <p class="fw-bold mb-0">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="admin-card p-4 rounded-4">
                <h2 class="fw-bold mb-3 admin-label">{{ __('messages.account') }}</h2>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <p class="text-muted small mb-1">{{ __('messages.role') }}</p>
                        <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-status">
                            {{ $user->role->name ?? '—' }}
                        </span>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-muted small mb-1">{{ __('messages.status') }}</p>
                        @if($user->is_active)
                            <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-active">{{ __('messages.active') }}</span>
                        @else
                            <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-inactive">{{ __('messages.inactive') }}</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
