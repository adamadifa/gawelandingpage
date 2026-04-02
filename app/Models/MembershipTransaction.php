<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'pricing_plan_id',
        'plan_type',
        'amount',
        'payment_proof',
        'status',
        'admin_note',
        'approved_at',
        'subscription_id',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pricingPlan()
    {
        return $this->belongsTo(PricingPlan::class);
    }

    public function subscription()
    {
        return $this->belongsTo(MembershipSubscription::class, 'subscription_id');
    }
}
