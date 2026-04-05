<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipSubscription extends Model
{
    protected $fillable = [
        'user_id',
        'pricing_plan_id',
        'transaction_id',
        'license_code',
        'starts_at',
        'ends_at',
        'status',
        'app_url',
        'app_status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pricingPlan()
    {
        return $this->belongsTo(PricingPlan::class);
    }

    public function transaction()
    {
        return $this->belongsTo(MembershipTransaction::class, 'transaction_id');
    }

    public function isExpired()
    {
        return $this->ends_at->isPast();
    }
}
