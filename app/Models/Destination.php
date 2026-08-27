<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'location',
        'image_url',
        'description',
        'highlights',
        'is_popular',
        'is_active',
    ];

    protected $casts = [
        'highlights' => 'array',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function packages()
    {
        return $this->hasMany(TourPackage::class);
    }
}
