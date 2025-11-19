@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>User Details</h2>
                <div>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit User
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Properties</h6>
                            <h3 class="mb-0">{{ number_format($stats['total_properties']) }}</h3>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-building fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Published Properties</h6>
                            <h3 class="mb-0">{{ number_format($stats['published_properties']) }}</h3>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Inquiries</h6>
                            <h3 class="mb-0">{{ number_format($stats['total_inquiries']) }}</h3>
                        </div>
                        <div class="text-info">
                            <i class="fas fa-envelope fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Information -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">User Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th width="150">Name:</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Role:</th>
                                <td><span class="badge bg-primary">{{ ucfirst($user->role) }}</span></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Email Verified:</th>
                                <td>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">Yes</span>
                                        <small class="text-muted">({{ $user->email_verified_at->format('M d, Y') }})</small>
                                    @else
                                        <span class="badge bg-warning">No</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Joined:</th>
                                <td>{{ $user->created_at->format('F j, Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Subscriptions -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Subscriptions</h5>
                </div>
                <div class="card-body">
                    @if($user->subscriptions->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($user->subscriptions as $subscription)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $subscription->plan->name ?? 'N/A' }}</h6>
                                            <small class="text-muted">
                                                {{ $subscription->start_date->format('M d, Y') }} - 
                                                {{ $subscription->end_date->format('M d, Y') }}
                                            </small>
                                        </div>
                                        <span class="badge bg-{{ $subscription->is_active ? 'success' : 'secondary' }}">
                                            {{ $subscription->is_active ? 'Active' : 'Expired' }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">No active subscriptions</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- User Properties -->
    @if($user->properties->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Properties</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->properties as $property)
                                <tr>
                                    <td>{{ $property->title }}</td>
                                    <td>{{ ucfirst($property->property_type) }}</td>
                                    <td>{{ $property->formatted_price }}</td>
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
    </div>
    @endif
</div>
@endsection
