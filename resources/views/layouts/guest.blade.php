<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Dev Chaurasiya">
    <title>@yield('title') | DC </title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        body {
    /* Uses the local image with the blue accounting overlay */
    background: linear-gradient(135deg, rgba(146, 186, 245, 0.39) 0%, rgba(8, 66, 152, 0.9) 100%), 
                url("{{ asset('image/bg2.jpg') }}");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
}
        
        .auth-card {
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            /* Glassmorphism effect */
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .auth-logo {
            width: 75px;
            height: 75px;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .brand-text {
            color: #ffffff;
            text-shadow: 0 3px 6px rgba(0,0,0,0.3);
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }

        .form-control {
            border-left: none;
            padding: 0.75rem;
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 text-center">
                <div class="auth-logo">
                    <img src="{{ asset('logo.png') }}" class="img-fluid" alt="EMS Logo">
                </div>
                <h4 class="brand-text mb-4">Company Name</h4>
                
                <div class="card auth-card text-start mx-auto">
                    <div class="card-body p-4 p-md-5">
                        @yield('content')
                    </div>
                </div>

                <div class="mt-4 footer-text">
                    <small>Designed and Developed by <strong>Dev Chaurasiya </strong></small>
                    <small class="opacity-75">© {{ date('Y') }}</small>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>