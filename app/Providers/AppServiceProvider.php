<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use App\Models\Inquiry;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        // Register policies
        Gate::policy(\App\Models\Property::class, \App\Policies\PropertyPolicy::class);
        Gate::policy(\App\Models\Inquiry::class, \App\Policies\InquiryPolicy::class);
        Gate::policy(\App\Models\User::class, \App\Policies\UserPolicy::class);

        // Share stats with all views for notification badge
        View::composer('layouts.app', function ($view) {
            if (auth()->check() && !auth()->user()->isAdmin()) {
                $stats = [
                    'new_inquiries' => Inquiry::whereHas('property', function($query) {
                        $query->where('user_id', auth()->id());
                    })
                    ->where('status', 'new')
                    ->count()
                ];
                
                $view->with('stats', $stats);
            }
        });
    }
}
