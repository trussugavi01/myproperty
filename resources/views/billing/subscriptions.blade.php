@extends('layouts.app')

@section('title', 'My Subscriptions')
@section('page-title', 'Manage Subscriptions')

@section('content')
<div class="row">
    <div class="col-12">
        @if($activeSubscription)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Active Subscription</h5>
                </div>
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
                                    <strong>{{ $activeSubscription->formatted_amount }}</strong>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted d-block">Status</small>
                                    <span class="badge bg-success">{{ ucfirst($activeSubscription->status) }}</span>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Started On</small>
                                    <strong>{{ $activeSubscription->starts_at->format('F j, Y') }}</strong>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Renews On</small>
                                    <strong>{{ $activeSubscription->ends_at->format('F j, Y') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <form method="POST" action="{{ route('billing.subscriptions.cancel', $activeSubscription) }}" 
                                  onsubmit="return confirm('Are you sure you want to cancel your subscription?')">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-times me-2"></i>Cancel Subscription
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
