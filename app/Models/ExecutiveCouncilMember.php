<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExecutiveCouncilMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'slug',
        'image',
        'biography',
        'display_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [

            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

        public function scopeExcludegov($query)
    {
        return $query->where('positIon','!=' ,'Governor');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        // If it's already a full URL (legacy data), return as is
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Otherwise, it's a stored file path, return storage URL
        return asset('storage/' . $this->image);
    }
}
