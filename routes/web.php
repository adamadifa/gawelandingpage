<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\PricingPlanController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TrustedCompanyController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\HeroStatsCardController;
use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\FeatureSectionController;
use App\Http\Controllers\Admin\FaqSectionController;
use App\Http\Controllers\Admin\MembershipController as AdminMembershipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('site-settings', SiteSettingController::class)->only(['index', 'update']);
    Route::resource('hero-sections', HeroSectionController::class);
    Route::resource('hero-stats-cards', HeroStatsCardController::class);
    Route::resource('features', FeatureController::class);
    Route::resource('pricing-plans', PricingPlanController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('trusted-companies', TrustedCompanyController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('about-sections', AboutSectionController::class);
    Route::resource('feature-sections', FeatureSectionController::class);
    Route::resource('faq-sections', FaqSectionController::class);

    // Membership Management
    Route::get('/memberships', [AdminMembershipController::class, 'index'])->name('memberships.index');
    Route::get('/memberships/{membershipTransaction}', [AdminMembershipController::class, 'show'])->name('memberships.show');
    Route::post('/memberships/{membershipTransaction}/approve', [AdminMembershipController::class, 'approve'])->name('memberships.approve');
    Route::post('/memberships/{membershipTransaction}/reject', [AdminMembershipController::class, 'reject'])->name('memberships.reject');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Subscription Status
    Route::get('/membership/status', [CheckoutController::class, 'status'])->name('membership.status');

    // Member Dashboard
    Route::prefix('member')->name('member.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Member\DashboardController::class, 'index'])->name('dashboard');
    });
});

// Subscription & Checkout (Accessible to Guests for Registration)
Route::get('/checkout/{pricingPlan}', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/{pricingPlan}', [CheckoutController::class, 'store'])->name('checkout.store');

require __DIR__.'/auth.php';
