<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\HeroSection;
use App\Models\Feature;
use App\Models\PricingPlan;
use App\Models\Faq;
use App\Models\TrustedCompany;
use App\Models\Testimonial;
use App\Models\HeroStatsCard;
use App\Models\AboutSection;
use App\Models\FeatureSection;
use App\Models\FaqSection;
use Illuminate\Http\Request;

use Jenssegers\Agent\Agent;

class LandingPageController extends Controller
{
    public function index()
    {
        $agent = new Agent();
        $settings = SiteSetting::pluck('value', 'key');
        $hero = HeroSection::where('is_active', true)->first();
        $features = Feature::where('is_active', true)->orderBy('sort_order')->get();
        $pricing = PricingPlan::with('features')->where('is_active', true)->orderBy('sort_order')->get();
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
        $companies = TrustedCompany::where('is_active', true)->orderBy('sort_order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('sort_order')->get();
        $hero_stats = HeroStatsCard::where('is_active', true)->get();
        $about = AboutSection::where('is_active', true)->first();
        $feature_section = FeatureSection::where('is_active', true)->first();
        $faq_section = FaqSection::where('is_active', true)->first();

        $data = compact(
            'settings', 'hero', 'features', 'pricing', 'faqs', 'companies', 'testimonials', 'hero_stats', 'about', 'feature_section', 'faq_section'
        );

        if ($agent->isMobile() || $agent->isTablet()) {
            return view('landing.mobile', $data);
        }

        return view('landing.index', $data);
    }
}
