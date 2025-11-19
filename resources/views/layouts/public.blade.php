<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Property Listing Platform') }} - @yield('title', 'Find Your Dream Property')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm public-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <span class="brand-icon d-inline-flex align-items-center justify-content-center me-2">
                    <i class="fas fa-building text-primary"></i>
                </span>
                <div class="d-flex flex-column">
                    <span class="fw-bold">Property.com.ng</span>
                    <small class="text-muted d-none d-md-inline">Find and list properties across Nigeria</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('properties.*') ? 'active' : '' }}" href="{{ route('properties.index') }}">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pricing') ? 'active' : '' }}" href="{{ route('pricing') }}">Pricing</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        @unless(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="btn btn-primary ms-2" href="{{ route(auth()->user()->role . '.properties.create') }}">
                                    <i class="fas fa-plus me-2"></i>Add Property
                                </a>
                            </li>
                        @endunless
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="{{ route('register') }}">Get Started</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-building me-2"></i>
                        PropertyNG
                    </h5>
                    <p class="text-white-50">Your trusted partner in finding the perfect property in Nigeria.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none hover-link">Home</a></li>
                        <li class="mb-2"><a href="{{ route('properties.index') }}" class="text-white-50 text-decoration-none hover-link">Properties</a></li>
                        <li class="mb-2"><a href="{{ route('pricing') }}" class="text-white-50 text-decoration-none hover-link">Pricing</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="mb-3">For Professionals</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('register') }}" class="text-white-50 text-decoration-none hover-link">List Your Property</a></li>
                        <li class="mb-2"><a href="{{ route('login') }}" class="text-white-50 text-decoration-none hover-link">Agent Login</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="mb-3">Legal</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('terms') }}" class="text-white-50 text-decoration-none hover-link">Terms & Conditions</a></li>
                        <li class="mb-2"><a href="{{ route('privacy') }}" class="text-white-50 text-decoration-none hover-link">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="mb-3">Contact</h6>
                    <p class="text-white-50 mb-2">
                        <i class="fas fa-envelope me-2"></i>
                        info@property.com.ng
                    </p>
                    <p class="text-white-50 mb-0">
                        <i class="fas fa-phone me-2"></i>
                        +234 800 000 0000
                    </p>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center text-white-50">
                <p class="mb-0">&copy; {{ date('Y') }} Property.com.ng. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
