@extends('layouts.app')
@section('title', 'Verificar Email')

@section('content')

<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="navbar-spacer"></div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="text-center mb-5">
                <div style="width: 64px; height: 64px; border-radius: 50%; background-color: rgba(110,117,86,0.12); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #6e7556;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h1 class="fw-bolder mb-2 text-tighter">Verifica tu email</h1>
                <p class="text-muted">
                    Hemos enviado un enlace de verificación a tu correo electrónico.
                    Por favor, revisa tu bandeja de entrada y haz clic en el enlace para continuar.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success text-center" role="alert">
                    Se ha enviado un nuevo enlace de verificación a tu email.
                </div>
            @endif

            <div class="panel p-4 rounded-4 text-center">
                <p class="text-muted small mb-3">
                    ¿No has recibido el correo?
                </p>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary fw-bold w-100">
                        Reenviar enlace de verificación
                    </button>
                </form>
            </div>

            <div class="text-center mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-muted text-decoration-none fw-bold">
                        Cerrar sesión
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
