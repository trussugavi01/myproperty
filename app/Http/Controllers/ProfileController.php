<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        $user->load(['landlordProfile', 'developerProfile']);

        return view('profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Update user
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? $user->phone,
            'avatar' => $data['avatar'] ?? $user->avatar,
        ]);

        // Update role-specific profile
        if ($user->isLandlord() && $user->landlordProfile) {
            $user->landlordProfile->update([
                'company_name' => $data['company_name'] ?? null,
                'bio' => $data['bio'] ?? null,
                'business_registration' => $data['business_registration'] ?? null,
                'tax_id' => $data['tax_id'] ?? null,
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'country' => $data['country'] ?? 'Nigeria',
                'preferred_contact_method' => $data['preferred_contact_method'] ?? 'email',
            ]);
        } elseif ($user->isDeveloper() && $user->developerProfile) {
            $user->developerProfile->update([
                'company_name' => $data['company_name'] ?? null,
                'bio' => $data['bio'] ?? null,
                'business_registration' => $data['business_registration'] ?? null,
                'cac_number' => $data['cac_number'] ?? null,
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'country' => $data['country'] ?? 'Nigeria',
                'website' => $data['website'] ?? null,
                'years_in_business' => $data['years_in_business'] ?? null,
            ]);
        }

        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated successfully.');
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        auth()->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
