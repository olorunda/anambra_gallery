<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouncilMember extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'position',
        'image',
        'biography',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'biography' => 'array',
        'is_active' => 'boolean',
    ];
}
