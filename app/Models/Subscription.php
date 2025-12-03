<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'billing_cycle',
        'amount',
        'status',
        'starts_at',
        'ends_at',
        'trial_ends_at',
        'is_trial',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'trial_ends_at' => 'datetime',
            'is_trial' => 'boolean',
            'cancelled_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('ends_at', '>', now());
    }

    public function scopeExpired($query)
    {
        return $query->where('ends_at', '<=', now());
    }

    // Helper methods
    public function isActive(): bool
    {
        return $this->status === 'active' && $this->ends_at > now();
    }

    public function isOnTrial(): bool
    {
        return $this->is_trial && $this->trial_ends_at && $this->trial_ends_at > now();
    }

    public function trialDaysRemaining(): int
    {
        if (!$this->isOnTrial()) {
            return 0;
        }
        return now()->diffInDays($this->trial_ends_at);
    }

    public function cancel()
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);
    }

    public function activate()
    {
        $this->update([
            'status' => 'active',
            'starts_at' => now(),
        ]);
    }

    public function startTrial(int $days = 30)
    {
        $this->update([
            'status' => 'active',
            'is_trial' => true,
            'starts_at' => now(),
            'trial_ends_at' => now()->addDays($days),
            'ends_at' => now()->addDays($days),
        ]);
    }

    public function convertFromTrial()
    {
        $this->update([
            'is_trial' => false,
            'trial_ends_at' => null,
            'starts_at' => now(),
            'ends_at' => $this->billing_cycle === 'annual' 
                ? now()->addYear() 
                : now()->addMonth(),
        ]);
    }
}
