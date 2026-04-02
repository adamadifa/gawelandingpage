<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $guarded = [];

    public function features()
    {
        return $this->hasMany(PlanFeature::class)->orderBy('sort_order');
    }

    public function transactions()
    {
        return $this->hasMany(MembershipTransaction::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(MembershipSubscription::class);
    }
}
