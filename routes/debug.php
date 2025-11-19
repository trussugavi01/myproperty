<?php

use Illuminate\Support\Facades\Route;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\Location;
use App\Models\Amenity;

Route::get('/debug/property/{id}', function ($id) {
    $property = Property::with(['images', 'amenities'])->find($id);
    $categories = PropertyCategory::where('is_active', true)->get();
    $locations = Location::where('is_active', true)->get();
    $amenities = Amenity::where('is_active', true)->get();
    
    $user = auth()->user();
    
    return [
        'property' => $property,
        'categories_count' => $categories->count(),
        'locations_count' => $locations->count(),
        'amenities_count' => $amenities->count(),
        'current_user_id' => $user ? $user->id : null,
        'current_user_role' => $user ? $user->role : null,
        'property_owner_id' => $property ? $property->user_id : null,
        'can_update' => $user && $property ? ($user->id === $property->user_id || $user->isAdmin()) : false,
    ];
});
