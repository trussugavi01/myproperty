@extends('layouts.app')

@section('title', 'Listings Report')
@section('page-title', 'Listings Report')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h3 class="mb-2 fw-bold">Listings Report 🏢</h3>
                        <p class="mb-0 opacity-75">Comprehensive analytics on property listings, types, categories, and performance trends.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-building" style="font-size: 4rem; opacity: 0.2;"></i>
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
                        <i class="fas fa-calendar-alt text-primary"></i>
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
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-list text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Total Listings</h6>
                            <h3 class="mb-0 fw-bold">{{ number_format($stats['total_listings']) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="fas fa-check-circle text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Published</h6>
                            <h3 class="mb-0 fw-bold text-success">{{ number_format($stats['published_listings']) }}</h3>
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
                            <i class="fas fa-clock text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Pending</h6>
                            <h3 class="mb-0 fw-bold text-warning">{{ number_format($stats['pending_listings']) }}</h3>
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
                            <i class="fas fa-eye text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Total Views</h6>
                            <h3 class="mb-0 fw-bold text-info">{{ number_format($stats['total_views']) }}</h3>
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
                        <i class="fas fa-chart-pie me-2 text-primary"></i>Listings by Type
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="typeChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-tags me-2 text-primary"></i>Listings by Category
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Daily Trend -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-line me-2 text-primary"></i>Daily Listings Trend
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
    // Type Chart
    new Chart(document.getElementById('typeChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($listingsByType->pluck('property_type')) !!},
            datasets: [{
                data: {!! json_encode($listingsByType->pluck('count')) !!},
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
            }]
        }
    });

    // Category Chart
    new Chart(document.getElementById('categoryChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($listingsByCategory->pluck('name')) !!},
            datasets: [{
                data: {!! json_encode($listingsByCategory->pluck('count')) !!},
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
            }]
        }
    });

    // Trend Chart
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($dailyTrend->pluck('date')) !!},
            datasets: [{
                label: 'Listings',
                data: {!! json_encode($dailyTrend->pluck('count')) !!},
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        }
    });
</script>
@endpush
@endsection
