@extends('layouts.app')

@section('title', 'My Subscriptions')
@section('page-title', 'Manage Subscriptions')

@section('content')
<div class="row">
    <div class="col-12">
        @if($activeSubscription)
            <div class="card border-0 shadow-sm mb-4 {{ $activeSubscription->is_trial ? 'border-success' : '' }}" 
                 style="{{ $activeSubscription->is_trial ? 'border: 2px solid #198754 !important;' : '' }} border-radius: 16px;">
                @if($activeSubscription->is_trial)
                    <div class="card-header bg-success text-white border-0 py-3" style="border-radius: 14px 14px 0 0;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-gift me-2"></i>Free Trial Active</h5>
                            <span class="badge bg-white text-success">{{ $activeSubscription->trialDaysRemaining() }} days remaining</span>
                        </div>
                    </div>
                @else
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">Active Subscription</h5>
                    </div>
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="mb-2">{{ $activeSubscription->plan->name }} Plan</h4>
                            <p class="text-muted mb-3">{{ $activeSubscription->plan->description }}</p>
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <small class="text-muted d-block">Billing Cycle</small>
                                    <strong>{{ ucfirst($activeSubscription->billing_cycle) }}</strong>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted d-block">Amount</small>
                                    @if($activeSubscription->is_trial)
                                        <strong class="text-success">FREE (Trial)</strong>
                                    @else
                                        <strong>₦{{ number_format($activeSubscription->amount, 2) }}</strong>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted d-block">Status</small>
                                    @if($activeSubscription->is_trial)
                                        <span class="badge bg-success">Trial Active</span>
                                    @else
                                        <span class="badge bg-success">{{ ucfirst($activeSubscription->status) }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Started On</small>
                                    <strong>{{ $activeSubscription->starts_at->format('F j, Y') }}</strong>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted d-block">{{ $activeSubscription->is_trial ? 'Trial Ends On' : 'Renews On' }}</small>
                                    <strong>{{ $activeSubscription->ends_at->format('F j, Y') }}</strong>
                                </div>
                            </div>

                            @if($activeSubscription->is_trial)
                                <div class="alert alert-warning mt-3 mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Your trial will end on {{ $activeSubscription->trial_ends_at->format('F j, Y') }}. 
                                    <a href="{{ route('billing.plans') }}" class="alert-link">Upgrade now</a> to continue using all features.
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 text-end">
                            @if($activeSubscription->is_trial)
                                <a href="{{ route('billing.checkout', ['plan' => $activeSubscription->plan->id, 'cycle' => $activeSubscription->billing_cycle]) }}" 
                                   class="btn btn-success mb-2">
                                    <i class="fas fa-arrow-up me-2"></i>Upgrade Now
                                </a>
                            @endif
                            <form method="POST" action="{{ route('billing.subscriptions.cancel', $activeSubscription) }}" 
                                  onsubmit="return confirm('Are you sure you want to cancel your subscription?')">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-times me-2"></i>Cancel {{ $activeSubscription->is_trial ? 'Trial' : 'Subscription' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                <h5 class="alert-heading">
                    <i class="fas fa-info-circle me-2"></i>No Active Subscription
                </h5>
                <p class="mb-0">You don't have an active subscription. Browse our plans to get started.</p>
                <hr>
                <a href="{{ route('billing.plans') }}" class="btn btn-primary">
                    <i class="fas fa-star me-2"></i>View Plans
                </a>
            </div>
        @endif

        <!-- Payment History -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0">Payment History</h5>
            </div>
            <div class="card-body">
                @if($payments->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Reference</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->created_at->format('M j, Y') }}</td>
                                        <td><code>{{ $payment->transaction_reference }}</code></td>
                                        <td>{{ $payment->subscription->plan->name ?? 'N/A' }}</td>
                                        <td>{{ $payment->formatted_amount }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $payment->status === 'completed' ? 'success' : ($payment->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($payments->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $payments->links() }}
                        </div>
                    @endif
                @else
                    <p class="text-muted text-center py-4">No payment history available</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
