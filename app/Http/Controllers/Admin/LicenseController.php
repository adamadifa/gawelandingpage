<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipSubscription;

class LicenseController extends Controller
{
    public function index()
    {
        $licenses = MembershipSubscription::with(['user', 'pricingPlan', 'transaction'])
            ->latest()
            ->paginate(10);

        return view('admin.licenses.index', compact('licenses'));
    }
}
