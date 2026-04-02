<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::with('features')->orderBy('sort_order')->get();
        return view('admin.pricing-plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.pricing-plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'monthly_price' => 'required|numeric',
            'yearly_price' => 'required|numeric',
        ]);

        $plan = PricingPlan::create($request->except('features'));

        if ($request->has('features')) {
            foreach ($request->features as $featureText) {
                if ($featureText) {
                    $plan->features()->create(['feature_text' => $featureText]);
                }
            }
        }

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing Plan created successfully');
    }

    public function edit(PricingPlan $pricing_plan)
    {
        $pricing_plan->load('features');
        return view('admin.pricing-plans.edit', compact('pricing_plan'));
    }

    public function update(Request $request, PricingPlan $pricing_plan)
    {
        $request->validate([
            'name' => 'required',
            'monthly_price' => 'required|numeric',
            'yearly_price' => 'required|numeric',
        ]);

        $pricing_plan->update($request->except('features'));

        if ($request->has('features')) {
            $pricing_plan->features()->delete();
            foreach ($request->features as $featureText) {
                if ($featureText) {
                    $pricing_plan->features()->create(['feature_text' => $featureText]);
                }
            }
        }

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing Plan updated successfully');
    }

    public function destroy(PricingPlan $pricing_plan)
    {
        $pricing_plan->delete();
        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing Plan deleted successfully');
    }
}
