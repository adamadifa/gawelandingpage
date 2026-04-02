<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipTransaction;
use App\Models\MembershipSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MembershipController extends Controller
{
    public function index()
    {
        $transactions = MembershipTransaction::with(['user', 'pricingPlan'])
            ->latest()
            ->paginate(10);

        return view('admin.memberships.index', compact('transactions'));
    }

    public function show(MembershipTransaction $membershipTransaction)
    {
        $membershipTransaction->load(['user', 'pricingPlan']);
        return view('admin.memberships.show', compact('membershipTransaction'));
    }

    public function approve(Request $request, MembershipTransaction $membershipTransaction)
    {
        if ($membershipTransaction->status !== 'pending') {
            return back()->with('error', 'Transaksi ini sudah diproses.');
        }

        // Calculate days to add based on plan type
        $daysToAdd = $membershipTransaction->plan_type === 'yearly' ? 365 : 30;

        // Determine which subscription to update or create
        if ($membershipTransaction->subscription_id) {
            // Specific Extension
            $existingSubscription = MembershipSubscription::find($membershipTransaction->subscription_id);
            if ($existingSubscription) {
                $newEndsAt = \Carbon\Carbon::parse($existingSubscription->ends_at)->addDays($daysToAdd);
                $existingSubscription->update([
                    'pricing_plan_id' => $membershipTransaction->pricing_plan_id,
                    'transaction_id' => $membershipTransaction->id,
                    'ends_at' => $newEndsAt,
                ]);
                $msg = 'Langganan berhasil diperpanjang.';
            } else {
                $msg = 'Error: Lisensi induk tidak ditemukan.';
            }
        } else {
            // New License creation
            $licenseCode = 'GAWE-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4));
            MembershipSubscription::create([
                'user_id' => $membershipTransaction->user_id,
                'pricing_plan_id' => $membershipTransaction->pricing_plan_id,
                'transaction_id' => $membershipTransaction->id,
                'license_code' => $licenseCode,
                'starts_at' => now(),
                'ends_at' => now()->addDays($daysToAdd),
                'status' => 'active',
            ]);
            $msg = 'Lisensi baru telah diaktifkan.';
        }

        // Update Transaction
        $membershipTransaction->update([
            'status' => 'approved',
            'approved_at' => now(),
            'admin_note' => $request->admin_note,
        ]);

        return redirect()->route('admin.memberships.index')->with('success', 'Pembayaran disetujui. ' . $msg);
    }

    public function reject(Request $request, MembershipTransaction $membershipTransaction)
    {
        $request->validate([
            'admin_note' => 'required'
        ]);

        $membershipTransaction->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note,
        ]);

        return redirect()->route('admin.memberships.index')->with('success', 'Pembayaran telah ditolak.');
    }
}
