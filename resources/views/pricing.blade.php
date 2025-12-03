@extends('layouts.public')

@section('title', 'Pricing Plans')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-3">Choose Your Plan</h1>
        <p class="lead text-muted">Select the perfect plan for your property listing needs</p>
    </div>

    <div class="row g-4 justify-content-center">
        @foreach($plans as $plan)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 {{ $plan->is_popular ? 'border-primary' : '' }}" 
                     style="{{ $plan->is_popular ? 'border: 2px solid var(--primary-color) !important;' : '' }}">
                    @if($plan->is_popular)
                        <div class="badge bg-primary position-absolute top-0 start-50 translate-middle">
                            Most Popular
                        </div>
                    @endif
                    
                    <div class="card-body p-4 text-center">
                        <h4 class="mb-3">{{ $plan->name }}</h4>
                        <p class="text-muted mb-4">{{ $plan->description }}</p>
                        
                        <div class="mb-4">
                            <h2 class="fw-bold mb-0">{{ $plan->formatted_price_monthly }}</h2>
                            <small class="text-muted">per month</small>
                            <p class="text-muted small mt-2">
                                or {{ $plan->formatted_price_annual }} annually
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
                        </ul>

                        @auth
                            <a href="{{ route('billing.checkout', ['plan' => $plan->id, 'cycle' => 'monthly']) }}" 
                               class="btn {{ $plan->is_popular ? 'btn-primary' : 'btn-outline-primary' }} w-100">
                                Select Plan
                            </a>
                        @else
                            <a href="{{ route('register') }}" 
                               class="btn {{ $plan->is_popular ? 'btn-primary' : 'btn-outline-primary' }} w-100">
                                Get Started
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-5">
        <p class="text-muted">All plans include basic support and property analytics</p>
        <p class="text-muted">Need a custom plan? <a href="mailto:sales@propertieslafrique.com">Contact us</a></p>
    </div>
</div>
@endsection
