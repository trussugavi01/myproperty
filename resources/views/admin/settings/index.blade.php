@extends('layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h3 class="mb-2 fw-bold">System Settings ⚙️</h3>
                        <p class="mb-0 opacity-75">Configure and manage platform settings, categories, locations, and subscription plans.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-cogs" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 animate-fade-in" style="border-radius: 16px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="fas fa-tags fa-2x text-white"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Property Categories</h5>
                    <p class="text-muted small mb-4">Manage property categories and types</p>
                    <a href="{{ route('admin.settings.categories') }}" class="btn btn-primary w-100">
                        <i class="fas fa-arrow-right me-2"></i>Manage Categories
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 animate-fade-in" style="border-radius: 16px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 80px; height: 80px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                            <i class="fas fa-map-marker-alt fa-2x text-white"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Locations</h5>
                    <p class="text-muted small mb-4">Manage cities and locations</p>
                    <a href="{{ route('admin.settings.locations') }}" class="btn btn-info w-100">
                        <i class="fas fa-arrow-right me-2"></i>Manage Locations
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 animate-fade-in" style="border-radius: 16px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 80px; height: 80px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="fas fa-star fa-2x text-white"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Amenities</h5>
                    <p class="text-muted small mb-4">Manage property amenities and features</p>
                    <a href="{{ route('admin.settings.amenities') }}" class="btn btn-warning w-100">
                        <i class="fas fa-arrow-right me-2"></i>Manage Amenities
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 animate-fade-in" style="border-radius: 16px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="fas fa-credit-card fa-2x text-white"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Subscription Plans</h5>
                    <p class="text-muted small mb-4">Manage pricing and subscription plans</p>
                    <a href="{{ route('admin.settings.plans') }}" class="btn btn-success w-100">
                        <i class="fas fa-arrow-right me-2"></i>Manage Plans
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
