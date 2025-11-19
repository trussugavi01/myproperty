<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ListingApproved;
use App\Mail\ListingRejected;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with(['user', 'location', 'category']);

        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_published', false);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $properties = $query->latest()->paginate(20);

        return view('admin.listings.index', compact('properties'));
    }

    public function pending()
    {
        $properties = Property::with(['user', 'location', 'category'])
            ->where('is_published', false)
            ->latest()
            ->paginate(20);

        return view('admin.listings.pending', compact('properties'));
    }

    public function show(Property $property)
    {
        $property->load(['user', 'location', 'category', 'images', 'amenities']);

        return view('admin.listings.show', compact('property'));
    }

    public function approve(Property $property)
    {
        $property->approve();

        try {
            Mail::to($property->user->email)
                ->send(new ListingApproved($property));
        } catch (\Exception $e) {
            \Log::error('Failed to send approval email: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Property approved and published successfully.');
    }

    public function reject(Request $request, Property $property)
    {
        $request->validate([
            'rejection_notes' => 'required|string|max:500',
        ]);

        $property->reject($request->rejection_notes);

        try {
            Mail::to($property->user->email)
                ->send(new ListingRejected($property));
        } catch (\Exception $e) {
            \Log::error('Failed to send rejection email: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Property rejected. Owner has been notified.');
    }

    public function feature(Request $request, Property $property)
    {
        $property->update([
            'is_featured' => !$property->is_featured,
        ]);

        $message = $property->is_featured 
            ? 'Property marked as featured.' 
            : 'Property removed from featured.';

        return redirect()->back()->with('success', $message);
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('admin.listings.index')
            ->with('success', 'Property deleted successfully.');
    }
}
