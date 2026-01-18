<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FORTE')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #1a1a1a;
            font-family: 'Poppins', sans-serif;
            color: white;
            margin: 0;
            overflow-x: hidden;
        }

        .navbar-forte {
            padding: 20px 50px;
        }

        .navbar-brand img {
            height: 20px;
        }

        .nav-link {
            color: #ccc !important;
            margin: 0 15px;
            font-size: 0.9rem;
        }

        .btn-daftar-nav {
            background-color: #2d7a32;
            color: white !important;
            border-radius: 20px;
            padding: 5px 20px !important;
        }
    </style>

    @stack('styles')
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-forte">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/img/FORTE.png') }}">
        </a>

        {{-- <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-daftar-nav" href="{{ route('register') }}">Daftar</a>
                </li>
            </ul>
        </div> --}}
    </div>
</nav>

<!-- CONTENT -->
@yield('content')

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('scripts')
</body>
</html>
