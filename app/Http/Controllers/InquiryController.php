<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Mail\InquiryReceived;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Admin can see all inquiries, others only see inquiries for their properties
        if ($user->isAdmin()) {
            $inquiries = Inquiry::with('property')
                ->latest();
        } else {
            $inquiries = Inquiry::whereHas('property', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with('property')
            ->latest();
        }

        // Filter by status
        if ($request->filled('status')) {
            $inquiries->where('status', $request->status);
        }

        $inquiries = $inquiries->paginate(20);

        return view('inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        // Load property with user relationship for authorization check
        $inquiry->load(['property.user', 'property.location', 'property.primaryImage']);
        
        $this->authorize('view', $inquiry);

        // Mark as read if it's new
        if ($inquiry->status === 'new') {
            $inquiry->markAsRead();
        }

        return view('inquiries.show', compact('inquiry'));
    }

    public function store(StoreInquiryRequest $request)
    {
        $data = $request->validated();
        
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        $inquiry = Inquiry::create($data);
        $inquiry->load('property.user');

        // Send email notification to property owner
        try {
            Mail::to($inquiry->property->user->email)
                ->send(new InquiryReceived($inquiry));
        } catch (\Exception $e) {
            \Log::error('Failed to send inquiry email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Your inquiry has been sent successfully. The property owner will contact you soon.'
        ]);
    }

    public function respond(Request $request, Inquiry $inquiry)
    {
        // Load property relationship for authorization
        $inquiry->load('property.user');
        
        $this->authorize('update', $inquiry);

        $request->validate([
            'response' => 'nullable|string|max:1000',
        ]);

        $inquiry->markAsResponded($request->input('response', 'Responded via email or phone'));

        // TODO: Send email to inquirer with response

        return redirect()->back()
            ->with('success', 'Inquiry marked as responded successfully.');
    }
}
