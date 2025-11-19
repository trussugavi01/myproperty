@extends('layouts.app')

@section('title', 'Create Property')
@section('page-title', 'Create New Property')

@section('content')
<!-- Header Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h3 class="mb-2 fw-bold">Add New Property Listing 🏠</h3>
                        <p class="mb-0 opacity-75">Fill in the details below to create a new property listing.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="fas fa-plus-circle" style="font-size: 4rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm animate-fade-in" style="border-radius: 16px;">
            <div class="card-body p-4">
                    <form action="{{ route(auth()->user()->role . '.properties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">Basic Information</h5>
                                        <p class="text-muted small mb-0">Property title, description, and category</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="title" class="form-label fw-semibold">
                                    <i class="fas fa-heading text-primary me-2"></i>Property Title *
                                </label>
                                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" placeholder="e.g., Luxury 3 Bedroom Apartment in Lekki" 
                                       id="title" name="title" value="{{ old('title') }}" required style="border-radius: 10px;">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label fw-semibold">
                                    <i class="fas fa-align-left text-primary me-2"></i>Description *
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Provide a detailed description of the property..." 
                                          id="description" name="description" rows="5" required style="border-radius: 10px;">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="youtube_url" class="form-label fw-semibold">
                                    <i class="fab fa-youtube text-danger me-2"></i>YouTube Video URL
                                    <span class="badge bg-secondary ms-2">Optional</span>
                                </label>
                                <input type="url" class="form-control form-control-lg @error('youtube_url') is-invalid @enderror" 
                                       placeholder="e.g., https://www.youtube.com/watch?v=..." 
                                       id="youtube_url" name="youtube_url" value="{{ old('youtube_url') }}" style="border-radius: 10px;">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Add a YouTube video tour of the property to enhance your listing.
                                </div>
                                @error('youtube_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="property_type" class="form-label fw-semibold">
                                    <i class="fas fa-tag text-primary me-2"></i>Property Type *
                                </label>
                                <select class="form-select form-select-lg @error('property_type') is-invalid @enderror" 
                                        id="property_type" name="property_type" required style="border-radius: 10px;">
                                    <option value="">Select Type</option>
                                    <option value="sale" {{ old('property_type') == 'sale' ? 'selected' : '' }}>💰 For Sale</option>
                                    <option value="rent" {{ old('property_type') == 'rent' ? 'selected' : '' }}>🔑 For Rent</option>
                                    <option value="lease" {{ old('property_type') == 'lease' ? 'selected' : '' }}>📋 For Lease</option>
                                </select>
                                @error('property_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="property_category_id" class="form-label fw-semibold">
                                    <i class="fas fa-th-large text-primary me-2"></i>Category *
                                </label>
                                <select class="form-select form-select-lg @error('property_category_id') is-invalid @enderror" 
                                        id="property_category_id" name="property_category_id" required style="border-radius: 10px;">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('property_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('property_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label fw-semibold">
                                    <i class="fas fa-money-bill-wave text-primary me-2"></i>Price (₦) *
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" style="border-radius: 10px 0 0 10px;">₦</span>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Enter price" 
                                           id="price" name="price" value="{{ old('price') }}" step="0.01" required style="border-radius: 0 10px 10px 0;">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="availability" class="form-label fw-semibold">
                                    <i class="fas fa-check-circle text-primary me-2"></i>Availability *
                                </label>
                                <select class="form-select form-select-lg @error('availability') is-invalid @enderror" 
                                        id="availability" name="availability" required style="border-radius: 10px;">
                                    <option value="available" {{ old('availability') == 'available' ? 'selected' : '' }}>✅ Available</option>
                                    <option value="sold" {{ old('availability') == 'sold' ? 'selected' : '' }}>🔴 Sold</option>
                                    <option value="rented" {{ old('availability') == 'rented' ? 'selected' : '' }}>🟡 Rented</option>
                                </select>
                                @error('availability')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">Location</h5>
                                        <p class="text-muted small mb-0">Where is this property located?</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="location_id" class="form-label fw-semibold">
                                    <i class="fas fa-map-pin text-success me-2"></i>Location *
                                </label>
                                <select class="form-select form-select-lg @error('location_id') is-invalid @enderror" 
                                        id="location_id" name="location_id" required style="border-radius: 10px;">
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                            📍 {{ $location->name }}, {{ $location->city }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label fw-semibold">
                                    <i class="fas fa-home text-success me-2"></i>Address *
                                </label>
                                <input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" 
                                       id="address" name="address" value="{{ old('address') }}" placeholder="Enter full address" required style="border-radius: 10px;">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Property Details -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">Property Details</h5>
                                        <p class="text-muted small mb-0">Specifications and features</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="bedrooms" class="form-label fw-semibold">
                                    <i class="fas fa-bed text-info me-2"></i>Bedrooms
                                </label>
                                <input type="number" class="form-control form-control-lg @error('bedrooms') is-invalid @enderror" 
                                       id="bedrooms" name="bedrooms" value="{{ old('bedrooms') }}" min="0" placeholder="0" style="border-radius: 10px;">
                                @error('bedrooms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="bathrooms" class="form-label fw-semibold">
                                    <i class="fas fa-bath text-info me-2"></i>Bathrooms
                                </label>
                                <input type="number" class="form-control form-control-lg @error('bathrooms') is-invalid @enderror" 
                                       id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}" min="0" placeholder="0" style="border-radius: 10px;">
                                @error('bathrooms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="land_size" class="form-label fw-semibold">
                                    <i class="fas fa-ruler-combined text-info me-2"></i>Land Size
                                </label>
                                <input type="number" class="form-control form-control-lg @error('land_size') is-invalid @enderror" 
                                       id="land_size" name="land_size" value="{{ old('land_size') }}" step="0.01" placeholder="0" style="border-radius: 10px;">
                                @error('land_size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="land_size_unit" class="form-label fw-semibold">
                                    <i class="fas fa-arrows-alt text-info me-2"></i>Unit
                                </label>
                                <select class="form-select form-select-lg @error('land_size_unit') is-invalid @enderror" 
                                        id="land_size_unit" name="land_size_unit" style="border-radius: 10px;">
                                    <option value="sqm" {{ old('land_size_unit') == 'sqm' ? 'selected' : '' }}>Square Meters</option>
                                    <option value="sqft" {{ old('land_size_unit') == 'sqft' ? 'selected' : '' }}>Square Feet</option>
                                    <option value="acres" {{ old('land_size_unit') == 'acres' ? 'selected' : '' }}>Acres</option>
                                    <option value="hectares" {{ old('land_size_unit') == 'hectares' ? 'selected' : '' }}>Hectares</option>
                                </select>
                                @error('land_size_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Amenities -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-list-check"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">Amenities</h5>
                                        <p class="text-muted small mb-0">Select all available amenities</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    @foreach($amenities as $amenity)
                                        <div class="col-md-4 mb-3">
                                            <div class="form-check form-check-lg">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="amenities[]" value="{{ $amenity->id }}" 
                                                       id="amenity_{{ $amenity->id }}"
                                                       {{ in_array($amenity->id, old('amenities', [])) ? 'checked' : '' }}
                                                       style="border-radius: 6px; width: 1.5em; height: 1.5em;">
                                                <label class="form-check-label fw-semibold" for="amenity_{{ $amenity->id }}" style="margin-left: 0.5rem;">
                                                    <i class="fas fa-check-circle text-success me-1"></i>{{ $amenity->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-images"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">Property Images</h5>
                                        <p class="text-muted small mb-0">Upload high-quality photos of the property</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="images" class="form-label fw-semibold">
                                    <i class="fas fa-camera text-warning me-2"></i>Upload Images
                                </label>
                                <input type="file" class="form-control form-control-lg @error('images') is-invalid @enderror" 
                                       id="images" name="images[]" multiple accept="image/*" style="border-radius: 10px; padding: 15px;">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    You can select multiple images. First image will be the primary image.
                                </div>
                                @error('images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-lg px-5" style="border-radius: 10px;">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-lg px-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; border-radius: 10px;">
                                        <i class="fas fa-save me-2"></i>Create Property
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
