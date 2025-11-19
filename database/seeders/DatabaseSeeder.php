<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\DeveloperProfile;
use App\Models\LandlordProfile;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@property.com.ng',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+234 800 000 0001',
            'is_active' => true,
            'onboarding_completed' => true,
        ]);

        // Create Agent Users
        $agent1 = User::create([
            'name' => 'John Agent',
            'email' => 'agent@property.com.ng',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'phone' => '+234 800 000 0002',
            'is_active' => true,
            'onboarding_completed' => true,
        ]);

        $agent2 = User::create([
            'name' => 'Sarah Agent',
            'email' => 'agent2@property.com.ng',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'phone' => '+234 800 000 0003',
            'is_active' => true,
            'onboarding_completed' => true,
        ]);

        // Create Landlord User
        $landlord = User::create([
            'name' => 'Mike Landlord',
            'email' => 'landlord@property.com.ng',
            'password' => Hash::make('password'),
            'role' => 'landlord',
            'phone' => '+234 800 000 0004',
            'is_active' => true,
            'onboarding_completed' => true,
        ]);

        LandlordProfile::create([
            'user_id' => $landlord->id,
            'company_name' => 'Prime Properties Ltd',
            'bio' => 'Experienced property owner with over 10 years in real estate.',
            'address' => '123 Victoria Island',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'preferred_contact_method' => 'email',
        ]);

        // Create Developer User
        $developer = User::create([
            'name' => 'David Developer',
            'email' => 'developer@property.com.ng',
            'password' => Hash::make('password'),
            'role' => 'developer',
            'phone' => '+234 800 000 0005',
            'is_active' => true,
            'onboarding_completed' => true,
        ]);

        DeveloperProfile::create([
            'user_id' => $developer->id,
            'company_name' => 'Elite Developers Nigeria',
            'bio' => 'Leading property development company in Nigeria.',
            'address' => '456 Lekki Phase 1',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'website' => 'https://elitedev.ng',
            'years_in_business' => 15,
        ]);

        // Create Locations
        $locations = [
            ['name' => 'Victoria Island', 'city' => 'Lagos', 'state' => 'Lagos', 'description' => 'Premium business district'],
            ['name' => 'Lekki Phase 1', 'city' => 'Lagos', 'state' => 'Lagos', 'description' => 'Upscale residential area'],
            ['name' => 'Ikoyi', 'city' => 'Lagos', 'state' => 'Lagos', 'description' => 'Elite residential neighborhood'],
            ['name' => 'Banana Island', 'city' => 'Lagos', 'state' => 'Lagos', 'description' => 'Luxury waterfront community'],
            ['name' => 'Maitama', 'city' => 'Abuja', 'state' => 'FCT', 'description' => 'Prestigious Abuja district'],
            ['name' => 'Asokoro', 'city' => 'Abuja', 'state' => 'FCT', 'description' => 'High-end residential area'],
            ['name' => 'GRA', 'city' => 'Port Harcourt', 'state' => 'Rivers', 'description' => 'Government Reserved Area'],
            ['name' => 'Bodija', 'city' => 'Ibadan', 'state' => 'Oyo', 'description' => 'Residential and commercial hub'],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }

        // Create Property Categories
        $categories = [
            ['name' => 'Apartment', 'description' => 'Multi-unit residential buildings', 'icon' => 'building', 'order' => 1],
            ['name' => 'House', 'description' => 'Single-family homes', 'icon' => 'home', 'order' => 2],
            ['name' => 'Villa', 'description' => 'Luxury standalone properties', 'icon' => 'castle', 'order' => 3],
            ['name' => 'Duplex', 'description' => 'Two-story residential units', 'icon' => 'building-2', 'order' => 4],
            ['name' => 'Land', 'description' => 'Vacant plots and land', 'icon' => 'map', 'order' => 5],
            ['name' => 'Commercial', 'description' => 'Office and retail spaces', 'icon' => 'briefcase', 'order' => 6],
            ['name' => 'Penthouse', 'description' => 'Top-floor luxury apartments', 'icon' => 'building-skyscraper', 'order' => 7],
        ];

        foreach ($categories as $category) {
            PropertyCategory::create($category);
        }

        // Create Amenities
        $amenities = [
            ['name' => 'Swimming Pool', 'icon' => 'pool'],
            ['name' => 'Gym', 'icon' => 'dumbbell'],
            ['name' => 'Parking', 'icon' => 'car'],
            ['name' => 'Security', 'icon' => 'shield'],
            ['name' => 'Generator', 'icon' => 'bolt'],
            ['name' => 'Air Conditioning', 'icon' => 'air-conditioner'],
            ['name' => 'Garden', 'icon' => 'tree'],
            ['name' => 'Balcony', 'icon' => 'balcony'],
            ['name' => 'Elevator', 'icon' => 'elevator'],
            ['name' => 'WiFi', 'icon' => 'wifi'],
            ['name' => 'Furnished', 'icon' => 'sofa'],
            ['name' => 'Pet Friendly', 'icon' => 'paw'],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }

        // Create Subscription Plans
        SubscriptionPlan::create([
            'name' => 'Basic',
            'description' => 'Perfect for getting started',
            'price_monthly' => 5000,
            'price_annual' => 50000,
            'max_listings' => 5,
            'max_featured_listings' => 0,
            'priority_support' => false,
            'analytics_access' => false,
            'api_access' => false,
            'features' => json_encode(['5 Property Listings', 'Basic Support', 'Property Analytics']),
            'is_active' => true,
            'is_popular' => false,
            'order' => 1,
        ]);

        SubscriptionPlan::create([
            'name' => 'Pro',
            'description' => 'Most popular for professionals',
            'price_monthly' => 15000,
            'price_annual' => 150000,
            'max_listings' => 20,
            'max_featured_listings' => 3,
            'priority_support' => true,
            'analytics_access' => true,
            'api_access' => false,
            'features' => json_encode(['20 Property Listings', '3 Featured Listings', 'Priority Support', 'Advanced Analytics', 'Lead Management']),
            'is_active' => true,
            'is_popular' => true,
            'order' => 2,
        ]);

        SubscriptionPlan::create([
            'name' => 'Enterprise',
            'description' => 'For large organizations',
            'price_monthly' => 50000,
            'price_annual' => 500000,
            'max_listings' => 0, // Unlimited
            'max_featured_listings' => 10,
            'priority_support' => true,
            'analytics_access' => true,
            'api_access' => true,
            'features' => json_encode(['Unlimited Listings', '10 Featured Listings', 'Priority Support', 'Advanced Analytics', 'API Access', 'Custom Branding', 'Dedicated Account Manager']),
            'is_active' => true,
            'is_popular' => false,
            'order' => 3,
        ]);

        // Create Sample Properties
        $this->createSampleProperties($agent1, $agent2, $landlord, $developer);
    }

    private function createSampleProperties($agent1, $agent2, $landlord, $developer)
    {
        $locations = Location::all();
        $categories = PropertyCategory::all();
        $amenities = Amenity::all();

        $properties = [
            [
                'user_id' => $agent1->id,
                'title' => 'Luxury 4 Bedroom Duplex in Lekki',
                'description' => 'Beautiful modern duplex with state-of-the-art facilities in the heart of Lekki Phase 1. Features spacious rooms, modern kitchen, and beautiful garden.',
                'price' => 85000000,
                'property_type' => 'sale',
                'bedrooms' => 4,
                'bathrooms' => 5,
                'land_size' => 500,
                'availability' => 'available',
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'user_id' => $agent1->id,
                'title' => '3 Bedroom Apartment in Victoria Island',
                'description' => 'Serviced apartment with excellent facilities including 24/7 power, security, and swimming pool.',
                'price' => 3500000,
                'property_type' => 'rent',
                'bedrooms' => 3,
                'bathrooms' => 3,
                'land_size' => 200,
                'availability' => 'available',
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'user_id' => $landlord->id,
                'title' => 'Spacious 5 Bedroom Villa in Ikoyi',
                'description' => 'Exquisite villa with panoramic views, private pool, and premium finishes throughout.',
                'price' => 150000000,
                'property_type' => 'sale',
                'bedrooms' => 5,
                'bathrooms' => 6,
                'land_size' => 800,
                'availability' => 'available',
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'user_id' => $developer->id,
                'title' => 'Modern 2 Bedroom Apartment in Maitama',
                'description' => 'Brand new development with contemporary design and smart home features.',
                'price' => 45000000,
                'property_type' => 'sale',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'land_size' => 150,
                'availability' => 'available',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now(),
            ],
            [
                'user_id' => $agent2->id,
                'title' => 'Commercial Office Space in Victoria Island',
                'description' => 'Prime office space in a prestigious building with excellent amenities.',
                'price' => 8000000,
                'property_type' => 'rent',
                'bedrooms' => 0,
                'bathrooms' => 2,
                'land_size' => 300,
                'availability' => 'available',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now(),
            ],
            [
                'user_id' => $agent2->id,
                'title' => 'Waterfront Penthouse in Banana Island',
                'description' => 'Ultra-luxury penthouse with breathtaking ocean views and world-class amenities.',
                'price' => 250000000,
                'property_type' => 'sale',
                'bedrooms' => 6,
                'bathrooms' => 7,
                'land_size' => 600,
                'availability' => 'available',
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($properties as $index => $propertyData) {
            $propertyData['location_id'] = $locations->random()->id;
            $propertyData['property_category_id'] = $categories->random()->id;
            
            $property = Property::create($propertyData);
            
            // Attach random amenities
            $property->amenities()->attach(
                $amenities->random(rand(4, 8))->pluck('id')
            );
        }
    }
}
