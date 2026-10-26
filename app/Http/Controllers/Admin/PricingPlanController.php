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

        $data = $request->except('features');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $plan = PricingPlan::create($data);

        if ($request->has('features')) {
            foreach ($request->features as $index => $featureText) {
                if (trim($featureText)) {
                    $plan->features()->create([
                        'feature_text' => trim($featureText),
                        'sort_order' => $index,
                        'is_included' => true
                    ]);
                }
            }
        }

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Paket langganan berhasil ditambahkan');
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

        $data = $request->except('features');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $pricing_plan->update($data);

        if ($request->has('features')) {
            $pricing_plan->features()->delete();
            foreach ($request->features as $index => $featureText) {
                if (trim($featureText)) {
                    $pricing_plan->features()->create([
                        'feature_text' => trim($featureText),
                        'sort_order' => $index,
                        'is_included' => true
                    ]);
                }
            }
        }

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Paket langganan berhasil diperbarui');
    }

    public function destroy(PricingPlan $pricing_plan)
    {
        $pricing_plan->delete();
        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing Plan deleted successfully');
    }
}
