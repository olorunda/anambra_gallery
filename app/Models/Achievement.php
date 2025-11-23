<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'achievement_date',
        'category',
        'meta_data',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'achievement_date' => 'date',
        'meta_data' => 'array',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->orderBy('sort_order');
    }
}
