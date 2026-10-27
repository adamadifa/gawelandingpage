<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceCodeClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'whatsapp_number',
        'platform',
        'platform_other',
        'order_id',
        'purchase_date',
        'price_paid',
        'proof_file',
        'rating',
        'position',
        'company',
        'testimonial_content',
        'avatar',
        'status',
        'admin_note',
        'verified_at',
        'testimonial_id',
        'license_key',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'verified_at' => 'datetime',
        'rating' => 'integer',
        'price_paid' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function testimonial()
    {
        return $this->belongsTo(Testimonial::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function getPlatformLabel(): string
    {
        $platforms = [
            'lynk_id'         => 'Lynk.id',
            'saweria'         => 'Saweria',
            'other'           => $this->platform_other ?: 'Platform Lainnya',
            'direct_transfer' => 'Transfer Langsung / WhatsApp',
            'mayar'           => 'Mayar.id',
            'codecanyon'      => 'CodeCanyon / Envato',
            'fastwork'        => 'Fastwork',
            'shopee'          => 'Shopee',
            'tokopedia'       => 'Tokopedia',
        ];

        return $platforms[$this->platform] ?? ($this->platform_other ?: ucwords(str_replace('_', ' ', $this->platform)));
    }
}
