<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'title_badge',
        'title_badge_icon',
        'headline',
        'description',
        'main_image',
        'floating_image',
        'cta_text',
        'cta_url',
        'feature_items',
        'is_active'
    ];

    protected $casts = [
        'feature_items' => 'array',
        'is_active' => 'boolean'
    ];
}
