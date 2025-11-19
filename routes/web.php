<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ListingController as AdminListingController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\OnboardingController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
Route::get('/pricing', [BillingController::class, 'pricing'])->name('pricing');

// Legal Pages
Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');

// Auth Routes (Laravel Breeze will add these)
require __DIR__.'/auth.php';

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Onboarding
    Route::get('/onboarding', [OnboardingController::class, 'show'])
        ->name('onboarding.show');
    Route::post('/onboarding', [OnboardingController::class, 'store'])
        ->name('onboarding.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard (All authenticated users)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Agent Routes
    Route::middleware(['role:agent'])->prefix('agent')->name('agent.')->group(function () {
        Route::resource('properties', PropertyController::class)->except(['index', 'show']);
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('/inquiries/{inquiry}/respond', [InquiryController::class, 'respond'])->name('inquiries.respond');
    });

    // Landlord Routes
    Route::middleware(['role:landlord'])->prefix('landlord')->name('landlord.')->group(function () {
        Route::resource('properties', PropertyController::class)->except(['index', 'show']);
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('/inquiries/{inquiry}/respond', [InquiryController::class, 'respond'])->name('inquiries.respond');
    });

    // Developer Routes
    Route::middleware(['role:developer'])->prefix('developer')->name('developer.')->group(function () {
        Route::resource('properties', PropertyController::class)->except(['index', 'show']);
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('/inquiries/{inquiry}/respond', [InquiryController::class, 'respond'])->name('inquiries.respond');
    });

    // Billing Routes (All roles except admin)
    Route::middleware(['role:agent,landlord,developer'])->prefix('billing')->name('billing.')->group(function () {
        Route::get('/plans', [BillingController::class, 'plans'])->name('plans');
        Route::get('/checkout/{plan}', [BillingController::class, 'checkout'])->name('checkout');
        Route::post('/subscribe', [BillingController::class, 'subscribe'])->name('subscribe');
        Route::get('/subscriptions', [BillingController::class, 'subscriptions'])->name('subscriptions');
        Route::post('/subscriptions/{subscription}/cancel', [BillingController::class, 'cancel'])->name('subscriptions.cancel');
    });

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // User Management
        Route::resource('users', AdminUserController::class);
        
        // Listing Management
        Route::get('/listings', [AdminListingController::class, 'index'])->name('listings.index');
        Route::get('/listings/pending', [AdminListingController::class, 'pending'])->name('listings.pending');
        Route::get('/listings/{property}', [AdminListingController::class, 'show'])->name('listings.show');
        Route::patch('/listings/{property}/approve', [AdminListingController::class, 'approve'])->name('listings.approve');
        Route::patch('/listings/{property}/reject', [AdminListingController::class, 'reject'])->name('listings.reject');
        Route::patch('/listings/{property}/feature', [AdminListingController::class, 'feature'])->name('listings.feature');
        Route::delete('/listings/{property}', [AdminListingController::class, 'destroy'])->name('listings.destroy');
        
        // Inquiry Management
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('/inquiries/{inquiry}/respond', [InquiryController::class, 'respond'])->name('inquiries.respond');
        
        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/listings', [ReportController::class, 'listings'])->name('reports.listings');
        Route::get('/reports/inquiries', [ReportController::class, 'inquiries'])->name('reports.inquiries');
        Route::get('/reports/revenue', [ReportController::class, 'revenue'])->name('reports.revenue');
        
        // Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::get('/settings/categories', [SettingsController::class, 'categories'])->name('settings.categories');
        Route::post('/settings/categories', [SettingsController::class, 'storeCategory'])->name('settings.categories.store');
        Route::patch('/settings/categories/{category}', [SettingsController::class, 'updateCategory'])->name('settings.categories.update');
        Route::delete('/settings/categories/{category}', [SettingsController::class, 'deleteCategory'])->name('settings.categories.delete');
        
        Route::get('/settings/locations', [SettingsController::class, 'locations'])->name('settings.locations');
        Route::post('/settings/locations', [SettingsController::class, 'storeLocation'])->name('settings.locations.store');
        Route::patch('/settings/locations/{location}', [SettingsController::class, 'updateLocation'])->name('settings.locations.update');
        Route::delete('/settings/locations/{location}', [SettingsController::class, 'deleteLocation'])->name('settings.locations.delete');
        
        Route::get('/settings/amenities', [SettingsController::class, 'amenities'])->name('settings.amenities');
        Route::post('/settings/amenities', [SettingsController::class, 'storeAmenity'])->name('settings.amenities.store');
        Route::patch('/settings/amenities/{amenity}', [SettingsController::class, 'updateAmenity'])->name('settings.amenities.update');
        Route::delete('/settings/amenities/{amenity}', [SettingsController::class, 'deleteAmenity'])->name('settings.amenities.delete');
        
        Route::get('/settings/plans', [SettingsController::class, 'plans'])->name('settings.plans');
        Route::post('/settings/plans', [SettingsController::class, 'storePlan'])->name('settings.plans.store');
        Route::patch('/settings/plans/{plan}', [SettingsController::class, 'updatePlan'])->name('settings.plans.update');
        Route::delete('/settings/plans/{plan}', [SettingsController::class, 'deletePlan'])->name('settings.plans.delete');
    });
});

// Debug route
require __DIR__.'/debug.php';
