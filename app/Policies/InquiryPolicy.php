<?php

namespace App\Policies;

use App\Models\Inquiry;
use App\Models\User;

class InquiryPolicy
{
    /**
     * Determine if the user can view any inquiries.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the inquiry.
     */
    public function view(User $user, Inquiry $inquiry): bool
    {
        // Property owner or admin can view
        return $inquiry->property->user_id === $user->id || $user->isAdmin();
    }

    /**
     * Determine if the user can update the inquiry.
     */
    public function update(User $user, Inquiry $inquiry): bool
    {
        // Property owner or admin can update
        return $inquiry->property->user_id === $user->id || $user->isAdmin();
    }

    /**
     * Determine if the user can delete the inquiry.
     */
    public function delete(User $user, Inquiry $inquiry): bool
    {
        // Property owner or admin can delete
        return $inquiry->property->user_id === $user->id || $user->isAdmin();
    }
}
