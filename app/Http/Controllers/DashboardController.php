<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Redirect to onboarding if not completed
        if (!$user->onboarding_completed) {
            return redirect()->route('onboarding.show');
        }

        // Redirect admin to admin dashboard
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // Get user's properties
        $properties = Property::where('user_id', $user->id)
            ->with(['location', 'category', 'primaryImage'])
            ->latest()
            ->take(5)
            ->get();

        // Get statistics
        $stats = [
            'total_listings' => Property::where('user_id', $user->id)->count(),
            'active_listings' => Property::where('user_id', $user->id)
                ->where('is_published', true)
                ->where('availability', 'available')
                ->count(),
            'pending_listings' => Property::where('user_id', $user->id)
                ->where('is_published', false)
                ->count(),
            'total_inquiries' => Inquiry::whereHas('property', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count(),
            'new_inquiries' => Inquiry::whereHas('property', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('status', 'new')->count(),
        ];

        // Get recent inquiries
        $recentInquiries = Inquiry::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with('property')
        ->latest()
        ->take(5)
        ->get();

        // Get total views
        $totalViews = Property::where('user_id', $user->id)->sum('views_count');

        return view('dashboard.index', compact('properties', 'stats', 'recentInquiries', 'totalViews'));
    }
}
