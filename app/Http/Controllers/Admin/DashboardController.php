<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Property;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', '!=', 'admin')->count(),
            'total_properties' => Property::count(),
            'pending_approvals' => Property::where('is_published', false)->count(),
            'total_inquiries' => Inquiry::count(),
            'new_inquiries' => Inquiry::where('status', 'new')->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
        ];

        $recentProperties = Property::with(['user', 'location', 'category'])
            ->latest()
            ->take(10)
            ->get();

        $recentUsers = User::where('role', '!=', 'admin')
            ->latest()
            ->take(10)
            ->get();

        $pendingApprovals = Property::with(['user', 'location'])
            ->where('is_published', false)
            ->latest()
            ->take(5)
            ->get();

        // Monthly stats for charts
        $monthlyListings = Property::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyInquiries = Inquiry::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentProperties',
            'recentUsers',
            'pendingApprovals',
            'monthlyListings',
            'monthlyInquiries'
        ));
    }
}
