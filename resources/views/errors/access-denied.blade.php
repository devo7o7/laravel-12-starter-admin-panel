@extends('layouts.app')

@section('title', 'Application Access Restricted')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5 text-center">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="bg-danger py-4">
                    <i class="bi bi-shield-lock-fill text-white" style="font-size: 4rem;"></i>
                </div>
                
                <div class="card-body p-5">
                    <h2 class="fw-bold text-dark mb-3">Access Restricted</h2>
                    
                    <div class="alert alert-light border-0 text-muted mb-4">
                        @if(session('error'))
                            {{ session('error') }}
                        @else
                            The application <strong>"PrasarNet"</strong> is not included in your assigned scope.
                        @endif
                    </div>

                    <p class="small text-secondary mb-4">
                        To maintain security, please log out. This will terminate your current session across the platform.
                    </p>

                    <div class="d-grid gap-2">
                        <form id="logout-close-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100 py-2 fw-bold shadow-sm">
                                <i class="bi bi-power me-2"></i>Logout & Close Application
                            </button>
                        </form>
                        
                        <a class="btn btn-link text-decoration-none text-muted small mt-2">
                            Contact System Administrator
                        </a>
                    </div>
                </div>
                
                <div class="card-footer bg-light border-0 py-3">
                    <small class="text-muted font-monospace" style="font-size: 0.75rem;">
                        IP: {{ request()->ip() }} | Session ID: {{ substr(session()->getId(), 0, 8) }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('logout-close-form').addEventListener('submit', function(e) {
        // We use a small delay to allow the POST request to initiate before trying to close
        setTimeout(function() {
            window.close();
            
            // Fallback if window.close() is blocked by browser security
            setTimeout(function() {
                document.body.innerHTML = `
                    <div style="height: 100vh; display: flex; align-items: center; justify-content: center; font-family: sans-serif; text-align: center;">
                        <div>
                            <h1 style="color: #dc3545;">Session Terminated</h1>
                            <p>You have been logged out. You can now safely close this browser window.</p>
                        </div>
                    </div>
                `;
            }, 500);
        }, 100);
    });
</script>
@endsection