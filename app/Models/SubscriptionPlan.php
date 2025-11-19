<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_monthly',
        'price_annual',
        'max_listings',
        'max_featured_listings',
        'priority_support',
        'analytics_access',
        'api_access',
        'features',
        'is_active',
        'is_popular',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'price_monthly' => 'decimal:2',
            'price_annual' => 'decimal:2',
            'priority_support' => 'boolean',
            'analytics_access' => 'boolean',
            'api_access' => 'boolean',
            'features' => 'array',
            'is_active' => 'boolean',
            'is_popular' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($plan) {
            if (empty($plan->slug)) {
                $plan->slug = Str::slug($plan->name);
            }
        });
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function getFormattedPriceMonthlyAttribute()
    {
        return '₦' . number_format($this->price_monthly, 2);
    }

    public function getFormattedPriceAnnualAttribute()
    {
        return '₦' . number_format($this->price_annual, 2);
    }
}
