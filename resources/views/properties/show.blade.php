@extends('layouts.public')

@section('title', $property->title)

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Image Gallery -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                    @if($property->images->count() > 0)
                        <div id="propertyGallery" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($property->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $image->url }}" class="d-block w-100" alt="{{ $property->title }}" style="height: 500px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            @if($property->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#propertyGallery" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#propertyGallery" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    @else
                        <img src="https://via.placeholder.com/800x500?text=No+Image" class="w-100" alt="{{ $property->title }}">
                    @endif
                </div>
            </div>

            <!-- YouTube Video -->
            @if($property->youtube_embed_url)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe 
                            src="{{ $property->youtube_embed_url }}" 
                            title="Property Video Tour" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                            style="border-radius: 8px;">
                        </iframe>
                    </div>
                    <div class="p-3 bg-light">
                        <h6 class="mb-0">
                            <i class="fab fa-youtube text-danger me-2"></i>
                            Property Video Tour
                        </h6>
                    </div>
                </div>
            </div>
            @endif

            <!-- Property Details -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="fw-bold mb-2">{{ $property->title }}</h2>
                            <p class="text-muted mb-0">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $property->location->name ?? 'N/A' }}, {{ $property->location->city ?? '' }}
                            </p>
                        </div>
                        @if($property->is_featured)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star me-1"></i>Featured
                            </span>
                        @endif
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <h3 class="text-primary fw-bold mb-0">{{ $property->formatted_price }}</h3>
                        <span class="badge bg-secondary align-self-center">{{ ucfirst($property->property_type) }}</span>
                    </div>

                    <!-- Key Features -->
                    <div class="row g-3 mb-4">
                        @if($property->bedrooms)
                            <div class="col-md-3">
                                <div class="stat-card text-center">
                                    <i class="fas fa-bed fs-3 text-primary mb-2"></i>
                                    <h5 class="mb-0">{{ $property->bedrooms }}</h5>
                                    <small class="text-muted">Bedrooms</small>
                                </div>
                            </div>
                        @endif
                        @if($property->bathrooms)
                            <div class="col-md-3">
                                <div class="stat-card text-center">
                                    <i class="fas fa-bath fs-3 text-primary mb-2"></i>
                                    <h5 class="mb-0">{{ $property->bathrooms }}</h5>
                                    <small class="text-muted">Bathrooms</small>
                                </div>
                            </div>
                        @endif
                        @if($property->land_size)
                            <div class="col-md-3">
                                <div class="stat-card text-center">
                                    <i class="fas fa-ruler-combined fs-3 text-primary mb-2"></i>
                                    <h5 class="mb-0">{{ $property->land_size }}</h5>
                                    <small class="text-muted">{{ $property->land_size_unit }}</small>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-3">
                            <div class="stat-card text-center">
                                <i class="fas fa-eye fs-3 text-primary mb-2"></i>
                                <h5 class="mb-0">{{ number_format($property->views_count) }}</h5>
                                <small class="text-muted">Views</small>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description" type="button">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#amenities" type="button">Amenities</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#details" type="button">Details</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description">
                            <p>{{ $property->description }}</p>
                        </div>

                        <!-- Amenities Tab -->
                        <div class="tab-pane fade" id="amenities">
                            @if($property->amenities->count() > 0)
                                <div class="row g-3">
                                    @foreach($property->amenities as $amenity)
                                        <div class="col-md-6">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            {{ $amenity->name }}
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">No amenities listed</p>
                            @endif
                        </div>

                        <!-- Details Tab -->
                        <div class="tab-pane fade" id="details">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th width="200">Property Type</th>
                                        <td>{{ ucfirst($property->property_type) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ $property->category->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td>{{ $property->location->name ?? 'N/A' }}, {{ $property->location->city ?? '' }}</td>
                                    </tr>
                                    @if($property->bedrooms)
                                        <tr>
                                            <th>Bedrooms</th>
                                            <td>{{ $property->bedrooms }}</td>
                                        </tr>
                                    @endif
                                    @if($property->bathrooms)
                                        <tr>
                                            <th>Bathrooms</th>
                                            <td>{{ $property->bathrooms }}</td>
                                        </tr>
                                    @endif
                                    @if($property->land_size)
                                        <tr>
                                            <th>Land Size</th>
                                            <td>{{ $property->land_size }} {{ $property->land_size_unit }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Availability</th>
                                        <td>
                                            <span class="badge bg-{{ $property->availability === 'available' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($property->availability) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Listed On</th>
                                        <td>{{ $property->created_at->format('F j, Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Inquiry Form -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Interested in this property?</h5>
                    <button type="button" class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                        <i class="fas fa-envelope me-2"></i>Send Inquiry
                    </button>
                </div>
            </div>

            <!-- Agent/Owner Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Listed By</h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $property->user->name }}</h6>
                            <small class="text-muted">{{ ucfirst($property->user->role) }}</small>
                        </div>
                    </div>
                    <p class="text-muted small mb-2">
                        <i class="fas fa-envelope me-2"></i>{{ $property->user->email }}
                    </p>
                    @if($property->user->phone)
                        <p class="text-muted small mb-0">
                            <i class="fas fa-phone me-2"></i>{{ $property->user->phone }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Share -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Share this property</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-primary btn-sm flex-grow-1">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-info btn-sm flex-grow-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-success btn-sm flex-grow-1">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm flex-grow-1">
                            <i class="fas fa-link"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inquiry Modal -->
<div class="modal fade" id="inquiryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Inquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="inquiry-form" action="{{ route('inquiries.store') }}" method="POST">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Your Name *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="tel" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message *</label>
                        <textarea name="message" class="form-control" rows="4" required>I'm interested in this property. Please contact me with more details.</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send Inquiry</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
