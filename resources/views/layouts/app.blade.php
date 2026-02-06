<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Anveshika')</title>

  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}">

  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
    }

    .footer-fixed {
      background: #0d6efd;
      color: #fff;
      padding: 10px 0;
      text-align: center;
    }
  </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom px-0 px-md-2">
  <div class="container-fluid d-flex align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
      <img src="{{ asset('logo.png') }}" class="rounded-circle me-2" style="width: 3rem; height: 3rem;">
      <span class="fs-5 fw-bold text-black">Company Name</span>
    </a>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn text-black fs-5 fw-bold">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
      </button>
    </form>
  </div>
</nav>

<!-- Main Content -->
<main class="container py-4">
  @yield('content')
</main>

<!-- Fixed Footer -->
<footer class="footer-fixed mt-auto">
  <div class="container">
    <small>
     Designed & Developed by Dev Chaurasiya  © {{ date('Y') }} All Rights Reserved  
    </small>
  </div>
</footer>

<!-- JS -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@stack('scripts')

</body>
</html>
