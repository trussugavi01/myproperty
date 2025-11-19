@extends('layouts.app')

@section('title', 'Property Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Property Details</h2>
                <div>
                    @if(!$property->is_published)
                        <form action="{{ route('admin.listings.approve', $property) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check me-2"></i>Approve
                            </button>
                        </form>
                        <button type="button" class="btn btn-danger" 
                                data-bs-toggle="modal" data-bs-target="#rejectModal">
                            <i class="fas fa-times me-2"></i>Reject
                        </button>
                    @endif
                    <a href="{{ route('admin.listings.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Property Images -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    @if($property->images->count() > 0)
                        <div id="propertyGallery" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($property->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $image->url }}" class="d-block w-100" 
                                             alt="{{ $property->title }}" 
                                             style="height: 500px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            @if($property->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#propertyGallery" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#propertyGallery" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>
                    @else
                        <img src="https://via.placeholder.com/800x500?text=No+Image" class="w-100" alt="No Image">
                    @endif
                </div>
            </div>

            <!-- Property Details -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Property Information</h5>
                </div>
                <div class="card-body">
                    <h3 class="mb-3">{{ $property->title }}</h3>
                    <p class="text-muted mb-4">{{ $property->description }}</p>

                    <div class="row mb-3">
                        @if($property->bedrooms)
                            <div class="col-md-3 mb-2">
                                <i class="fas fa-bed text-primary me-2"></i>
                                <strong>{{ $property->bedrooms }}</strong> Bedrooms
                            </div>
                        @endif
                        @if($property->bathrooms)
                            <div class="col-md-3 mb-2">
                                <i class="fas fa-bath text-primary me-2"></i>
                                <strong>{{ $property->bathrooms }}</strong> Bathrooms
                            </div>
                        @endif
                        @if($property->land_size)
                            <div class="col-md-3 mb-2">
                                <i class="fas fa-ruler-combined text-primary me-2"></i>
                                <strong>{{ $property->land_size }}</strong> {{ $property->land_size_unit }}
                            </div>
                        @endif
                        <div class="col-md-3 mb-2">
                            <i class="fas fa-eye text-primary me-2"></i>
                            <strong>{{ number_format($property->views_count) }}</strong> Views
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Amenities</h5>
                    @if($property->amenities->count() > 0)
                        <div class="row">
                            @foreach($property->amenities as $amenity)
                                <div class="col-md-6 mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    {{ $amenity->name }}
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No amenities listed</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Status Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Status</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Published:</th>
                                <td>
                                    @if($property->is_published)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Featured:</th>
                                <td>
                                    <form action="{{ route('admin.listings.feature', $property) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-{{ $property->is_featured ? 'warning' : 'outline-warning' }}">
                                            <i class="fas fa-star"></i>
                                            {{ $property->is_featured ? 'Featured' : 'Not Featured' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th>Availability:</th>
                                <td>
                                    <span class="badge bg-{{ $property->availability === 'available' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($property->availability) }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Details Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Details</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Type:</th>
                                <td>{{ ucfirst($property->property_type) }}</td>
                            </tr>
                            <tr>
                                <th>Category:</th>
                                <td>{{ $property->category->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Price:</th>
                                <td><strong>{{ $property->formatted_price }}</strong></td>
                            </tr>
                            <tr>
                                <th>Location:</th>
                                <td>{{ $property->location->name ?? 'N/A' }}, {{ $property->location->city ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{ $property->address }}</td>
                            </tr>
                            <tr>
                                <th>Created:</th>
                                <td>{{ $property->created_at->format('M d, Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Owner Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Owner</h5>
                </div>
                <div class="card-body">
                    <h6>{{ $property->user->name }}</h6>
                    <p class="mb-1">
                        <small class="text-muted">
                            <i class="fas fa-envelope me-1"></i>{{ $property->user->email }}
                        </small>
                    </p>
                    @if($property->user->phone)
                        <p class="mb-1">
                            <small class="text-muted">
                                <i class="fas fa-phone me-1"></i>{{ $property->user->phone }}
                            </small>
                        </p>
                    @endif
                    <p class="mb-0">
                        <span class="badge bg-primary">{{ ucfirst($property->user->role) }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.listings.reject', $property) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <p>Are you sure you want to reject this property?</p>
                    <div class="mb-3">
                        <label for="rejection_notes" class="form-label">Rejection Notes *</label>
                        <textarea name="rejection_notes" class="form-control" 
                                  rows="4" required 
                                  placeholder="Provide a reason for rejection..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject Property</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
