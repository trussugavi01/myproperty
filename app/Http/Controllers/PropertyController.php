<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Amenity;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Property::with(['location', 'category', 'primaryImage', 'user'])
            ->published();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Filter by property type
        if ($request->filled('property_type')) {
            $query->where('property_type', $request->property_type);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('property_category_id', $request->category);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location_id', $request->location);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by bedrooms
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

        // Filter by bathrooms
        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', '>=', $request->bathrooms);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->latest();
        }

        $properties = $query->paginate(12)->withQueryString();

        $categories = PropertyCategory::where('is_active', true)->get();
        $locations = Location::where('is_active', true)->get();

        return view('properties.index', compact('properties', 'categories', 'locations'));
    }

    public function show(Property $property)
    {
        $this->authorize('view', $property);

        $property->load(['location', 'category', 'images', 'amenities', 'user']);
        $property->incrementViews();

        $relatedProperties = Property::with(['location', 'category', 'primaryImage'])
            ->published()
            ->where('id', '!=', $property->id)
            ->where(function($query) use ($property) {
                $query->where('location_id', $property->location_id)
                      ->orWhere('property_category_id', $property->property_category_id);
            })
            ->take(4)
            ->get();

        return view('properties.show', compact('property', 'relatedProperties'));
    }

    public function create()
    {
        $this->authorize('create', Property::class);

        $categories = PropertyCategory::where('is_active', true)->get();
        $locations = Location::where('is_active', true)->get();
        $amenities = Amenity::where('is_active', true)->get();

        return view('properties.create', compact('categories', 'locations', 'amenities'));
    }

    public function store(StorePropertyRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['is_published'] = false; // Requires admin approval

        $property = Property::create($data);

        // Handle amenities
        if ($request->has('amenities')) {
            $property->amenities()->sync($request->amenities);
        }

        // Handle images
        if ($request->hasFile('images')) {
            $this->uploadImages($property, $request->file('images'));
        }

        return redirect()->route('dashboard')
            ->with('success', 'Property created successfully. Awaiting admin approval.');
    }

    public function edit(Property $property)
    {
        $this->authorize('update', $property);

        $categories = PropertyCategory::where('is_active', true)->get();
        $locations = Location::where('is_active', true)->get();
        $amenities = Amenity::where('is_active', true)->get();
        $property->load(['images', 'amenities']);

        return view('properties.edit', compact('property', 'categories', 'locations', 'amenities'));
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $data = $request->validated();
        $property->update($data);

        // Handle amenities
        if ($request->has('amenities')) {
            $property->amenities()->sync($request->amenities);
        }

        // Handle new images
        if ($request->hasFile('images')) {
            $this->uploadImages($property, $request->file('images'));
        }

        // Handle image removal
        if ($request->has('remove_images')) {
            $this->removeImages($request->remove_images);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);

        // Delete images
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            if ($image->thumbnail_path) {
                Storage::disk('public')->delete($image->thumbnail_path);
            }
        }

        $property->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Property deleted successfully.');
    }

    private function uploadImages(Property $property, array $images)
    {
        $order = $property->images()->count();
        $isFirst = $order === 0;

        foreach ($images as $image) {
            $path = $image->store("properties/{$property->id}", 'public');

            PropertyImage::create([
                'property_id' => $property->id,
                'image_path' => $path,
                'is_primary' => $isFirst,
                'order' => $order++,
            ]);

            $isFirst = false;
        }
    }

    private function removeImages(array $imageIds)
    {
        $images = PropertyImage::whereIn('id', $imageIds)->get();

        foreach ($images as $image) {
            Storage::disk('public')->delete($image->image_path);
            if ($image->thumbnail_path) {
                Storage::disk('public')->delete($image->thumbnail_path);
            }
            $image->delete();
        }
    }
}
