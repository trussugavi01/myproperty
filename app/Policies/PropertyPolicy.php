<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    /**
     * Determine if the user can view any properties.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the property.
     */
    public function view(?User $user, Property $property): bool
    {
        // Public can view published properties
        if ($property->is_published) {
            return true;
        }

        // Owner and admin can view unpublished properties
        if ($user) {
            return $user->id === $property->user_id || $user->isAdmin();
        }

        return false;
    }

    /**
     * Determine if the user can create properties.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['agent', 'landlord', 'developer']);
    }

    /**
     * Determine if the user can update the property.
     */
    public function update(User $user, Property $property): bool
    {
        return $user->id === $property->user_id || $user->isAdmin();
    }

    /**
     * Determine if the user can delete the property.
     */
    public function delete(User $user, Property $property): bool
    {
        return $user->id === $property->user_id || $user->isAdmin();
    }

    /**
     * Determine if the user can approve the property.
     */
    public function approve(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can feature the property.
     */
    public function feature(User $user): bool
    {
        return $user->isAdmin();
    }
}
