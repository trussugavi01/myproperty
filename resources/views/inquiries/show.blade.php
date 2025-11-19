@extends('layouts.app')

@section('title', 'Inquiry Details')
@section('page-title', 'Inquiry Details')

@section('content')
<!-- Back Button -->
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route(auth()->user()->role . '.inquiries.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Inquiries
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4 animate-fade-in">
            <div class="card-header border-0 py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h5 class="mb-1 fw-bold"><i class="fas fa-envelope-open-text me-2"></i>Inquiry from {{ $inquiry->name }}</h5>
                        <small class="opacity-75">Received {{ $inquiry->created_at->diffForHumans() }}</small>
                    </div>
                    @if($inquiry->status === 'new')
                        <span class="badge bg-white text-primary px-3 py-2"><i class="fas fa-star me-1"></i>New</span>
                    @elseif($inquiry->status === 'read')
                        <span class="badge bg-white text-info px-3 py-2"><i class="fas fa-eye me-1"></i>Read</span>
                    @elseif($inquiry->status === 'responded')
                        <span class="badge bg-white text-success px-3 py-2"><i class="fas fa-check me-1"></i>Responded</span>
                    @else
                        <span class="badge bg-white text-secondary px-3 py-2">Archived</span>
                    @endif
                </div>
            </div>
            <div class="card-body p-4">
                <div class="mb-4 p-3" style="background: #f8fafc; border-radius: 12px; border-left: 4px solid var(--bs-primary);">
                    <h6 class="fw-bold mb-3"><i class="fas fa-user-circle me-2 text-primary"></i>Contact Information</h6>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <small class="text-muted d-block">Full Name</small>
                            <p class="mb-0 fw-semibold">{{ $inquiry->name }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <small class="text-muted d-block">Email Address</small>
                            <p class="mb-0">
                                <a href="mailto:{{ $inquiry->email }}" class="text-decoration-none fw-semibold">
                                    <i class="fas fa-envelope me-1"></i>{{ $inquiry->email }}
                                </a>
                            </p>
                        </div>
                        @if($inquiry->phone)
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">Phone Number</small>
                                <p class="mb-0">
                                    <a href="tel:{{ $inquiry->phone }}" class="text-decoration-none fw-semibold">
                                        <i class="fas fa-phone me-1"></i>{{ $inquiry->phone }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        <div class="col-md-6 mb-2">
                            <small class="text-muted d-block">Inquiry Date</small>
                            <p class="mb-0 fw-semibold"><i class="fas fa-calendar me-1"></i>{{ $inquiry->created_at->format('F j, Y g:i A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-comment-dots me-2 text-success"></i>Message</h6>
                    <div class="p-3" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px;">
                        <p class="mb-0" style="line-height: 1.8;">{{ $inquiry->message }}</p>
                    </div>
                </div>

                @if($inquiry->status !== 'responded')
                    <div class="d-flex gap-2">
                        <form method="POST" action="{{ route(auth()->user()->role . '.inquiries.respond', $inquiry) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-lg px-4">
                                <i class="fas fa-check me-2"></i>Mark as Responded
                            </button>
                        </form>
                        <a href="mailto:{{ $inquiry->email }}" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-reply me-2"></i>Reply via Email
                        </a>
                    </div>
                @else
                    <div class="alert alert-success border-0 shadow-sm" style="border-radius: 12px;">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-check-circle fs-2"></i>
                            </div>
                            <div>
                                <h6 class="alert-heading mb-1">Inquiry Responded</h6>
                                <p class="mb-0">
                                    This inquiry was marked as responded
                                    @if($inquiry->responded_at)
                                        on {{ $inquiry->responded_at->format('F j, Y g:i A') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm animate-fade-in">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold"><i class="fas fa-building me-2 text-primary"></i>Related Property</h5>
                <p class="text-muted small mb-0">Property details</p>
            </div>
            <div class="card-body">
                <div class="position-relative mb-3" style="border-radius: 12px; overflow: hidden;">
                    @if($inquiry->property->primaryImage)
                        <img src="{{ $inquiry->property->primaryImage->url }}" class="w-100" alt="{{ $inquiry->property->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/400x250?text=No+Image" class="w-100" alt="{{ $inquiry->property->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-primary px-3 py-2">{{ ucfirst($inquiry->property->property_type) }}</span>
                    </div>
                </div>
                
                <h6 class="mb-2 fw-bold">{{ $inquiry->property->title }}</h6>
                <p class="text-muted small mb-2">
                    <i class="fas fa-map-marker-alt me-1 text-danger"></i>
                    {{ $inquiry->property->location->name ?? 'N/A' }}
                </p>
                <div class="p-2 mb-3" style="background: #f8fafc; border-radius: 8px;">
                    <p class="fw-bold text-primary mb-0 fs-5">{{ $inquiry->property->formatted_price }}</p>
                </div>
                
                <div class="d-grid gap-2">
                    <a href="{{ route('properties.show', $inquiry->property->slug) }}" class="btn btn-primary" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>View Property
                    </a>
                    <a href="{{ route(auth()->user()->role . '.properties.edit', $inquiry->property) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-edit me-2"></i>Edit Property
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
