@extends('layouts.guest')
@section('title', 'Create Account')

@section('content')
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark">{{ __('Join Us') }}</h4>
        <p class="text-muted small">{{ __('Create your account to get started') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name Field --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">{{ __('Full Name') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-primary"></i></span>
                <input type="text" name="name" class="form-control border-start-0 @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" placeholder="John Doe" required autofocus>
            </div>
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Email Field --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">{{ __('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-primary"></i></span>
                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" placeholder="name@example.com" required>
            </div>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Password Field --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">{{ __('Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock text-primary"></i></span>
                <input type="password" id="password" name="password" 
                       class="form-control border-x-0 @error('password') is-invalid @enderror" 
                       placeholder="••••••••" required>
                <button class="btn btn-outline-light border border-start-0 text-muted" type="button" id="togglePassword">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </button>
            </div>
            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Confirm Password Field --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-check text-primary"></i></span>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       class="form-control border-start-0" placeholder="••••••••" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 shadow-sm mb-3">
            {{ __('Create Account') }} <i class="bi bi-person-plus ms-1"></i>
        </button>

        <div class="text-center">
            <span class="small text-muted">Already have an account?</span>
            <a href="{{ route('login') }}" class="small text-decoration-none fw-bold ms-1">Log in</a>
        </div>
    </form>

    {{-- Script for Password Toggle --}}
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const passwordConf = document.querySelector('#password_confirmation');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            passwordConf.setAttribute('type', type); // Toggle both for convenience
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
    </script>
@endsection