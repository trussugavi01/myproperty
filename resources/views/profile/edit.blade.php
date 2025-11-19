@extends('layouts.app')

@section('title', 'Edit Profile')
@section('page-title', 'My Profile')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h3 class="mb-2 fw-bold">My Profile 👤</h3>
                        <p class="mb-0 opacity-75">Manage your personal information and account settings.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-user-circle" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4 animate-fade-in">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Personal Information</h5>
                        <p class="text-muted small mb-0">Update your personal details</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold"><i class="fas fa-user me-2 text-primary"></i>Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your full name" 
                               id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold"><i class="fas fa-envelope me-2 text-primary"></i>Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@email.com" 
                               id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold"><i class="fas fa-phone me-2 text-primary"></i>Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="+234 XXX XXX XXXX" 
                               id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="avatar" class="form-label fw-semibold"><i class="fas fa-camera me-2 text-primary"></i>Profile Picture</label>
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" 
                               id="avatar" name="avatar" accept="image/*">
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Accepted formats: JPG, PNG. Max size: 2MB</small>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class="card border-0 shadow-sm animate-fade-in">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Change Password</h5>
                        <p class="text-muted small mb-0">Update your account password</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold"><i class="fas fa-key me-2 text-success"></i>Current Password</label>
                        <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" placeholder="Enter current password" 
                               id="current_password" name="current_password" required>
                        @error('current_password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold"><i class="fas fa-lock me-2 text-success"></i>New Password</label>
                        <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" placeholder="Enter new password" 
                               id="password" name="password" required>
                        @error('password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimum 8 characters</small>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold"><i class="fas fa-check-circle me-2 text-success"></i>Confirm New Password</label>
                        <input type="password" class="form-control" placeholder="Confirm new password" 
                               id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-shield-alt me-2"></i>Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Profile Card -->
        <div class="card border-0 shadow-sm mb-4 animate-fade-in">
            <div class="card-body text-center p-4">
                <div class="mb-3 position-relative d-inline-block">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" 
                             class="rounded-circle border border-4 border-primary" style="width: 140px; height: 140px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center border border-4 border-white shadow" 
                             style="width: 140px; height: 140px; font-size: 56px; font-weight: 600;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif
                    <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-3 border-white" 
                         style="width: 32px; height: 32px;" title="Active">
                        <i class="fas fa-check text-white" style="font-size: 0.75rem; line-height: 26px;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                <p class="text-muted mb-2">
                    <span class="badge bg-primary px-3 py-2">
                        <i class="fas fa-user-tag me-1"></i>{{ ucfirst(auth()->user()->role) }}
                    </span>
                </p>
                <p class="small text-muted mb-3">
                    <i class="fas fa-calendar-alt me-1"></i>Member since {{ auth()->user()->created_at->format('M Y') }}
                </p>
                <hr>
                <div class="d-grid gap-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                        <i class="fas fa-home me-2"></i>Go to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Account Stats -->
        <div class="card border-0 shadow-sm animate-fade-in">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="mb-0 fw-bold"><i class="fas fa-chart-bar me-2 text-info"></i>Account Stats</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <div>
                        <small class="text-muted d-block">Total Properties</small>
                        <h5 class="mb-0 fw-bold">{{ auth()->user()->properties()->count() }}</h5>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-building fs-3"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <div>
                        <small class="text-muted d-block">Active Listings</small>
                        <h5 class="mb-0 fw-bold">{{ auth()->user()->properties()->where('is_published', true)->count() }}</h5>
                    </div>
                    <div class="text-success">
                        <i class="fas fa-check-circle fs-3"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Total Inquiries</small>
                        <h5 class="mb-0 fw-bold">{{ auth()->user()->properties()->withCount('inquiries')->get()->sum('inquiries_count') }}</h5>
                    </div>
                    <div class="text-info">
                        <i class="fas fa-envelope fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
