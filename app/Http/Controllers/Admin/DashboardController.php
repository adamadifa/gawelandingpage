<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\PricingPlan;
use App\Models\Faq;
use App\Models\TrustedCompany;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\MembershipTransaction;
use App\Models\MembershipSubscription;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $cms_stats = [
            'features' => Feature::count(),
            'plans' => PricingPlan::count(),
            'faqs' => Faq::count(),
            'companies' => TrustedCompany::count(),
            'testimonials' => Testimonial::count(),
        ];

        $business_stats = [
            'total_members' => User::where('role', 'member')->count(),
            'active_licenses' => MembershipSubscription::where('ends_at', '>', Carbon::now())->count(),
            'total_revenue' => MembershipTransaction::where('status', 'approved')->sum('amount'),
            'pending_orders' => MembershipTransaction::where('status', 'pending')->count(),
        ];

        // Revenue Chart Data (Last 6 Months)
        $months = [];
        $revenue_data = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            $revenue_data[] = MembershipTransaction::where('status', 'approved')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('amount');
        }

        // Recent Transactions
        $recent_transactions = MembershipTransaction::with(['user', 'pricingPlan'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('cms_stats', 'business_stats', 'months', 'revenue_data', 'recent_transactions'));
    }
}
