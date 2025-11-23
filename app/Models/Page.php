<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'content',
        'meta_data',
        'background_image',
        'seal_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'meta_data' => 'array',
        'is_active' => 'boolean',
    ];
}
