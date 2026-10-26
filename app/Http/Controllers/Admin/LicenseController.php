<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipSubscription;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index(Request $request)
    {
        $query = MembershipSubscription::with(['user', 'pricingPlan', 'transaction']);

        // Search query
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('license_code', 'like', "%{$q}%")
                    ->orWhere('app_url', 'like', "%{$q}%")
                    ->orWhereHas('user', function($u) use ($q) {
                        $u->where('name', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%");
                    });
            });
        }

        // Filter status
        if ($request->filled('status') && $request->status !== 'all') {
            if ($request->status === 'active') {
                $query->where('status', 'active')
                      ->where('ends_at', '>', now());
            } elseif ($request->status === 'expired') {
                $query->where('ends_at', '<=', now());
            } elseif ($request->status === 'expiring_soon') {
                $query->where('status', 'active')
                      ->where('ends_at', '>', now())
                      ->where('ends_at', '<=', now()->addDays(30));
            }
        }

        // Filter plan
        if ($request->filled('plan_id') && $request->plan_id !== 'all') {
            $query->where('pricing_plan_id', $request->plan_id);
        }

        $licenses = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => MembershipSubscription::count(),
            'active' => MembershipSubscription::where('status', 'active')->where('ends_at', '>', now())->count(),
            'expiring_soon' => MembershipSubscription::where('status', 'active')
                ->where('ends_at', '>', now())
                ->where('ends_at', '<=', now()->addDays(30))->count(),
            'expired' => MembershipSubscription::where('ends_at', '<=', now())->count(),
            'running_apps' => MembershipSubscription::where('app_status', 'running')->count(),
        ];

        $pricing_plans = PricingPlan::all();

        return view('admin.licenses.index', compact('licenses', 'stats', 'pricing_plans'));
    }
}
