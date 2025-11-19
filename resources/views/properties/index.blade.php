@extends('layouts.public')

@section('title', 'Properties for Sale and Rent')

@section('content')
<!-- Hero Section -->
<section class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #5568d3 0%, #6b4a9e 100%); padding: 80px 0 40px 0;">
    <!-- Pattern Overlay -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); opacity: 0.4;"></div>
    <!-- Gradient Overlay -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.05) 100%);"></div>
    
    <div class="container position-relative">
        <div class="row">
            <div class="col-12 text-center text-white">
                <h1 class="display-4 fw-bold mb-3" style="text-shadow: 0 2px 20px rgba(0,0,0,0.15);">🏘️ Browse Properties</h1>
                <p class="lead mb-0" style="opacity: 0.95; text-shadow: 0 1px 10px rgba(0,0,0,0.1);">Find your perfect property from our extensive listings</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="position-relative" style="background: linear-gradient(180deg, #fafbfc 0%, #ffffff 50%, #fafbfc 100%); padding: 60px 0;">
    <!-- Subtle pattern overlay -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background-image: radial-gradient(circle at 2px 2px, rgba(102, 126, 234, 0.03) 1px, transparent 0); background-size: 40px 40px; pointer-events: none;"></div>
    
    <div class="container position-relative">
        <!-- Filters -->
        <div class="card border-0 mb-5" style="border-radius: 20px; backdrop-filter: blur(10px); background: rgba(255,255,255,0.98); box-shadow: 0 20px 60px rgba(0,0,0,0.1), 0 0 0 1px rgba(255,255,255,0.3);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-filter text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Filter Properties</h5>
                        <p class="text-muted small mb-0">Refine your search to find exactly what you need</p>
                    </div>
                </div>
                
                <form method="GET" action="{{ route('properties.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small text-muted">🔍 SEARCH</label>
                            <input type="text" name="search" class="form-control form-control-lg" placeholder="Search properties..." value="{{ request('search') }}" style="border-radius: 10px;">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold small text-muted">🏠 PROPERTY TYPE</label>
                            <select name="property_type" class="form-select form-select-lg" style="border-radius: 10px;">
                                <option value="">All Types</option>
                                <option value="sale" {{ request('property_type') === 'sale' ? 'selected' : '' }}>💰 For Sale</option>
                                <option value="rent" {{ request('property_type') === 'rent' ? 'selected' : '' }}>🔑 For Rent</option>
                                <option value="lease" {{ request('property_type') === 'lease' ? 'selected' : '' }}>📋 For Lease</option>
                                <option value="shortlet" {{ request('property_type') === 'shortlet' ? 'selected' : '' }}>⏰ Shortlet</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold small text-muted">🏗️ CATEGORY</label>
                            <select name="category" class="form-select form-select-lg" style="border-radius: 10px;">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold small text-muted">📍 LOCATION</label>
                            <select name="location" class="form-select form-select-lg" style="border-radius: 10px;">
                                <option value="">All Locations</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small text-muted">📊 SORT BY</label>
                            <select name="sort" class="form-select form-select-lg" style="border-radius: 10px;">
                                <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>🆕 Newest First</option>
                                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>💵 Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>💰 Price: High to Low</option>
                                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>📅 Oldest First</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 d-flex gap-2">
                            <button type="submit" class="btn btn-lg px-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; border-radius: 10px; transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                                <i class="fas fa-search me-2"></i>Apply Filters
                            </button>
                            <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary btn-lg px-4" style="border-radius: 10px;">
                                <i class="fas fa-redo me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Count & Active Filters -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-1">
                    <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); font-size: 1rem; padding: 10px 20px; border-radius: 10px;">
                        {{ $properties->total() }} Properties Found
                    </span>
                </h5>
                <p class="text-muted small mb-0">Showing {{ $properties->firstItem() ?? 0 }} - {{ $properties->lastItem() ?? 0 }} of {{ $properties->total() }} results</p>
            </div>
            
            @if(request()->hasAny(['search', 'property_type', 'category', 'location']))
                <div class="d-flex gap-2 flex-wrap">
                    @if(request('search'))
                        <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 10px;">
                            Search: "{{ request('search') }}"
                            <a href="{{ route('properties.index', request()->except('search')) }}" class="text-dark ms-2">×</a>
                        </span>
                    @endif
                    @if(request('property_type'))
                        <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 10px;">
                            Type: {{ ucfirst(request('property_type')) }}
                            <a href="{{ route('properties.index', request()->except('property_type')) }}" class="text-dark ms-2">×</a>
                        </span>
                    @endif
                    @if(request('category'))
                        <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 10px;">
                            Category
                            <a href="{{ route('properties.index', request()->except('category')) }}" class="text-dark ms-2">×</a>
                        </span>
                    @endif
                    @if(request('location'))
                        <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 10px;">
                            Location
                            <a href="{{ route('properties.index', request()->except('location')) }}" class="text-dark ms-2">×</a>
                        </span>
                    @endif
                </div>
            @endif
        </div>

        <!-- Properties Grid -->
        <div class="row g-4 mb-5">
            @forelse($properties as $property)
                <div class="col-lg-4 col-md-6">
                    <div class="property-card animate-fade-in" style="border-radius: 20px; overflow: hidden; transition: all 0.3s ease; background: white;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'">
                        <div class="position-relative overflow-hidden">
                            @if($property->primaryImage)
                                <img src="{{ $property->primaryImage->url }}" class="w-100" alt="{{ $property->title }}" style="height: 250px; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            @else
                                <img src="https://via.placeholder.com/400x250?text=No+Image" class="w-100" alt="{{ $property->title }}" style="height: 250px; object-fit: cover;">
                            @endif
                            
                            @if($property->is_featured)
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 8px 15px; border-radius: 20px; font-size: 0.85rem;">
                                        <i class="fas fa-star me-1"></i>Featured
                                    </span>
                                </div>
                            @endif
                            
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-primary px-3 py-2" style="border-radius: 10px; font-size: 0.85rem;">
                                    {{ ucfirst($property->property_type) }}
                                </span>
                            </div>
                            
                            <div class="position-absolute bottom-0 end-0 m-3">
                                <button class="btn btn-light btn-sm rounded-circle" style="width: 40px; height: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                    <i class="fas fa-heart text-danger"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <h5 class="mb-3 fw-bold">{{ Str::limit($property->title, 50) }}</h5>
                            <p class="text-muted mb-3">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                {{ $property->location->name ?? 'N/A' }}@if($property->location && $property->location->city), {{ $property->location->city }}@endif
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold fs-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $property->formatted_price }}</span>
                            </div>
                            
                            <div class="d-flex gap-3 mb-4 text-muted small">
                                @if($property->bedrooms)
                                    <span><i class="fas fa-bed me-1 text-primary"></i>{{ $property->bedrooms }} Beds</span>
                                @endif
                                @if($property->bathrooms)
                                    <span><i class="fas fa-bath me-1 text-primary"></i>{{ $property->bathrooms }} Baths</span>
                                @endif
                                @if($property->land_size)
                                    <span><i class="fas fa-ruler-combined me-1 text-primary"></i>{{ $property->land_size }} {{ $property->land_size_unit }}</span>
                                @endif
                            </div>
                            
                            <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-primary w-100" style="border-radius: 10px; padding: 12px;">
                                <i class="fas fa-arrow-right me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5" style="background: white; border-radius: 20px; padding: 80px 20px;">
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="fas fa-home fs-1 text-white"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-3">No Properties Found</h3>
                        <p class="text-muted mb-4">We couldn't find any properties matching your criteria.<br>Try adjusting your filters or search terms.</p>
                        <a href="{{ route('properties.index') }}" class="btn btn-lg px-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; border-radius: 10px;">
                            <i class="fas fa-redo me-2"></i>Clear All Filters
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($properties->hasPages())
            <div class="d-flex justify-content-center">
                <div class="pagination-wrapper">
                    {{ $properties->links() }}
                </div>
            </div>
        @endif
    </div>
</section>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

.property-card {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.pagination-wrapper .pagination {
    gap: 8px;
}

.pagination-wrapper .page-link {
    border-radius: 10px;
    border: none;
    padding: 12px 18px;
    color: #667eea;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pagination-wrapper .page-link:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transform: translateY(-2px);
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}
</style>
@endsection
