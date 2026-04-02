<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureSection extends Model
{
    protected $fillable = [
        'title_badge',
        'title_badge_icon',
        'headline',
        'image_path',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
