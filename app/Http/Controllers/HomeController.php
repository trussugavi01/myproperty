<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\Location;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $featuredProperties = Property::with(['location', 'category', 'primaryImage'])
            ->published()
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $recentProperties = Property::with(['location', 'category', 'primaryImage'])
            ->published()
            ->latest()
            ->take(8)
            ->get();

        $categories = PropertyCategory::where('is_active', true)
            ->orderBy('order')
            ->get();

        $locations = Location::where('is_active', true)
            ->withCount('properties')
            ->having('properties_count', '>', 0)
            ->take(8)
            ->get();

        return view('home', compact('featuredProperties', 'recentProperties', 'categories', 'locations'));
    }
}
