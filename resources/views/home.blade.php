@extends('layouts.public')

@section('title', 'Find Your Dream Property in Africa')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden" style="min-height: 600px; padding: 100px 0;">
    <!-- Background Image -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1920&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
    
    <!-- Dark Overlay for better text readability -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background: linear-gradient(135deg, rgba(17, 94, 88, 0.85) 0%, rgba(13, 71, 66, 0.90) 100%);"></div>
    
    <!-- Subtle Pattern Overlay -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); opacity: 0.3;"></div>
    
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center text-white">
                <div class="animate-fade-in">
                    <h1 class="display-3 fw-bold mb-4" style="animation: slideDown 0.8s ease-out; text-shadow: 0 2px 20px rgba(0,0,0,0.15);">Find Your Dream Property 🏡</h1>
                    <p class="lead mb-5" style="font-size: 1.3rem; animation: slideDown 0.8s ease-out 0.2s both; opacity: 0.95; text-shadow: 0 1px 10px rgba(0,0,0,0.1);">Discover the best properties for sale and rent across Africa</p>
                </div>
                
                <!-- Enhanced Search Box -->
                <div class="search-box" style="animation: slideUp 0.8s ease-out 0.4s both;">
                    <div class="card border-0" style="border-radius: 20px; backdrop-filter: blur(10px); background: rgba(255,255,255,0.98); box-shadow: 0 20px 60px rgba(0,0,0,0.2), 0 0 0 1px rgba(255,255,255,0.3);">
                        <div class="card-body p-4">
                            <form action="{{ route('properties.index') }}" method="GET">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="fas fa-search text-primary"></i>
                                            </span>
                                            <input type="text" name="search" class="form-control border-start-0" placeholder="Search properties..." style="border-radius: 0 10px 10px 0;">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="property_type" class="form-select form-select-lg" style="border-radius: 10px;">
                                            <option value="">🏠 Property Type</option>
                                            <option value="sale">💰 For Sale</option>
                                            <option value="rent">🔑 For Rent</option>
                                            <option value="lease">📋 For Lease</option>
                                            <option value="shortlet">⏰ Shortlet</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="location" class="form-select form-select-lg" style="border-radius: 10px;">
                                            <option value="">📍 Location</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}, {{ $location->city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; color: white; border-radius: 10px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.3)'">
                                            <i class="fas fa-search me-2"></i>Search Properties
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Properties -->
<section class="py-5 position-relative" style="margin-top: 80px; background: linear-gradient(180deg, #fafbfc 0%, #ffffff 50%, #fafbfc 100%);">
    <!-- Subtle pattern overlay -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background-image: radial-gradient(circle at 2px 2px, rgba(102, 126, 234, 0.03) 1px, transparent 0); background-size: 40px 40px; pointer-events: none;"></div>
    <div class="container position-relative" style="padding-top: 60px; padding-bottom: 60px;">
        <div class="text-center mb-5 animate-fade-in">
            <h2 class="fw-bold mb-2" style="font-size: 2.5rem;">⭐ Featured Properties</h2>
            <p class="text-muted">Handpicked premium properties just for you</p>
        </div>
        
        <div class="row g-4">
            @forelse($featuredProperties as $property)
                <div class="col-md-4">
                    <div class="property-card animate-fade-in" style="transition: all 0.3s ease; border-radius: 20px; overflow: hidden;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
                        <div class="position-relative overflow-hidden">
                            @if($property->primaryImage)
                                <img src="{{ $property->primaryImage->url }}" class="w-100" alt="{{ $property->title }}" style="height: 250px; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            @else
                                <img src="https://via.placeholder.com/400x250?text=No+Image" class="w-100" alt="{{ $property->title }}" style="height: 250px; object-fit: cover;">
                            @endif
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 8px 15px; border-radius: 20px; font-size: 0.85rem;">
                                    <i class="fas fa-star me-1"></i>Featured
                                </span>
                            </div>
                            <div class="position-absolute top-0 end-0 m-3">
                                <button class="btn btn-light btn-sm rounded-circle" style="width: 40px; height: 40px;">
                                    <i class="fas fa-heart text-danger"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <h5 class="mb-3 fw-bold">{{ $property->title }}</h5>
                            <p class="text-muted mb-3">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                {{ $property->location->name ?? 'N/A' }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold fs-4" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $property->formatted_price }}</span>
                                <span class="badge bg-primary px-3 py-2" style="border-radius: 10px;">{{ ucfirst($property->property_type) }}</span>
                            </div>
                            <div class="d-flex gap-3 mb-4 text-muted small">
                                <span><i class="fas fa-bed me-1 text-primary"></i>{{ $property->bedrooms }} Beds</span>
                                <span><i class="fas fa-bath me-1 text-primary"></i>{{ $property->bathrooms }} Baths</span>
                                <span><i class="fas fa-ruler-combined me-1 text-primary"></i>{{ $property->land_size }} {{ $property->land_size_unit }}</span>
                            </div>
                            <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-primary w-100" style="border-radius: 10px; padding: 12px;">
                                <i class="fas fa-arrow-right me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No featured properties available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-5 position-relative" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #f0fdf4 100%);">
    <!-- Decorative elements -->
    <div class="position-absolute" style="top: 50px; right: 5%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%); border-radius: 50%;"></div>
    <div class="position-absolute" style="bottom: 50px; left: 5%; width: 250px; height: 250px; background: radial-gradient(circle, rgba(5, 150, 105, 0.06) 0%, transparent 70%); border-radius: 50%;"></div>
    <div class="container position-relative" style="padding-top: 60px; padding-bottom: 60px;">
        <div class="text-center mb-5 animate-fade-in">
            <h2 class="fw-bold mb-2" style="font-size: 2.5rem;">🏗️ Browse by Category</h2>
            <p class="text-muted">Find properties that match your needs</p>
        </div>
        <div class="row g-4">
            @foreach($categories as $category)
                @php
                    $greenShades = [
                        ['gradient' => 'linear-gradient(135deg, #10b981 0%, #059669 100%)', 'hover' => '#10b981'],
                        ['gradient' => 'linear-gradient(135deg, #14b8a6 0%, #0d9488 100%)', 'hover' => '#14b8a6'],
                        ['gradient' => 'linear-gradient(135deg, #22c55e 0%, #16a34a 100%)', 'hover' => '#22c55e'],
                        ['gradient' => 'linear-gradient(135deg, #34d399 0%, #10b981 100%)', 'hover' => '#34d399'],
                    ];
                    $shade = $greenShades[$loop->index % count($greenShades)];
                @endphp
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('properties.index', ['category' => $category->id]) }}" class="text-decoration-none">
                        <div class="stat-card text-center animate-fade-in" style="border-radius: 20px; padding: 40px 20px; transition: all 0.3s ease; background: white; border: 2px solid #f1f5f9;" onmouseover="this.style.transform='translateY(-10px)'; this.style.borderColor='{{ $shade['hover'] }}'; this.style.boxShadow='0 20px 40px rgba(16, 185, 129, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#f1f5f9'; this.style.boxShadow=''">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background: {{ $shade['gradient'] }};">
                                    <i class="fas fa-building fs-2 text-white"></i>
                                </div>
                            </div>
                            <h5 class="mb-0 fw-bold">{{ $category->name }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Recent Properties -->
<section class="py-5 position-relative" style="background: linear-gradient(180deg, #ffffff 0%, #f9fafb 100%);">
    <!-- Subtle grid pattern -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background-image: linear-gradient(rgba(102, 126, 234, 0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(102, 126, 234, 0.02) 1px, transparent 1px); background-size: 50px 50px; pointer-events: none;"></div>
    <div class="container position-relative" style="padding-top: 60px; padding-bottom: 60px;">
        <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in">
            <div>
                <h2 class="fw-bold mb-2" style="font-size: 2.5rem;">🆕 Recent Properties</h2>
                <p class="text-muted mb-0">Latest additions to our marketplace</p>
            </div>
            <a href="{{ route('properties.index') }}" class="btn btn-outline-primary btn-lg" style="border-radius: 10px;">
                View All <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($recentProperties as $property)
                <div class="col-md-3 col-sm-6">
                    <div class="property-card animate-fade-in" style="border-radius: 16px; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
                        <div class="position-relative overflow-hidden">
                            @if($property->primaryImage)
                                <img src="{{ $property->primaryImage->url }}" class="w-100" alt="{{ $property->title }}" style="height: 200px; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" class="w-100" alt="{{ $property->title }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-white text-dark px-2 py-1" style="border-radius: 8px; font-size: 0.75rem;">
                                    <i class="fas fa-clock me-1"></i>New
                                </span>
                            </div>
                        </div>
                        <div class="p-3">
                            <h6 class="mb-2 fw-bold">{{ Str::limit($property->title, 40) }}</h6>
                            <p class="text-muted small mb-3">
                                <i class="fas fa-map-marker-alt me-1 text-primary"></i>
                                {{ $property->location->name ?? 'N/A' }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">{{ $property->formatted_price }}</span>
                                <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-sm btn-primary" style="border-radius: 8px;">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); margin-top: 80px;">
    <!-- Dark overlay for better contrast -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background: linear-gradient(135deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.2) 100%);"></div>
    <!-- Pattern overlay -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background-image: url('data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ffffff" fill-opacity="0.06" fill-rule="evenodd"%3E%3Cpath d="M0 40L40 0H20L0 20M40 40V20L20 40"/%3E%3C/g%3E%3C/svg%3E');"></div>
    <!-- Animated Background -->
    <div class="position-absolute" style="top: -100px; right: -100px; width: 400px; height: 400px; background: rgba(255,255,255,0.08); border-radius: 50%; animation: float 6s ease-in-out infinite; box-shadow: 0 0 80px rgba(255,255,255,0.1);"></div>
    <div class="position-absolute" style="bottom: -50px; left: -50px; width: 300px; height: 300px; background: rgba(255,255,255,0.04); border-radius: 50%; animation: float 8s ease-in-out infinite;"></div>
    
    <div class="container text-center position-relative" style="padding: 60px 0;">
        <div class="animate-fade-in">
            <h2 class="fw-bold mb-3 text-white" style="font-size: 3rem;">🚀 Ready to List Your Property?</h2>
            <p class="lead mb-5 text-white opacity-90" style="font-size: 1.3rem;">Join thousands of property owners and agents on our platform</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 py-3" style="border-radius: 50px; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow=''">
                Get Started Today <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endsection
