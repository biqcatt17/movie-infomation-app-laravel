<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TOSMERL') }}</title>

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <link href="{{ asset('asset/bootstrap-5.3.6/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-dark">
    <div id="app">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    <img src="{{ asset('asset/images/logo.png') }}" alt="TOSMERL Logo" class="me-2" height="40">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('movies*') ? 'active' : '' }}" href="{{ route('movies') }}">Movies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('tv-shows*') ? 'active' : '' }}" href="{{ route('tv-shows') }}">TV Shows</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('web-series*') ? 'active' : '' }}" href="{{ route('web-series') }}">Web Series</a>
                        </li>
                    </ul>
                    
                    <form class="d-flex me-3" action="{{ route('search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control bg-dark text-white border-secondary" 
                                placeholder="Search all content..." value="{{ request('search') }}">
                            <button class="btn btn-outline-light" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <div class="d-flex">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="btn btn-outline-light">Sign In</a>
                            @endif
                        @else
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end bg-dark">
                                    <li>
                                        <a class="dropdown-item text-white" href="{{ route('profile.index') }}">Profile</a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-white">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4 mt-5">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-black text-white-50 py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-white">TOSMERL</h5>
                        <p>Your ultimate streaming destination</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p>&copy; {{ date('Y') }} TOSMERL. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
