<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;

// Find the property
$property = Property::where('title', 'like', '%Luxury 4 Bedroom Duplex%')
    ->orWhere('title', 'like', '%Lekki%')
    ->first();

if (!$property) {
    echo "Property not found. Creating a sample property...\n";
    
    $property = Property::create([
        'user_id' => 1,
        'location_id' => 1,
        'property_category_id' => 1,
        'title' => 'Luxury 4 Bedroom Duplex in Lekki',
        'description' => 'Beautiful 4 bedroom duplex located in the heart of Lekki. Features modern amenities, spacious rooms, and excellent security.',
        'price' => 85000000,
        'property_type' => 'sale',
        'bedrooms' => 4,
        'bathrooms' => 4,
        'land_size' => 500,
        'land_size_unit' => 'sqm',
        'address' => 'Lekki Phase 1, Lagos',
        'availability' => 'available',
        'is_featured' => true,
        'is_published' => true,
        'published_at' => now(),
    ]);
    
    echo "Property created with ID: {$property->id}\n";
} else {
    echo "Property found: {$property->title} (ID: {$property->id})\n";
}

// Create the storage directory if it doesn't exist
$propertyDir = "properties/{$property->id}";
if (!Storage::disk('public')->exists($propertyDir)) {
    Storage::disk('public')->makeDirectory($propertyDir);
    echo "Created directory: storage/app/public/{$propertyDir}\n";
}

// The image will be saved manually, so we just create the database entry
$imagePath = "{$propertyDir}/featured-image.jpg";

// Check if image already exists
$existingImage = PropertyImage::where('property_id', $property->id)
    ->where('is_primary', true)
    ->first();

if ($existingImage) {
    echo "Primary image already exists. Updating...\n";
    $existingImage->update([
        'image_path' => $imagePath,
    ]);
} else {
    PropertyImage::create([
        'property_id' => $property->id,
        'image_path' => $imagePath,
        'is_primary' => true,
        'order' => 0,
    ]);
    echo "Image record created.\n";
}

echo "\nNow copy the uploaded image to: storage/app/public/{$imagePath}\n";
echo "Full path: " . storage_path("app/public/{$imagePath}") . "\n";
echo "Property ID: {$property->id}\n";
