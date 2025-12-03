@extends('layouts.public')

@section('title', 'Pricing Plans')

@section('content')
<!-- Hero Section -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="text-center text-white py-4">
            <h1 class="fw-bold mb-3 display-4">Simple, Transparent Pricing</h1>
            <p class="lead opacity-75 mb-4">Choose the perfect plan for your property listing needs</p>
            <div class="d-inline-block bg-white bg-opacity-25 rounded-pill px-4 py-2">
                <i class="fas fa-gift me-2"></i>
                <strong>All plans include a 30-day free trial!</strong>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row g-4 justify-content-center">
        @foreach($plans as $plan)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow h-100 {{ $plan->is_popular ? 'border-primary' : '' }}" 
                     style="{{ $plan->is_popular ? 'border: 3px solid var(--primary-color) !important; transform: scale(1.05);' : '' }} border-radius: 20px; transition: all 0.3s ease;">
                    @if($plan->is_popular)
                        <div class="badge bg-primary position-absolute top-0 start-50 translate-middle px-4 py-2" style="font-size: 0.9rem;">
                            <i class="fas fa-star me-1"></i>Most Popular
                        </div>
                    @endif
                    
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            @if($plan->name === 'Starter')
                                <i class="fas fa-rocket fa-3x text-primary mb-3" style="opacity: 0.8;"></i>
                            @elseif($plan->name === 'Professional')
                                <i class="fas fa-crown fa-3x text-warning mb-3" style="opacity: 0.8;"></i>
                            @else
                                <i class="fas fa-building fa-3x text-info mb-3" style="opacity: 0.8;"></i>
                            @endif
                        </div>
                        
                        <h4 class="mb-2 fw-bold">{{ $plan->name }}</h4>
                        <p class="text-muted mb-4">{{ $plan->description }}</p>
                        
                        <div class="mb-4 p-3" style="background: #f8fafc; border-radius: 12px;">
                            <h2 class="fw-bold mb-0 text-primary">{{ $plan->formatted_price_monthly }}</h2>
                            <small class="text-muted fw-semibold">per month</small>
                            <p class="text-muted small mt-2 mb-0">
                                <i class="fas fa-tag me-1"></i>or {{ $plan->formatted_price_annual }} annually (Save 17%)
                            </p>
                            @if($plan->trial_days > 0)
                                <div class="mt-2">
                                    <span class="badge bg-success px-3 py-2">
                                        <i class="fas fa-gift me-1"></i>{{ $plan->trial_days }}-Day Free Trial
                                    </span>
                                </div>
                            @endif
                        </div>

                        <ul class="list-unstyled text-start mb-4">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>{{ $plan->max_listings ?: 'Unlimited' }}</strong> Property Listings
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>{{ $plan->max_featured_listings }}</strong> Featured Listings
                            </li>
                            @if($plan->features)
                                @foreach(json_decode($plan->features) as $feature)
                                    @if(!str_contains($feature, 'Listings') && !str_contains($feature, 'Free Trial'))
                                        <li class="mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            {{ $feature }}
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                            @if($plan->priority_support)
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Priority Support
                                </li>
                            @endif
                            @if($plan->analytics_access)
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Advanced Analytics
                                </li>
                            @endif
                            @if($plan->api_access)
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    API Access
                                </li>
                            @endif
                        </ul>

                        <div class="d-grid gap-2">
                            @auth
                                @if($plan->trial_days > 0)
                                    <a href="{{ route('billing.checkout', ['plan' => $plan->id, 'cycle' => 'monthly']) }}" 
                                       class="btn btn-success btn-lg">
                                        <i class="fas fa-gift me-2"></i>Start Free Trial
                                    </a>
                                @endif
                                <a href="{{ route('billing.checkout', ['plan' => $plan->id, 'cycle' => 'monthly']) }}" 
                                   class="btn {{ $plan->is_popular ? 'btn-primary' : 'btn-outline-primary' }} {{ $plan->trial_days > 0 ? '' : 'btn-lg' }}">
                                    <i class="fas fa-credit-card me-2"></i>Subscribe Monthly
                                </a>
                                <a href="{{ route('billing.checkout', ['plan' => $plan->id, 'cycle' => 'annual']) }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-calendar-check me-2"></i>Subscribe Annually
                                </a>
                            @else
                                <a href="{{ route('register') }}" 
                                   class="btn btn-success btn-lg">
                                    <i class="fas fa-gift me-2"></i>Start Free Trial
                                </a>
                                <a href="{{ route('login') }}" 
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login to Subscribe
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Features Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 20px;">
                <div class="card-body p-5 text-center">
                    <h3 class="fw-bold mb-4">All Plans Include</h3>
                    <div class="row g-4">
                        <div class="col-md-3 col-6">
                            <div class="p-3">
                                <i class="fas fa-shield-alt fa-2x text-primary mb-3"></i>
                                <h6 class="fw-bold">Secure Platform</h6>
                                <small class="text-muted">SSL encrypted & protected</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3">
                                <i class="fas fa-headset fa-2x text-success mb-3"></i>
                                <h6 class="fw-bold">Email Support</h6>
                                <small class="text-muted">Get help when you need it</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3">
                                <i class="fas fa-chart-line fa-2x text-info mb-3"></i>
                                <h6 class="fw-bold">Basic Analytics</h6>
                                <small class="text-muted">Track your performance</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3">
                                <i class="fas fa-mobile-alt fa-2x text-warning mb-3"></i>
                                <h6 class="fw-bold">Mobile Friendly</h6>
                                <small class="text-muted">Works on all devices</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mt-5">
        <div class="col-12 text-center mb-4">
            <h3 class="fw-bold">Frequently Asked Questions</h3>
        </div>
        <div class="col-lg-8 mx-auto">
            <div class="accordion" id="pricingFaq">
                <div class="accordion-item border-0 mb-3 shadow-sm" style="border-radius: 12px;">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            <i class="fas fa-question-circle text-primary me-2"></i>
                            How does the 30-day free trial work?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#pricingFaq">
                        <div class="accordion-body">
                            Start any plan with a full 30-day free trial. No credit card required! You'll have access to all features included in your chosen plan. After the trial ends, you can choose to subscribe or your account will be downgraded.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-3 shadow-sm" style="border-radius: 12px;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            <i class="fas fa-question-circle text-primary me-2"></i>
                            Can I upgrade or downgrade my plan?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                        <div class="accordion-body">
                            Yes! You can upgrade or downgrade your plan at any time. When upgrading, you'll get immediate access to new features. When downgrading, the change takes effect at the end of your current billing cycle.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-3 shadow-sm" style="border-radius: 12px;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            <i class="fas fa-question-circle text-primary me-2"></i>
                            What payment methods do you accept?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                        <div class="accordion-body">
                            We accept all major credit/debit cards, bank transfers, and mobile payments. All payments are processed securely through our payment partners.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <p class="text-muted mb-2">Need a custom plan for your organization?</p>
        <a href="mailto:sales@propertieslafrique.com" class="btn btn-outline-primary">
            <i class="fas fa-envelope me-2"></i>Contact Sales Team
        </a>
    </div>
</div>
@endsection
