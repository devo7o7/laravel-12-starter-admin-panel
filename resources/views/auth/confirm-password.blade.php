@extends('layouts.guest') {{-- Or your equivalent auth layout --}}

@section('title', 'Confirm Password')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="text-center mb-4">
                        <div class="bg-primary-subtle text-primary d-inline-block p-3 rounded-circle mb-3">
                            <i class="bi bi-shield-lock fs-2"></i>
                        </div>
                        <h4 class="fw-bold">{{ __('Secure Area') }}</h4>
                        <p class="text-muted small">
                            {{ __('This is a secure area. Please confirm your password before continuing.') }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-key"></i></span>
                                <input id="password" 
                                       type="password" 
                                       name="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       required 
                                       autocomplete="current-password"
                                       placeholder="Enter your password">
                                
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                {{ __('Confirm Password') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('dashboard') }}" class="text-decoration-none small text-muted">
                    <i class="bi bi-arrow-left"></i> Back to Safety
                </a>
            </div>
        </div>
    </div>
</div>
@endsection