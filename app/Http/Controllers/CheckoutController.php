<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use App\Models\MembershipTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Jenssegers\Agent\Agent;

class CheckoutController extends Controller
{
    public function index(PricingPlan $pricingPlan)
    {
        $subscriptionId = request('subscription_id');
        $agent = new Agent();

        if ($agent->isMobile() || $agent->isTablet()) {
            return view('landing.checkout-mobile', compact('pricingPlan', 'subscriptionId'));
        }

        return view('landing.checkout', compact('pricingPlan', 'subscriptionId'));
    }

    public function store(Request $request, PricingPlan $pricingPlan)
    {
        $isGuest = auth()->guest();

        $rules = [
            'plan_type' => 'required|in:monthly,yearly',
            'payment_proof' => 'required|image|max:2048',
            'terms' => 'accepted',
        ];

        if ($isGuest) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|string|email|max:255|unique:users';
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        if ($isGuest) {
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'role' => 'member',
            ]);

            auth()->login($user);
        }

        $amount = $request->plan_type === 'monthly' ? $pricingPlan->monthly_price : $pricingPlan->yearly_price;

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        MembershipTransaction::create([
            'user_id' => auth()->id(),
            'pricing_plan_id' => $pricingPlan->id,
            'subscription_id' => $request->subscription_id,
            'plan_type' => $request->plan_type,
            'amount' => $amount,
            'payment_proof' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('member.dashboard')->with('success', 'Pembayaran Anda telah dikirim dan sedang menunggu persetujuan admin.');
    }

    public function status()
    {
        $transaction = MembershipTransaction::where('user_id', auth()->id())
            ->latest()
            ->first();

        $subscription = auth()->user()->subscription;

        return view('landing.status', compact('transaction', 'subscription'));
    }
}
