@extends('layouts.app')

@section('title', 'Checkout')
@section('page-title', 'Complete Your Purchase')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0">Order Summary</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-1">{{ $plan->name }} Plan</h5>
                        <p class="text-muted mb-0">{{ ucfirst($cycle) }} billing</p>
                    </div>
                    <h4 class="mb-0">{{ $cycle === 'monthly' ? $plan->formatted_price_monthly : $plan->formatted_price_annual }}</h4>
                </div>

                <hr>

                <div class="mb-3">
                    <h6>Plan Features:</h6>
                    <ul class="list-unstyled">
                        @if($plan->features)
                            @foreach(json_decode($plan->features) as $feature)
                                <li class="mb-1">
                                    <i class="fas fa-check text-success me-2"></i>{{ $feature }}
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>{{ $cycle === 'monthly' ? $plan->formatted_price_monthly : $plan->formatted_price_annual }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>VAT (7.5%)</span>
                    <span>₦{{ number_format($amount * 0.075, 2) }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong class="text-primary">₦{{ number_format($amount * 1.075, 2) }}</strong>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0">Payment Method</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('billing.subscribe') }}">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <input type="hidden" name="billing_cycle" value="{{ $cycle }}">

                    <div class="mb-4">
                        <label class="form-label">Select Payment Method</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="card" value="card" checked>
                            <label class="form-check-label" for="card">
                                <i class="fas fa-credit-card me-2"></i>Credit/Debit Card
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer">
                            <label class="form-check-label" for="bank_transfer">
                                <i class="fas fa-university me-2"></i>Bank Transfer
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="scan_to_pay" value="scan_to_pay">
                            <label class="form-check-label" for="scan_to_pay">
                                <i class="fas fa-qrcode me-2"></i>Scan to Pay
                            </label>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>This is a demo checkout. In production, this would integrate with Paystack or Flutterwave.</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-lock me-2"></i>Complete Payment
                        </button>
                        <a href="{{ route('billing.plans') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
