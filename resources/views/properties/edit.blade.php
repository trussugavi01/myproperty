@extends('layouts.app')

@section('title', 'Edit Property')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0">Edit Property</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route(auth()->user()->role . '.properties.update', $property) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Basic Information</h5>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="title" class="form-label">Property Title *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $property->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="5" required>{{ old('description', $property->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="youtube_url" class="form-label">
                                    <i class="fab fa-youtube text-danger me-2"></i>YouTube Video URL
                                    <span class="badge bg-secondary ms-2">Optional</span>
                                </label>
                                <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" 
                                       placeholder="e.g., https://www.youtube.com/watch?v=..." 
                                       id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $property->youtube_url) }}">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Add a YouTube video tour of the property to enhance your listing.
                                </small>
                                @error('youtube_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="property_type" class="form-label">Property Type *</label>
                                <select class="form-select @error('property_type') is-invalid @enderror" 
                                        id="property_type" name="property_type" required>
                                    <option value="">Select Type</option>
                                    <option value="sale" {{ old('property_type', $property->property_type) == 'sale' ? 'selected' : '' }}>For Sale</option>
                                    <option value="rent" {{ old('property_type', $property->property_type) == 'rent' ? 'selected' : '' }}>For Rent</option>
                                    <option value="lease" {{ old('property_type', $property->property_type) == 'lease' ? 'selected' : '' }}>For Lease</option>
                                </select>
                                @error('property_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="property_category_id" class="form-label">Category *</label>
                                <select class="form-select @error('property_category_id') is-invalid @enderror" 
                                        id="property_category_id" name="property_category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('property_category_id', $property->property_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('property_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price (₦) *</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price', $property->price) }}" step="0.01" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="availability" class="form-label">Availability *</label>
                                <select class="form-select @error('availability') is-invalid @enderror" 
                                        id="availability" name="availability" required>
                                    <option value="available" {{ old('availability', $property->availability) == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="sold" {{ old('availability', $property->availability) == 'sold' ? 'selected' : '' }}>Sold</option>
                                    <option value="rented" {{ old('availability', $property->availability) == 'rented' ? 'selected' : '' }}>Rented</option>
                                </select>
                                @error('availability')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Location</h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="location_id" class="form-label">Location *</label>
                                <select class="form-select @error('location_id') is-invalid @enderror" 
                                        id="location_id" name="location_id" required>
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location_id', $property->location_id) == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}, {{ $location->city }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Address *</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                       id="address" name="address" value="{{ old('address', $property->address) }}" required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Property Details -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Property Details</h5>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="bedrooms" class="form-label">Bedrooms</label>
                                <input type="number" class="form-control @error('bedrooms') is-invalid @enderror" 
                                       id="bedrooms" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" min="0">
                                @error('bedrooms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="bathrooms" class="form-label">Bathrooms</label>
                                <input type="number" class="form-control @error('bathrooms') is-invalid @enderror" 
                                       id="bathrooms" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" min="0">
                                @error('bathrooms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="land_size" class="form-label">Land Size</label>
                                <input type="number" class="form-control @error('land_size') is-invalid @enderror" 
                                       id="land_size" name="land_size" value="{{ old('land_size', $property->land_size) }}" step="0.01">
                                @error('land_size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="land_size_unit" class="form-label">Unit</label>
                                <select class="form-select @error('land_size_unit') is-invalid @enderror" 
                                        id="land_size_unit" name="land_size_unit">
                                    <option value="sqm" {{ old('land_size_unit', $property->land_size_unit) == 'sqm' ? 'selected' : '' }}>Square Meters</option>
                                    <option value="sqft" {{ old('land_size_unit', $property->land_size_unit) == 'sqft' ? 'selected' : '' }}>Square Feet</option>
                                    <option value="acres" {{ old('land_size_unit', $property->land_size_unit) == 'acres' ? 'selected' : '' }}>Acres</option>
                                    <option value="hectares" {{ old('land_size_unit', $property->land_size_unit) == 'hectares' ? 'selected' : '' }}>Hectares</option>
                                </select>
                                @error('land_size_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Amenities -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Amenities</h5>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    @foreach($amenities as $amenity)
                                        <div class="col-md-4 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="amenities[]" value="{{ $amenity->id }}" 
                                                       id="amenity_{{ $amenity->id }}"
                                                       {{ in_array($amenity->id, old('amenities', $property->amenities->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="amenity_{{ $amenity->id }}">
                                                    {{ $amenity->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Existing Images -->
                        @if($property->images->count() > 0)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Current Images</h5>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    @foreach($property->images as $image)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img src="{{ $image->url }}" class="card-img-top" alt="Property Image" style="height: 150px; object-fit: cover;">
                                                <div class="card-body p-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" 
                                                               name="remove_images[]" value="{{ $image->id }}" 
                                                               id="remove_{{ $image->id }}">
                                                        <label class="form-check-label small" for="remove_{{ $image->id }}">
                                                            Remove
                                                        </label>
                                                    </div>
                                                    @if($image->is_primary)
                                                        <span class="badge bg-primary">Primary</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- New Images -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Add New Images</h5>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="images" class="form-label">Upload Additional Images</label>
                                <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                       id="images" name="images[]" multiple accept="image/*">
                                <small class="text-muted">You can select multiple images.</small>
                                @error('images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Property
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
