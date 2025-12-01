@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div class="flex-grow-1">
                        <h3 class="mb-2 fw-bold">Welcome back, {{ auth()->user()->name }}! 👋</h3>
                        <p class="mb-3 opacity-75">Here's what's happening with your properties today.</p>
                        <a href="{{ route('home') }}" target="_blank" class="btn btn-light btn-sm">
                            <i class="fas fa-external-link-alt me-2"></i>View Website
                        </a>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-chart-line" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Stats Cards -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-semibold" style="font-size: 0.875rem;">Total Listings</p>
                    <h2 class="mb-0 fw-bold" style="color: #1e293b;">{{ $stats['total_listings'] }}</h2>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>All time</small>
                </div>
                <div class="fs-1 text-primary" style="opacity: 0.8;">
                    <i class="fas fa-home"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-semibold" style="font-size: 0.875rem;">Active Listings</p>
                    <h2 class="mb-0 fw-bold" style="color: #1e293b;">{{ $stats['active_listings'] }}</h2>
                    <small class="text-success"><i class="fas fa-check me-1"></i>Published</small>
                </div>
                <div class="fs-1 text-success" style="opacity: 0.8;">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-semibold" style="font-size: 0.875rem;">Pending Approval</p>
                    <h2 class="mb-0 fw-bold" style="color: #1e293b;">{{ $stats['pending_listings'] }}</h2>
                    <small class="text-warning"><i class="fas fa-clock me-1"></i>In review</small>
                </div>
                <div class="fs-1 text-warning" style="opacity: 0.8;">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-semibold" style="font-size: 0.875rem;">New Inquiries</p>
                    <h2 class="mb-0 fw-bold" style="color: #1e293b;">{{ $stats['new_inquiries'] }}</h2>
                    <small class="text-info"><i class="fas fa-envelope me-1"></i>Unread</small>
                </div>
                <div class="fs-1 text-info" style="opacity: 0.8;">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Properties -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm animate-fade-in">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold">Your Recent Properties</h5>
                        <p class="text-muted small mb-0">Manage and track your listings</p>
                    </div>
                    <a href="{{ route(auth()->user()->role . '.properties.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i>Add New
                    </a>
                </div>
            </div>
            <div class="card-body">
                @forelse($properties as $property)
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <div class="me-3">
                            @if($property->primaryImage)
                                <img src="{{ $property->primaryImage->url }}" alt="{{ $property->title }}" 
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div style="width: 80px; height: 80px; background: #e2e8f0; border-radius: 8px;"></div>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $property->title }}</h6>
                            <p class="text-muted small mb-1">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $property->location->name ?? 'N/A' }}
                            </p>
                            <div class="d-flex gap-2">
                                @if($property->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                                <span class="badge bg-secondary">{{ ucfirst($property->property_type) }}</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <p class="fw-bold text-primary mb-2">{{ $property->formatted_price }}</p>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-outline-primary" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route(auth()->user()->role . '.properties.edit', $property) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-home fs-1 text-muted mb-3"></i>
                        <p class="text-muted">No properties yet. Start by adding your first property!</p>
                        <a href="{{ route(auth()->user()->role . '.properties.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add Property
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Inquiries -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm animate-fade-in">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold">Recent Inquiries</h5>
                        <p class="text-muted small mb-0">Latest messages</p>
                    </div>
                    <a href="{{ route(auth()->user()->role . '.inquiries.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
            </div>
            <div class="card-body">
                @forelse($recentInquiries as $inquiry)
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="mb-0">{{ $inquiry->name }}</h6>
                            @if($inquiry->status === 'new')
                                <span class="badge bg-primary">New</span>
                            @elseif($inquiry->status === 'read')
                                <span class="badge bg-info">Read</span>
                            @elseif($inquiry->status === 'responded')
                                <span class="badge bg-success">Responded</span>
                            @endif
                        </div>
                        <p class="text-muted small mb-1">{{ Str::limit($inquiry->property->title, 30) }}</p>
                        <p class="small mb-1">{{ Str::limit($inquiry->message, 60) }}</p>
                        <small class="text-muted">{{ $inquiry->created_at->diffForHumans() }}</small>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="fas fa-envelope fs-3 text-muted mb-2"></i>
                        <p class="text-muted small mb-0">No inquiries yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="card border-0 shadow-sm mt-4 animate-fade-in">
            <div class="card-body">
                <h6 class="mb-3 fw-bold">Quick Stats</h6>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Views</span>
                    <span class="fw-bold">{{ number_format($totalViews) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Inquiries</span>
                    <span class="fw-bold">{{ $stats['total_inquiries'] }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Response Rate</span>
                    <span class="fw-bold">
                        @if($stats['total_inquiries'] > 0)
                            {{ round(($stats['total_inquiries'] - $stats['new_inquiries']) / $stats['total_inquiries'] * 100) }}%
                        @else
                            0%
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
