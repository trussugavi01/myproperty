@extends('layouts.app')

@section('title', 'Revenue Report')
@section('page-title', 'Revenue Report')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h3 class="mb-2 fw-bold">Revenue Report 💰</h3>
                        <p class="mb-0 opacity-75">Comprehensive financial analytics including revenue, transactions, payment methods, and trends.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-money-bill-wave" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Bar -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Reports
            </a>
            <form method="GET" class="d-inline">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="fas fa-calendar-alt text-success"></i>
                    </span>
                    <select name="period" class="form-select" style="min-width: 200px;" onchange="this.form.submit()">
                        <option value="7days" {{ $period == '7days' ? 'selected' : '' }}>Last 7 Days</option>
                        <option value="30days" {{ $period == '30days' ? 'selected' : '' }}>Last 30 Days</option>
                        <option value="90days" {{ $period == '90days' ? 'selected' : '' }}>Last 90 Days</option>
                        <option value="1year" {{ $period == '1year' ? 'selected' : '' }}>Last Year</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="fas fa-dollar-sign text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Total Revenue</h6>
                            <h3 class="mb-0 fw-bold text-success">₦{{ number_format($stats['total_revenue'], 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-receipt text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Transactions</h6>
                            <h3 class="mb-0 fw-bold">{{ number_format($stats['total_transactions']) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="fas fa-hourglass-half text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Pending Payments</h6>
                            <h3 class="mb-0 fw-bold text-warning">₦{{ number_format($stats['pending_payments'], 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                            <i class="fas fa-chart-line text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Avg Transaction</h6>
                            <h3 class="mb-0 fw-bold text-info">₦{{ number_format($stats['avg_transaction'] ?? 0, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-credit-card me-2 text-success"></i>Revenue by Payment Method
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="methodChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-bar me-2 text-success"></i>Daily Revenue Trend
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Method Chart
    const methodLabels = {!! json_encode($revenueByMethod->pluck('payment_method')) !!};
    const methodData = {!! json_encode($revenueByMethod->pluck('total')) !!};
    
    new Chart(document.getElementById('methodChart'), {
        type: 'doughnut',
        data: {
            labels: methodLabels.length > 0 ? methodLabels : ['No Data'],
            datasets: [{
                data: methodData.length > 0 ? methodData : [1],
                backgroundColor: methodData.length > 0 ? ['#10b981', '#3b82f6', '#f59e0b', '#ef4444'] : ['#e5e7eb']
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: methodData.length > 0
                }
            }
        }
    });

    // Trend Chart
    const trendLabels = {!! json_encode($dailyTrend->pluck('date')) !!};
    const trendData = {!! json_encode($dailyTrend->pluck('total')) !!};
    
    new Chart(document.getElementById('trendChart'), {
        type: 'bar',
        data: {
            labels: trendLabels.length > 0 ? trendLabels : ['No Data'],
            datasets: [{
                label: 'Revenue (₦)',
                data: trendData.length > 0 ? trendData : [0],
                backgroundColor: 'rgba(16, 185, 129, 0.5)',
                borderColor: 'rgb(16, 185, 129)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
@endsection
