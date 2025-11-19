<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Location;
use App\Models\PropertyCategory;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    // Categories
    public function categories()
    {
        $categories = PropertyCategory::orderBy('order')->get();
        return view('admin.settings.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:property_categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        PropertyCategory::create($request->all());

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function updateCategory(Request $request, PropertyCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:property_categories,name,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $category->update($request->all());

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function deleteCategory(PropertyCategory $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    // Locations
    public function locations()
    {
        $locations = Location::orderBy('city')->get();
        return view('admin.settings.locations', compact('locations'));
    }

    public function storeLocation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Location::create($request->all());

        return redirect()->back()->with('success', 'Location created successfully.');
    }

    public function updateLocation(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $location->update($request->all());

        return redirect()->back()->with('success', 'Location updated successfully.');
    }

    public function deleteLocation(Location $location)
    {
        $location->delete();
        return redirect()->back()->with('success', 'Location deleted successfully.');
    }

    // Amenities
    public function amenities()
    {
        $amenities = Amenity::orderBy('name')->get();
        return view('admin.settings.amenities', compact('amenities'));
    }

    public function storeAmenity(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:amenities',
            'icon' => 'nullable|string|max:255',
        ]);

        Amenity::create($request->all());

        return redirect()->back()->with('success', 'Amenity created successfully.');
    }

    public function updateAmenity(Request $request, Amenity $amenity)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:amenities,name,' . $amenity->id,
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $amenity->update($request->all());

        return redirect()->back()->with('success', 'Amenity updated successfully.');
    }

    public function deleteAmenity(Amenity $amenity)
    {
        $amenity->delete();
        return redirect()->back()->with('success', 'Amenity deleted successfully.');
    }

    // Subscription Plans
    public function plans()
    {
        $plans = SubscriptionPlan::orderBy('order')->get();
        return view('admin.settings.plans', compact('plans'));
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_monthly' => 'required|numeric|min:0',
            'price_annual' => 'required|numeric|min:0',
            'max_listings' => 'required|integer|min:0',
            'max_featured_listings' => 'required|integer|min:0',
        ]);

        SubscriptionPlan::create($request->all());

        return redirect()->back()->with('success', 'Plan created successfully.');
    }

    public function updatePlan(Request $request, SubscriptionPlan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_monthly' => 'required|numeric|min:0',
            'price_annual' => 'required|numeric|min:0',
            'max_listings' => 'required|integer|min:0',
            'max_featured_listings' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_popular' => 'boolean',
        ]);

        $plan->update($request->all());

        return redirect()->back()->with('success', 'Plan updated successfully.');
    }

    public function deletePlan(SubscriptionPlan $plan)
    {
        $plan->delete();
        return redirect()->back()->with('success', 'Plan deleted successfully.');
    }
}
