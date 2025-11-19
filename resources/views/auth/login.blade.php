@extends('layouts.public')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="row g-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <!-- Left Side - Branding -->
                <div class="col-md-6 d-none d-md-block" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="d-flex flex-column justify-content-center align-items-center h-100 p-5 text-white">
                        <div class="mb-4">
                            <i class="fas fa-building" style="font-size: 5rem; opacity: 0.9;"></i>
                        </div>
                        <h2 class="fw-bold mb-3 text-center">Property.com.ng</h2>
                        <p class="text-center opacity-75 mb-4">Your trusted platform for buying, selling, and renting properties across Nigeria.</p>
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="fas fa-check-circle me-2"></i>
                                <span>Verified Properties</span>
                            </div>
                            <div class="mb-3">
                                <i class="fas fa-shield-alt me-2"></i>
                                <span>Secure Transactions</span>
                            </div>
                            <div>
                                <i class="fas fa-users me-2"></i>
                                <span>Trusted Community</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="col-md-6 bg-white">
                    <div class="p-5">
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                                 style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="fas fa-user text-white fs-4"></i>
                            </div>
                            <h3 class="fw-bold mb-2">Welcome Back! 👋</h3>
                            <p class="text-muted">Sign in to your account to continue</p>
                        </div>
                    
                        @if(session('status'))
                            <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
                                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                                </label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="your@email.com" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-primary"></i>Password
                                </label>
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Enter your password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                    <i class="fas fa-key me-1"></i>Forgot password?
                                </a>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </form>

                        <div class="position-relative my-4">
                            <hr>
                            <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">OR</span>
                        </div>

                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Don't have an account? 
                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                                    <i class="fas fa-user-plus me-1"></i>Create Account
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
