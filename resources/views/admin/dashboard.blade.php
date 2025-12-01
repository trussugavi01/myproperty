@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div class="flex-grow-1">
                        <h3 class="mb-2 fw-bold">Admin Control Center 🎯</h3>
                        <p class="mb-3 opacity-75">Monitor and manage the entire platform from here.</p>
                        <a href="{{ route('home') }}" target="_blank" class="btn btn-light btn-sm">
                            <i class="fas fa-external-link-alt me-2"></i>View Website
                        </a>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-shield-alt" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.875rem;">Total Users</p>
                        <h2 class="mb-0 fw-bold" style="color: #1e293b;">{{ number_format($stats['total_users']) }}</h2>
                        <small class="text-primary"><i class="fas fa-users me-1"></i>Registered</small>
                    </div>
                    <div class="fs-1 text-primary" style="opacity: 0.8;">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.875rem;">Total Properties</p>
                        <h2 class="mb-0 fw-bold" style="color: #1e293b;">{{ number_format($stats['total_properties']) }}</h2>
                        <small class="text-success"><i class="fas fa-building me-1"></i>Listings</small>
                    </div>
                    <div class="fs-1 text-success" style="opacity: 0.8;">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.875rem;">Pending Approvals</p>
                        <h2 class="mb-0 fw-bold" style="color: #1e293b;">{{ number_format($stats['pending_approvals']) }}</h2>
                        <small class="text-warning"><i class="fas fa-clock me-1"></i>Awaiting review</small>
                    </div>
                    <div class="fs-1 text-warning" style="opacity: 0.8;">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.875rem;">Total Inquiries</p>
                        <h2 class="mb-0 fw-bold" style="color: #1e293b;">{{ number_format($stats['total_inquiries']) }}</h2>
                        <small class="text-info"><i class="fas fa-envelope me-1"></i>All time</small>
                    </div>
                    <div class="fs-1 text-info" style="opacity: 0.8;">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.875rem;">New Inquiries</p>
                        <h2 class="mb-0 fw-bold" style="color: #1e293b;">{{ number_format($stats['new_inquiries']) }}</h2>
                        <small class="text-danger"><i class="fas fa-bell me-1"></i>Unread</small>
                    </div>
                    <div class="fs-1 text-danger" style="opacity: 0.8;">
                        <i class="fas fa-bell"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold" style="font-size: 0.875rem;">Total Revenue</p>
                        <h2 class="mb-0 fw-bold" style="color: #1e293b;">₦{{ number_format($stats['total_revenue'], 2) }}</h2>
                        <small class="text-success"><i class="fas fa-money-bill-wave me-1"></i>Earnings</small>
                    </div>
                    <div class="fs-1 text-success" style="opacity: 0.8;">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm animate-fade-in">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">Monthly Listings</h5>
                    <p class="text-muted small mb-0">Property submissions over time</p>
                </div>
                <div class="card-body">
                    <canvas id="listingsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm animate-fade-in">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">Monthly Inquiries</h5>
                    <p class="text-muted small mb-0">User engagement trends</p>
                </div>
                <div class="card-body">
                    <canvas id="inquiriesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Approvals -->
    @if($pendingApprovals->count() > 0)
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm animate-fade-in">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold">Pending Approvals</h5>
                        <p class="text-muted small mb-0">Properties awaiting your review</p>
                    </div>
                    <a href="{{ route('admin.listings.pending') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Owner</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Submitted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingApprovals as $property)
                                <tr>
                                    <td>{{ $property->title }}</td>
                                    <td>{{ $property->user->name }}</td>
                                    <td>{{ $property->location->name ?? 'N/A' }}</td>
                                    <td>{{ $property->formatted_price }}</td>
                                    <td>{{ $property->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('admin.listings.show', $property) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Properties and Users -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm animate-fade-in">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">Recent Properties</h5>
                    <p class="text-muted small mb-0">Latest property submissions</p>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Owner</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentProperties as $property)
                                <tr>
                                    <td>{{ Str::limit($property->title, 30) }}</td>
                                    <td>{{ $property->user->name }}</td>
                                    <td>
                                        <span class="badge bg-{{ $property->is_published ? 'success' : 'warning' }}">
                                            {{ $property->is_published ? 'Published' : 'Pending' }}
                                        </span>
                                    </td>
                                    <td>{{ $property->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm animate-fade-in">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">Recent Users</h5>
                    <p class="text-muted small mb-0">New registrations</p>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Listings Chart
    const listingsCtx = document.getElementById('listingsChart').getContext('2d');
    new Chart(listingsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyListings->pluck('month')) !!},
            datasets: [{
                label: 'Properties',
                data: {!! json_encode($monthlyListings->pluck('count')) !!},
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });

    // Inquiries Chart
    const inquiriesCtx = document.getElementById('inquiriesChart').getContext('2d');
    new Chart(inquiriesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyInquiries->pluck('month')) !!},
            datasets: [{
                label: 'Inquiries',
                data: {!! json_encode($monthlyInquiries->pluck('count')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });
</script>
@endpush
@endsection
