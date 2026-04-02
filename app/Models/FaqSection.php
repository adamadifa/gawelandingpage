<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqSection extends Model
{
    protected $fillable = [
        'title_badge',
        'title_badge_icon',
        'headline',
        'description',
        'primary_image',
        'secondary_image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
