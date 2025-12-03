@extends('layouts.app')

@section('title', 'Checkout')
@section('page-title', 'Complete Your Purchase')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        @if($trialDays > 0 && !$hasUsedTrial)
            <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-gift fa-2x text-success"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading mb-1">🎉 Start Your {{ $trialDays }}-Day Free Trial!</h5>
                        <p class="mb-0">Try all {{ $plan->name }} features free for {{ $trialDays }} days. No payment required to start!</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0">Order Summary</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-1">{{ $plan->name }} Plan</h5>
                        <p class="text-muted mb-0">{{ ucfirst($billingCycle) }} billing</p>
                    </div>
                    <h4 class="mb-0">{{ $billingCycle === 'monthly' ? $plan->formatted_price_monthly : $plan->formatted_price_annual }}</h4>
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
                    <span>{{ $billingCycle === 'monthly' ? $plan->formatted_price_monthly : $plan->formatted_price_annual }}</span>
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

        @if($trialDays > 0 && !$hasUsedTrial)
            <div class="card border-0 shadow-sm mb-4" style="border: 2px solid #198754 !important; border-radius: 16px;">
                <div class="card-header bg-success text-white border-0 py-3" style="border-radius: 14px 14px 0 0;">
                    <h5 class="mb-0"><i class="fas fa-gift me-2"></i>Start Free Trial</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('billing.subscribe') }}">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                        <input type="hidden" name="billing_cycle" value="{{ $billingCycle }}">
                        <input type="hidden" name="payment_method" value="trial">

                        <div class="text-center mb-4">
                            <i class="fas fa-rocket fa-3x text-success mb-3"></i>
                            <h4>Try {{ $plan->name }} Free for {{ $trialDays }} Days</h4>
                            <p class="text-muted">No credit card required. Cancel anytime.</p>
                            <ul class="list-unstyled text-start mx-auto" style="max-width: 300px;">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Full access to all features</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>No payment required now</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Reminder before trial ends</li>
                            </ul>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-play me-2"></i>Start {{ $trialDays }}-Day Free Trial
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mb-4">
                <span class="text-muted">— OR pay now and skip the trial —</span>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0">Payment Method</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('billing.subscribe') }}">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <input type="hidden" name="billing_cycle" value="{{ $billingCycle }}">

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
                            <i class="fas fa-lock me-2"></i>Complete Payment - ₦{{ number_format($amount * 1.075, 2) }}
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
