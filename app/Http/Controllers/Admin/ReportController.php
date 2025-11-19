<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Payment;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function listings(Request $request)
    {
        $period = $request->get('period', '30days');
        $startDate = $this->getStartDate($period);

        $stats = [
            'total_listings' => Property::where('created_at', '>=', $startDate)->count(),
            'published_listings' => Property::where('created_at', '>=', $startDate)
                ->where('is_published', true)->count(),
            'pending_listings' => Property::where('created_at', '>=', $startDate)
                ->where('is_published', false)->count(),
            'total_views' => Property::where('created_at', '>=', $startDate)->sum('views_count'),
            'avg_price' => Property::where('created_at', '>=', $startDate)->avg('price'),
        ];

        // Listings by type
        $listingsByType = Property::select('property_type', DB::raw('count(*) as count'))
            ->where('created_at', '>=', $startDate)
            ->groupBy('property_type')
            ->get();

        // Listings by category
        $listingsByCategory = Property::select('property_categories.name', DB::raw('count(properties.id) as count'))
            ->join('property_categories', 'properties.property_category_id', '=', 'property_categories.id')
            ->where('properties.created_at', '>=', $startDate)
            ->groupBy('property_categories.name')
            ->get();

        // Daily listings trend
        $dailyTrend = Property::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.reports.listings', compact('stats', 'listingsByType', 'listingsByCategory', 'dailyTrend', 'period'));
    }

    public function inquiries(Request $request)
    {
        $period = $request->get('period', '30days');
        $startDate = $this->getStartDate($period);

        $stats = [
            'total_inquiries' => Inquiry::where('created_at', '>=', $startDate)->count(),
            'new_inquiries' => Inquiry::where('created_at', '>=', $startDate)
                ->where('status', 'new')->count(),
            'responded_inquiries' => Inquiry::where('created_at', '>=', $startDate)
                ->where('status', 'responded')->count(),
            'avg_response_time' => Inquiry::where('created_at', '>=', $startDate)
                ->whereNotNull('responded_at')
                ->avg(DB::raw('TIMESTAMPDIFF(HOUR, created_at, responded_at)')),
        ];

        // Inquiries by status
        $inquiriesByStatus = Inquiry::select('status', DB::raw('count(*) as count'))
            ->where('created_at', '>=', $startDate)
            ->groupBy('status')
            ->get();

        // Daily inquiries trend
        $dailyTrend = Inquiry::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.reports.inquiries', compact('stats', 'inquiriesByStatus', 'dailyTrend', 'period'));
    }

    public function revenue(Request $request)
    {
        $period = $request->get('period', '30days');
        $startDate = $this->getStartDate($period);

        try {
            $stats = [
                'total_revenue' => Payment::where('created_at', '>=', $startDate)
                    ->where('status', 'completed')->sum('amount') ?? 0,
                'total_transactions' => Payment::where('created_at', '>=', $startDate)
                    ->where('status', 'completed')->count(),
                'pending_payments' => Payment::where('created_at', '>=', $startDate)
                    ->where('status', 'pending')->sum('amount') ?? 0,
                'avg_transaction' => Payment::where('created_at', '>=', $startDate)
                    ->where('status', 'completed')->avg('amount') ?? 0,
            ];

            // Revenue by payment method
            $revenueByMethod = Payment::select('payment_method', DB::raw('sum(amount) as total'))
                ->where('created_at', '>=', $startDate)
                ->where('status', 'completed')
                ->groupBy('payment_method')
                ->get();

            // Daily revenue trend
            $dailyTrend = Payment::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total'))
                ->where('created_at', '>=', $startDate)
                ->where('status', 'completed')
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        } catch (\Exception $e) {
            // If payments table doesn't exist or there's an error, return empty data
            $stats = [
                'total_revenue' => 0,
                'total_transactions' => 0,
                'pending_payments' => 0,
                'avg_transaction' => 0,
            ];
            $revenueByMethod = collect([]);
            $dailyTrend = collect([]);
        }

        return view('admin.reports.revenue', compact('stats', 'revenueByMethod', 'dailyTrend', 'period'));
    }

    private function getStartDate($period)
    {
        return match($period) {
            '7days' => now()->subDays(7),
            '30days' => now()->subDays(30),
            '90days' => now()->subDays(90),
            '1year' => now()->subYear(),
            default => now()->subDays(30),
        };
    }
}
