@extends('layouts.guest')
@section('title', 'Reset Access')

@section('content')
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark">Reset Password</h4>
        <p class="text-muted small">An OTP/Reset link will be sent to your registered email.</p>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-4">
            <label class="form-label fw-semibold">Registered Email</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person-check text-primary"></i></span>
                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" required>
            </div>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 mb-3 shadow-sm">
            Send Reset Instructions
        </button>
        
        <div class="text-center">
            <a href="{{ route('login') }}" class="small text-decoration-none text-muted">
                <i class="bi bi-chevron-left"></i> Return to Login
            </a>
        </div>
    </form>
@endsection