@extends('layouts.public')

@section('title', 'Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="row g-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <!-- Left Side - Branding -->
                <div class="col-md-6 d-none d-md-block" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <div class="d-flex flex-column justify-content-center align-items-center h-100 p-5 text-white">
                        <div class="mb-4">
                            <i class="fas fa-user-plus" style="font-size: 5rem; opacity: 0.9;"></i>
                        </div>
                        <h2 class="fw-bold mb-3 text-center">Join LAFRIQUE Properties</h2>
                        <p class="text-center opacity-75 mb-4">Start your journey in Africa's premier property marketplace today.</p>
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="fas fa-home me-2"></i>
                                <span>List Properties</span>
                            </div>
                            <div class="mb-3">
                                <i class="fas fa-chart-line me-2"></i>
                                <span>Track Performance</span>
                            </div>
                            <div>
                                <i class="fas fa-handshake me-2"></i>
                                <span>Connect with Buyers</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Register Form -->
                <div class="col-md-6 bg-white">
                    <div class="p-5">
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                                 style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                <i class="fas fa-user-plus text-white fs-4"></i>
                            </div>
                            <h3 class="fw-bold mb-2">Create Account 🎉</h3>
                            <p class="text-muted">Join thousands of property professionals</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="fas fa-user me-2 text-success"></i>Full Name
                                </label>
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" 
                                       placeholder="Enter your full name" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-2 text-success"></i>Email Address
                                </label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="your@email.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label fw-semibold">
                                    <i class="fas fa-user-tag me-2 text-success"></i>I am a
                                </label>
                                <select class="form-select form-select-lg @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">Select your role</option>
                                    <option value="agent" {{ old('role') === 'agent' ? 'selected' : '' }}>🏢 Agent</option>
                                    <option value="landlord" {{ old('role') === 'landlord' ? 'selected' : '' }}>🏠 Landlord / JV Partner</option>
                                    <option value="developer" {{ old('role') === 'developer' ? 'selected' : '' }}>🏗️ Developer</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-success"></i>Password
                                </label>
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Minimum 8 characters" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Minimum 8 characters</small>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    <i class="fas fa-check-circle me-2 text-success"></i>Confirm Password
                                </label>
                                <input type="password" class="form-control form-control-lg" 
                                       id="password_confirmation" name="password_confirmation" 
                                       placeholder="Re-enter your password" required>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100 mb-4" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </form>

                        <div class="position-relative my-4">
                            <hr>
                            <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">OR</span>
                        </div>

                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Already have an account? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                    <i class="fas fa-sign-in-alt me-1"></i>Sign In
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
