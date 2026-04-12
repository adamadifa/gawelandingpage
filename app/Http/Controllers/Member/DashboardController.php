<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\MembershipTransaction;
use App\Models\MembershipSubscription;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $agent = new Agent();
        
        $subscriptions = MembershipSubscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->with('pricingPlan')
            ->get();

        $transactions = MembershipTransaction::where('user_id', $user->id)
            ->with(['pricingPlan', 'subscription'])
            ->latest()
            ->paginate(10);

        // Stats Summary
        $totalSpent = MembershipTransaction::where('user_id', $user->id)
            ->where('status', 'approved')
            ->sum('amount');
            
        $activeCount = $subscriptions->count();

        $view = $agent->isMobile() ? 'member.dashboard_mobile' : 'member.dashboard';

        return view($view, compact('subscriptions', 'transactions', 'totalSpent', 'activeCount'));
    }
}
