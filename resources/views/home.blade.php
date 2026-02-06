<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Company Name</title>
    
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            padding: 120px 0 80px;
            color: white;
            clip-path: ellipse(150% 100% at 50% 0%);
        }
        .navbar-brand fw-bold { letter-spacing: -1px; }
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }
        .card { transition: transform 0.3s ease; }
        .card:hover { transform: translateY(-10px); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('logo.png') }}" width="40" height="40" class="me-2" alt="Logo">
                <span class="fw-bold fs-4">Company Name</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item"><a class="nav-link px-3" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#about">About</a></li>
                    
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary rounded-pill px-4 ms-lg-3">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4 ms-lg-2">Get Started</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">Manage Your Business with Intelligence</h1>
                    <p class="lead mb-5 opacity-75">A powerful, secure, and modern administrative platform built to track your logs, manage roles, and grow your data analytics effortlessly.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold text-primary rounded-pill shadow">Start for Free</a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">Explore Features</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    
    <section id="features" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Why Choose Us?</h2>
                <p class="text-muted">Everything you need to manage your application in one place.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="feature-icon bg-primary-subtle text-primary">
                            <i class="bi bi-shield-lock fs-3"></i>
                        </div>
                        <h4 class="fw-bold">Role Management</h4>
                        <p class="text-muted">Granular permissions and role-based access control to keep your data secure and accessible only to the right people.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="feature-icon bg-success-subtle text-success">
                            <i class="bi bi-clock-history fs-3"></i>
                        </div>
                        <h4 class="fw-bold">Activity Logs</h4>
                        <p class="text-muted">Real-time tracking of user actions, device types, and IP addresses for full audit transparency.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="feature-icon bg-info-subtle text-info">
                            <i class="bi bi-graph-up-arrow fs-3"></i>
                        </div>
                        <h4 class="fw-bold">Live Analytics</h4>
                        <p class="text-muted">Visual dashboards and system health monitoring to stay ahead of your business metrics.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <span class="fw-bold fs-5">Company Name</span>
                    <p class="small text-muted mb-0 mt-2">© {{ date('Y') }} All Rights Reserved. Designed by Dev Chaurasiya</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-4 mt-md-0">
                    <a href="#" class="text-white me-3 text-decoration-none small">Privacy Policy</a>
                    <a href="#" class="text-white me-3 text-decoration-none small">Terms of Service</a>
                    <a href="#" class="text-white text-decoration-none small">Support</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>