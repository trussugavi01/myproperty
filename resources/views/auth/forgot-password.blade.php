@extends('layouts.public')

@section('title', 'Forgot Password')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="row g-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <!-- Left Side - Branding -->
                <div class="col-md-6 d-none d-md-block" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="d-flex flex-column justify-content-center align-items-center h-100 p-5 text-white">
                        <div class="mb-4">
                            <i class="fas fa-key" style="font-size: 5rem; opacity: 0.9;"></i>
                        </div>
                        <h2 class="fw-bold mb-3 text-center">Password Recovery</h2>
                        <p class="text-center opacity-75 mb-4">Don't worry! It happens to the best of us. Enter your email and we'll send you a link to reset your password.</p>
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="fas fa-shield-alt me-2"></i>
                                <span>Secure Process</span>
                            </div>
                            <div class="mb-3">
                                <i class="fas fa-envelope me-2"></i>
                                <span>Email Verification</span>
                            </div>
                            <div>
                                <i class="fas fa-clock me-2"></i>
                                <span>Quick Recovery</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Forgot Password Form -->
                <div class="col-md-6 bg-white">
                    <div class="p-5">
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                                 style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="fas fa-lock text-white fs-4"></i>
                            </div>
                            <h3 class="fw-bold mb-2">Forgot Password? 🔐</h3>
                            <p class="text-muted">No problem! We'll send you reset instructions.</p>
                        </div>
                    
                        @if(session('status'))
                            <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
                                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
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
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>Enter the email address associated with your account
                                </small>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                                <i class="fas fa-paper-plane me-2"></i>Send Reset Link
                            </button>
                        </form>

                        <div class="position-relative my-4">
                            <hr>
                            <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">OR</span>
                        </div>

                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Remember your password? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                    <i class="fas fa-sign-in-alt me-1"></i>Back to Login
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
