<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\PricingPlan;
use App\Models\Faq;
use App\Models\TrustedCompany;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'features' => Feature::count(),
            'plans' => PricingPlan::count(),
            'faqs' => Faq::count(),
            'companies' => TrustedCompany::count(),
            'testimonials' => Testimonial::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
