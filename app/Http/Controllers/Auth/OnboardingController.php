<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\OnboardingRequest;
use App\Models\DeveloperProfile;
use App\Models\LandlordProfile;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        if ($user->onboarding_completed) {
            return redirect()->route('dashboard');
        }

        return view('auth.onboarding', compact('user'));
    }

    public function store(OnboardingRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();

        // Update user
        $user->update([
            'phone' => $data['phone'],
            'onboarding_completed' => true,
        ]);

        // Create role-specific profile
        if ($user->isLandlord()) {
            LandlordProfile::create([
                'user_id' => $user->id,
                'company_name' => $data['company_name'] ?? null,
                'bio' => $data['bio'] ?? null,
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'preferred_contact_method' => $data['preferred_contact_method'] ?? 'email',
            ]);
        } elseif ($user->isDeveloper()) {
            DeveloperProfile::create([
                'user_id' => $user->id,
                'company_name' => $data['company_name'],
                'bio' => $data['bio'] ?? null,
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'website' => $data['website'] ?? null,
                'years_in_business' => $data['years_in_business'] ?? null,
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Welcome! Your profile has been set up successfully.');
    }
}
