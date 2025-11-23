<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'url',
        'alt_text',
        'imageable_type',
        'imageable_id',
        'sort_order',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
