@extends('layouts.app')

@section('title', 'Access Denied')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="mb-4">
                <i class="bi bi-shield-slash text-danger" style="font-size: 6rem;"></i>
            </div>
            
            <h1 class="display-4 fw-bold text-dark">403</h1>
            <h3 class="mb-3">Access Denied</h3>
            
            <p class="text-muted mb-4">
                Sorry, you do not have the necessary permissions to access this module. 
                Please contact your system administrator if you believe this is an error.
            </p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-arrow-left me-1"></i> Go Back
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-primary px-4">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </a>
            </div>

            <div class="mt-5 pt-4 border-top">
                <small class="text-muted">
                    Your IP: <span class="font-monospace">{{ request()->ip() }}</span> | 
                    Timestamp: {{ now()->format('Y-m-d H:i:s') }}
                </small>
            </div>
        </div>
    </div>
</div>
@endsection