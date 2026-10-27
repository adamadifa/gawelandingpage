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
use App\Http\Controllers\Admin\LicenseController;
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
    Route::post('/memberships/{subscription}/update-subscription', [AdminMembershipController::class, 'updateSubscription'])->name('memberships.update-subscription');

    // Licenses
    Route::get('/licenses', [LicenseController::class, 'index'])->name('licenses.index');

    // Source Code Claims Management
    Route::get('/source-code-claims', [\App\Http\Controllers\Admin\SourceCodeClaimController::class, 'index'])->name('source-code-claims.index');
    Route::get('/source-code-claims/{source_code_claim}', [\App\Http\Controllers\Admin\SourceCodeClaimController::class, 'show'])->name('source-code-claims.show');
    Route::post('/source-code-claims/{source_code_claim}/approve', [\App\Http\Controllers\Admin\SourceCodeClaimController::class, 'approve'])->name('source-code-claims.approve');
    Route::post('/source-code-claims/{source_code_claim}/reject', [\App\Http\Controllers\Admin\SourceCodeClaimController::class, 'reject'])->name('source-code-claims.reject');
    Route::put('/source-code-claims/settings', [\App\Http\Controllers\Admin\SourceCodeClaimController::class, 'updateSettings'])->name('source-code-claims.settings');
});

Route::middleware('auth')->group(function () {
    // Generic Dashboard Route
    Route::get('/dashboard', function () {
        return auth()->user()?->isAdmin() 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('member.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Subscription Status
    Route::get('/membership/status', [CheckoutController::class, 'status'])->name('membership.status');

    // Member Dashboard & Source Code
    Route::prefix('member')->name('member.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Member\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/source-code', [\App\Http\Controllers\Member\SourceCodeController::class, 'index'])->name('source-code');
    });
});

// Source Code Claim (Registration & Verification for Source Code Buyers)
Route::redirect('/klaimsource', '/klaim-source-code');
Route::redirect('/klaim-source', '/klaim-source-code');
Route::get('/klaim-source-code', [\App\Http\Controllers\SourceCodeClaimController::class, 'create'])->name('source-code-claim.create');
Route::post('/klaim-source-code', [\App\Http\Controllers\SourceCodeClaimController::class, 'store'])->name('source-code-claim.store');

// Subscription & Checkout (Accessible to Guests for Registration)
Route::get('/checkout/{pricingPlan}', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/{pricingPlan}', [CheckoutController::class, 'store'])->name('checkout.store');

require __DIR__.'/auth.php';
