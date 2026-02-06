@extends('layouts.guest')
@section('title', 'Secure Login')

@section('content')
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark">Welcome Back</h4>
        <p class="text-muted small">Please enter your credentials to manage accounts</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        {{-- Email Field --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-primary"></i></span>
                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" placeholder="admin@example.com" required autofocus>
            </div>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Password Field --}}
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label class="form-label fw-semibold">Password</label>
                <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot Password?</a>
            </div>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock text-primary"></i></span>
                <input type="password" id="password" name="password" class="form-control border-x-0 @error('password') is-invalid @enderror" placeholder="••••••••" required>
                <button class="btn btn-outline-light border border-start-0 text-muted" type="button" id="togglePassword">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </button>
            </div>
            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label small" for="remember">Remember this device</label>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 shadow-sm mb-3">
            Access Dashboard <i class="bi bi-arrow-right-short ms-1"></i>
        </button>
    </form>

    {{-- ADDED SIGN UP OPTION HERE --}}
    <hr class="text-muted opacity-25 my-4">

    <div class="text-center">
        <p class="small text-muted mb-0">Don't have an account?</p>
        <a href="{{ route('register') }}" class="fw-bold text-decoration-none text-primary">
            Create an Account <i class="bi bi-person-plus ms-1"></i>
        </a>
    </div>

    {{-- Script to handle toggle --}}
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
    </script>
@endsection