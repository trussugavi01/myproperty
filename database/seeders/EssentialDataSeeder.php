<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Location;
use App\Models\PropertyCategory;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Seeder;

class EssentialDataSeeder extends Seeder
{
    /**
     * Seed essential data only if it doesn't exist.
     * This is safe to run multiple times.
     */
    public function run(): void
    {
        $this->seedLocations();
        $this->seedCategories();
        $this->seedAmenities();
        $this->seedSubscriptionPlans();
        $this->seedAdminUsers();
    }
    
    private function seedAdminUsers(): void
    {
        // Set specific users as admin
        $adminEmails = [
            'chuksokezie@gmail.com',
        ];
        
        User::whereIn('email', $adminEmails)->update(['role' => 'admin']);
    }

    private function seedLocations(): void
    {
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
            Location::firstOrCreate(
                ['name' => $location['name'], 'city' => $location['city']],
                $location
            );
        }
    }

    private function seedCategories(): void
    {
        $categories = [
            ['name' => 'Apartment', 'description' => 'Multi-unit residential buildings', 'icon' => 'building', 'order' => 1],
            ['name' => 'House', 'description' => 'Single-family homes', 'icon' => 'home', 'order' => 2],
            ['name' => 'Villa', 'description' => 'Luxury standalone properties', 'icon' => 'castle', 'order' => 3],
            ['name' => 'Duplex', 'description' => 'Two-story residential units', 'icon' => 'building-2', 'order' => 4],
            ['name' => 'Land', 'description' => 'Vacant plots and land', 'icon' => 'map', 'order' => 5],
            ['name' => 'Commercial', 'description' => 'Office and retail spaces', 'icon' => 'briefcase', 'order' => 6],
            ['name' => 'Penthouse', 'description' => 'Top-floor luxury apartments', 'icon' => 'building-skyscraper', 'order' => 7],
            ['name' => 'Warehouse', 'description' => 'Storage and industrial spaces', 'icon' => 'warehouse', 'order' => 8],
        ];

        foreach ($categories as $category) {
            PropertyCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }

    private function seedAmenities(): void
    {
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
            Amenity::firstOrCreate(
                ['name' => $amenity['name']],
                $amenity
            );
        }
    }

    private function seedSubscriptionPlans(): void
    {
        $plans = [
            [
                'name' => 'Starter',
                'description' => 'Perfect for individual agents getting started',
                'price_monthly' => 15000,
                'price_annual' => 150000,
                'max_listings' => 10,
                'max_featured_listings' => 1,
                'priority_support' => false,
                'analytics_access' => true,
                'api_access' => false,
                'features' => json_encode(['10 Property Listings', '1 Featured Listing', 'Basic Analytics', 'Email Support', '30-Day Free Trial']),
                'is_active' => true,
                'is_popular' => false,
                'trial_days' => 30,
                'order' => 1,
            ],
            [
                'name' => 'Professional',
                'description' => 'Most popular for growing businesses',
                'price_monthly' => 25000,
                'price_annual' => 250000,
                'max_listings' => 30,
                'max_featured_listings' => 5,
                'priority_support' => true,
                'analytics_access' => true,
                'api_access' => false,
                'features' => json_encode(['30 Property Listings', '5 Featured Listings', 'Advanced Analytics', 'Priority Support', 'Lead Management', '30-Day Free Trial']),
                'is_active' => true,
                'is_popular' => true,
                'trial_days' => 30,
                'order' => 2,
            ],
            [
                'name' => 'Enterprise',
                'description' => 'For large agencies and developers',
                'price_monthly' => 50000,
                'price_annual' => 500000,
                'max_listings' => 0,
                'max_featured_listings' => 15,
                'priority_support' => true,
                'analytics_access' => true,
                'api_access' => true,
                'features' => json_encode(['Unlimited Listings', '15 Featured Listings', 'Advanced Analytics', 'Priority Support', 'API Access', 'Custom Branding', 'Dedicated Account Manager', '30-Day Free Trial']),
                'is_active' => true,
                'is_popular' => false,
                'trial_days' => 30,
                'order' => 3,
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::updateOrCreate(
                ['name' => $plan['name']],
                $plan
            );
        }

        // Remove old plan names if they exist
        SubscriptionPlan::whereIn('name', ['Basic', 'Pro'])->delete();
    }
}
