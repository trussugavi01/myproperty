@extends('layouts.app')

@section('title', 'Subscription Plans')
@section('page-title', 'Subscription Plans')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h3 class="mb-2 fw-bold">Upgrade Your Listing Experience 🚀</h3>
                        <p class="mb-0 opacity-75">Choose the perfect plan to showcase your properties and reach more buyers.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-crown" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 justify-content-center">
    @foreach($plans as $plan)
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 animate-fade-in {{ $plan->is_popular ? 'border-primary' : '' }}" 
                 style="{{ $plan->is_popular ? 'border: 2px solid var(--bs-primary) !important; transform: scale(1.05);' : '' }} border-radius: 16px; transition: all 0.3s ease;">
                @if($plan->is_popular)
                    <div class="badge bg-primary position-absolute top-0 start-50 translate-middle px-3 py-2" style="font-size: 0.875rem;">
                        <i class="fas fa-star me-1"></i>Most Popular
                    </div>
                @endif
                
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-{{ $plan->is_popular ? 'crown' : 'box' }} fs-1 text-primary mb-3" style="opacity: 0.8;"></i>
                    </div>
                    <h4 class="mb-3 fw-bold">{{ $plan->name }}</h4>
                    <p class="text-muted mb-4">{{ $plan->description }}</p>
                    
                    <div class="mb-4 p-3" style="background: #f8fafc; border-radius: 12px;">
                        <h2 class="fw-bold mb-0 text-primary">{{ $plan->formatted_price_monthly }}</h2>
                        <small class="text-muted fw-semibold">per month</small>
                        <p class="text-muted small mt-2 mb-0">
                            <i class="fas fa-info-circle me-1"></i>or {{ $plan->formatted_price_annual }} annually
                        </p>
                    </div>

                    <ul class="list-unstyled text-start mb-4">
                        @if($plan->features)
                            @foreach(json_decode($plan->features) as $feature)
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        @endif
                        
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            {{ $plan->max_listings }} property listings
                        </li>
                        
                        @if($plan->max_featured_listings > 0)
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                {{ $plan->max_featured_listings }} featured listings
                            </li>
                        @endif
                        
                        @if($plan->max_images_per_listing > 0)
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Up to {{ $plan->max_images_per_listing }} images per listing
                            </li>
                        @endif
                        
                        @if($plan->has_analytics)
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Advanced analytics
                            </li>
                        @endif
                        
                        @if($plan->has_priority_support)
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Priority support
                            </li>
                        @endif
                    </ul>

                    <div class="d-grid gap-2">
                        <a href="{{ route('billing.checkout', ['plan' => $plan->id, 'cycle' => 'monthly']) }}" 
                           class="btn {{ $plan->is_popular ? 'btn-primary' : 'btn-outline-primary' }} btn-lg">
                            <i class="fas fa-calendar-alt me-2"></i>Select Monthly Plan
                        </a>
                        <a href="{{ route('billing.checkout', ['plan' => $plan->id, 'cycle' => 'annual']) }}" 
                           class="btn btn-outline-secondary">
                            <i class="fas fa-calendar-check me-2"></i>Select Annual Plan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: #f8fafc; border-radius: 16px;">
            <div class="card-body p-4 text-center">
                <i class="fas fa-shield-check fs-1 text-success mb-3"></i>
                <h5 class="fw-bold mb-3">All Plans Include</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <i class="fas fa-headset text-primary me-2"></i>
                        <span class="text-muted">Basic Support</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <i class="fas fa-chart-line text-success me-2"></i>
                        <span class="text-muted">Property Analytics</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <i class="fas fa-lock text-info me-2"></i>
                        <span class="text-muted">Secure Platform</span>
                    </div>
                </div>
                <hr class="my-3">
                <p class="text-muted mb-0">Need a custom plan? <a href="mailto:sales@property.com.ng" class="fw-semibold">Contact our sales team</a></p>
            </div>
        </div>
    </div>
</div>

@if($currentSubscription)
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm" style="border-radius: 16px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white;">
                <h5 class="alert-heading">
                    <i class="fas fa-info-circle me-2"></i>Current Subscription
                </h5>
                <p class="mb-0">
                    You are currently subscribed to the <strong>{{ $currentSubscription->plan->name }}</strong> plan.
                    Your subscription will renew on <strong>{{ $currentSubscription->ends_at->format('F j, Y') }}</strong>.
                </p>
                <hr>
                <a href="{{ route('billing.subscriptions') }}" class="btn btn-sm btn-outline-info">
                    Manage Subscription
                </a>
            </div>
        </div>
    </div>
@endif
@endsection
